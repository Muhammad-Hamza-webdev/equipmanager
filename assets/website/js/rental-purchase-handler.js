/**
 * Rental and Purchase Form Handler
 * Provides real-time price calculation, validation, and AJAX submission
 * Integrates with server-side price calculation and inventory APIs
 * Syncs with UI calendar for two-way date selection
 */

(function () {
	"use strict";

	// Configuration
	// Get base URL from window context, never use hardcoded paths
	let BASE_URL = window.APP_BASE_URL;
	if (!BASE_URL) {
		console.error("APP_BASE_URL not defined! Make sure view sets window.APP_BASE_URL = site_url('/')");
		BASE_URL = window.location.pathname.split("/").slice(0, -1).join("/") + "/";
	}
	if (!BASE_URL.endsWith("/")) {
		BASE_URL += "/";
	}

	function parseJsonResponse(response) {
		return response.text().then((text) => {
			try {
				return JSON.parse(text);
			} catch (error) {
				const snippet = text ? text.slice(0, 200) : "";
				throw new Error(snippet || "Invalid JSON response");
			}
		});
	}

	// Calendar sync state - shared with product-detail.js
	window.formCalendarSync = {
		updateFormDates: null,
		updateCalendarDates: null,
	};

	// Get item details from page
	function getItemDetails() {
		// First try to get from URL parameters (for backward compatibility)
		const urlParams = new URLSearchParams(window.location.search);
		const itemParam = urlParams.get("item");

		if (itemParam) {
			// Decode the item parameter
			const decoded = atob(itemParam.replace(/-/g, "+").replace(/_/g, "/"));
			const itemID = decoded.split("|")[0];

			// Determine if it's equipment or workforce based on current page
			const path = window.location.pathname.toLowerCase();
			const isEquipment =
				path.includes("equipmentdetailmarketplace") ||
				path.includes("equipment-detail") ||
				path.includes("equipmentdetail");
			const isWorkforce =
				path.includes("workforcedetailmarketplace") ||
				path.includes("workforce-detail") ||
				path.includes("workforcedetail");

			let itemType = isEquipment ? 1 : isWorkforce ? 2 : null;
			if (!itemType) {
				const itemTypeInput = document.querySelector("input#itemType");
				itemType = itemTypeInput ? parseInt(itemTypeInput.value) : null;
			}

			return {
				itemID: itemID,
				itemType: itemType,
			};
		}

		// Fallback: get from hidden form inputs
		const itemIdInput = document.querySelector('input#itemId');
		const itemTypeInput = document.querySelector('input#itemType');

		if (itemIdInput && itemTypeInput) {
			return {
				itemID: itemIdInput.value,
				itemType: parseInt(itemTypeInput.value) || null,
			};
		}

		return null;
	}

	// Calculate price via server-side API
	function calculatePrice(itemId, itemType, saleType, quantity, startDate, endDate, callback) {
		const params = new URLSearchParams({
			item_id: itemId,
			item_type: itemType,
			sale_type: saleType,
			quantity: quantity || 1,
		});

		if (startDate) params.append('start_date', startDate);
		if (endDate) params.append('end_date', endDate);
		
		// SECURITY FIX: Add CSRF token to prevent CSRF attacks
		if (window.CSRF_TOKEN_NAME && window.CSRF_TOKEN_VALUE) {
			params.append(window.CSRF_TOKEN_NAME, window.CSRF_TOKEN_VALUE);
		}

		fetch(BASE_URL + "api/PriceCalculator/calculate", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
				"X-Requested-With": "XMLHttpRequest"
			},
			body: params.toString(),
		})
			.then((response) => parseJsonResponse(response))
			.then((data) => {
				if (data.success) {
					callback(null, data.data);
				} else {
					callback(data.message || "Failed to calculate price", null);
				}
			})
			.catch((error) => {
				callback("Network error: " + error.message, null);
			});
	}

	// Check inventory availability
	function checkInventory(itemId, itemType, quantity, startDate, endDate, callback) {
		const params = new URLSearchParams({
			item_id: itemId,
			item_type: itemType,
			quantity: quantity || 1,
		});

		if (startDate) params.append('start_date', startDate);
		if (endDate) params.append('end_date', endDate);
		
		// SECURITY FIX: Add CSRF token to prevent CSRF attacks
		if (window.CSRF_TOKEN_NAME && window.CSRF_TOKEN_VALUE) {
			params.append(window.CSRF_TOKEN_NAME, window.CSRF_TOKEN_VALUE);
		}

		fetch(BASE_URL + "api/InventoryChecker/check", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
				"X-Requested-With": "XMLHttpRequest"
			},
			body: params.toString(),
		})
			.then((response) => parseJsonResponse(response))
			.then((data) => {
				if (data.success) {
					callback(null, data);
				} else {
					callback(data.message || "Failed to check inventory", null);
				}
			})
			.catch((error) => {
				callback("Network error: " + error.message, null);
			});
	}

	// Validate rental duration
	function validateRentalDates(startDate, endDate) {
		if (!startDate || !endDate) {
			return { valid: false, message: "Please select both start and end dates" };
		}

		const start = new Date(startDate);
		const end = new Date(endDate);

		if (end < start) {
			return { valid: false, message: "End date must be after start date" };
		}

		// Calculate days (inclusive)
		const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;

		if (days < 2) {
			return { valid: false, message: "Minimum 2-day rental required" };
		}

		return { valid: true, days: days };
	}

	// Debounce function to prevent excessive API calls
	function debounce(func, wait) {
		let timeout;
		function executedFunction(...args) {
			const later = () => {
				clearTimeout(timeout);
				func(...args);
			};
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
		}
		executedFunction.cancel = function() {
			clearTimeout(timeout);
		};
		executedFunction.execute = function(...args) {
			clearTimeout(timeout);
			func(...args);
		};
		return executedFunction;
	}

	// Show toast notification
	function showToast(message, type = "info") {
		const toast = document.createElement("div");
		toast.className = "custom-toast toast-" + type;
		toast.textContent = message;
		toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === "success" ? "#34ff67" : type === "error" ? "#ff3434" : "#526464"};
            color: ${type === "success" || type === "error" ? "#0f2f2c" : "#fff"};
            padding: 16px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10000;
            font-weight: 600;
            animation: slideIn 0.3s ease-out;
        `;

		document.body.appendChild(toast);

		setTimeout(() => {
			toast.style.animation = "slideOut 0.3s ease-in";
			setTimeout(() => toast.remove(), 300);
		}, 4000);
	}

	// Add CSS animations
	const style = document.createElement("style");
	style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(400px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(400px); opacity: 0; }
        }
        .form-error {
            border: 2px solid #ff3434 !important;
        }
        .total-cost-display {
            background: #f0f9f4;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            text-align: center;
        }
        .total-cost-display .label {
            font-size: 14px;
            color: #526464;
            margin-bottom: 4px;
        }
        .total-cost-display .amount {
            font-size: 28px;
            font-weight: bold;
            color: #0f2f2c;
        }
        .total-cost-display .details {
            font-size: 12px;
            color: #666;
            margin-top: 8px;
        }
    `;
	document.head.appendChild(style);

	// Initialize Rent Now Form
	function initRentForm() {
		const form = document.getElementById("rent-form");
		if (!form) return;

		console.log('🚀 Initializing rent form...');
		
		const itemDetails = getItemDetails();
		if (!itemDetails) {
			console.warn('⚠️ Could not get item details');
			return;
		}

		console.log('📦 Item details:', itemDetails);

		// Check if this is equipment or workforce
		if (itemDetails.itemType === 1) {
			console.log('🔧 Initializing EQUIPMENT rental');
			initEquipmentRental(form, itemDetails);
		} else if (itemDetails.itemType === 2) {
			console.log('👥 Initializing WORKFORCE rental');
			initWorkforceRental(form, itemDetails);
		}
	}

	// Initialize Equipment Rental Form
	function initEquipmentRental(form, itemDetails) {
		// Get input elements
		const companyInput = form.querySelector("#company_text") || form.querySelector('[name="company"]');
		const quantityInput = form.querySelector("#rental_quantity");
		const startDateInput = form.querySelector("#rental_start");
		const endDateInput = form.querySelector("#rental_end");
		const notesInput = form.querySelector("#company_note");
		const stockInfo = form.querySelector(".stock-info");
		const totalDisplay = form.querySelector("#rental-total-display");
		const totalAmount = form.querySelector("#rental-total-amount");
		const totalBreakdown = form.querySelector("#rental-breakdown");
		const errorDisplay = form.querySelector("#rental-calc-error");
		const loadingDisplay = form.querySelector("#rental-loading");
		const basePrice = parseFloat(form.dataset.basePrice || "0");
		const baseUnit = form.dataset.baseUnit || "";

		let currentPriceData = null;

		// Real-time calculation on input change (debounced)
		const updateTotal = debounce(function () {
			const quantity = parseInt(quantityInput.value) || 0;
			const startDate = startDateInput.value;
			const endDate = endDateInput.value;

			if (!quantity || quantity < 1) {
				totalDisplay.style.display = "none";
				if (errorDisplay) errorDisplay.style.display = "none";
				return;
			}

			if (!startDate || !endDate) {
				if (basePrice > 0) {
					const baseTotal = basePrice * quantity;
					if (errorDisplay) errorDisplay.style.display = "none";
					totalDisplay.style.display = "block";
					if (totalAmount) {
						totalAmount.textContent = "$" + baseTotal.toFixed(2);
					}
					if (totalBreakdown) {
						totalBreakdown.textContent = baseUnit
							? "Base rate (" + baseUnit + ")"
							: "Base rate";
					}
					return;
				}

				totalDisplay.style.display = "none";
				if (errorDisplay) errorDisplay.style.display = "none";
				return;
			}

			// Validate date range first
			const dateValidation = validateRentalDates(startDate, endDate);
			if (!dateValidation.valid) {
				totalDisplay.style.display = "none";
				if (loadingDisplay) loadingDisplay.style.display = "none";
				if (errorDisplay) {
					errorDisplay.textContent = dateValidation.message;
					errorDisplay.style.display = "block";
				}
				return;
			}

			// Show loading indicator and hide errors while waiting
			if (loadingDisplay) loadingDisplay.style.display = "block";
			if (errorDisplay) errorDisplay.style.display = "none";
			totalDisplay.style.display = "none";

			// Call server-side price calculation
			calculatePrice(itemDetails.itemID, itemDetails.itemType, 0, quantity, startDate, endDate, (error, data) => {
				// Hide loading regardless of outcome
				if (loadingDisplay) loadingDisplay.style.display = "none";

				if (error) {
					if (errorDisplay) {
						errorDisplay.textContent = error;
						errorDisplay.style.display = "block";
					}
					totalDisplay.style.display = "none";
					return;
				}

				// Store for later validation
				currentPriceData = data;

				// Check inventory availability
				checkInventory(itemDetails.itemID, itemDetails.itemType, quantity, startDate, endDate, (invError, invData) => {
					if (invError) {
						if (errorDisplay) {
							errorDisplay.textContent = invError;
							errorDisplay.style.display = "block";
						}
						totalDisplay.style.display = "none";
						return;
					}

					// Update inventory display
					if (stockInfo) {
						if (invData.available) {
							stockInfo.textContent = "Available: " + invData.available_quantity + " units";
							stockInfo.style.color = "#333";
						} else {
							stockInfo.textContent = invData.message;
							stockInfo.style.color = "#ff3434";
						}
					}

					if (!invData.available) {
						if (errorDisplay) {
							errorDisplay.textContent = invData.message;
							errorDisplay.style.display = "block";
						}
						totalDisplay.style.display = "none";
						return;
					}

					// Display total
					if (errorDisplay) errorDisplay.style.display = "none";
					totalDisplay.style.display = "block";

					if (totalAmount) {
						totalAmount.textContent = "$" + parseFloat(data.total_amount).toFixed(2);
					}

					if (totalBreakdown) {
						totalBreakdown.textContent = data.breakdown;
					}
				});
			});
		}, 500);

		// Set up two-way sync with calendar
		let isUpdatingFromCalendar = false;
		let isUpdatingFromForm = false;

		// Attempt to bind to calendar sync (handles late-loaded calendar script)
		function bindCalendarSync() {
			if (!window.calendarSync) {
				console.log('⏳ Calendar sync not ready yet');
				return false;
			}
			console.log('🔗 Binding calendar sync to form...');
			window.calendarSync.onDateSelected = function (dates) {
				console.log('📍 Calendar dates received in form handler:', dates);
				if (isUpdatingFromForm) {
					console.log('ℹ️ Skipping circular update from form');
					return; // Prevent circular updates
				}

				isUpdatingFromCalendar = true;
				startDateInput.value = dates.startDate || "";
				endDateInput.value = dates.endDate || "";
				console.log('✍️ Hidden inputs updated:', {
					startDate: startDateInput.value,
					endDate: endDateInput.value
				});
				isUpdatingFromCalendar = false;

				// Trigger calculation update immediately
				console.log('🧮 Triggering price calculation...');
				updateTotal();
			};
			console.log('✅ Calendar sync binding complete');
			return true;
		}

		// Bind immediately if possible, otherwise retry briefly
		if (!bindCalendarSync()) {
			console.log('🔄 Calendar not ready, starting retry loop...');
			const syncInterval = setInterval(() => {
				if (bindCalendarSync()) {
					console.log('✅ Calendar became available, binding successful');
					clearInterval(syncInterval);
					// Trigger calculation after calendar sync is ready
					setTimeout(updateTotal, 100);
				}
			}, 100);
			setTimeout(() => {
				clearInterval(syncInterval);
				console.warn('⚠️ Calendar sync retry timeout - calendar may have failed to load');
			}, 5000);
		} else {
			// Calendar already available, trigger immediate calculation if dates/qty present
			console.log('✅ Calendar ready on init, triggering initial calculation');
			setTimeout(updateTotal, 100);
		}

		// Update calendar when form dates change
		function syncFormToCalendar() {
			if (isUpdatingFromCalendar) return; // Prevent circular updates
			if (!window.calendarSync) return;

			isUpdatingFromForm = true;
			const startDate = startDateInput.value;
			const endDate = endDateInput.value;

			if (startDate || endDate) {
				window.calendarSync.setDates(startDate, endDate);
			} else if (typeof window.calendarSync.clearSelection === "function") {
				window.calendarSync.clearSelection();
			}
			isUpdatingFromForm = false;
		}

		// Event listeners
		if (quantityInput) {
			quantityInput.addEventListener("input", function() {
				const maxQty = parseInt(this.max);
				const currentQty = parseInt(this.value) || 0;
				
				// Enforce max attribute on input
				if (maxQty > 0 && currentQty > maxQty) {
					console.warn('⚠️ Rental quantity (' + currentQty + ') exceeds available (' + maxQty + '), limiting...');
					this.value = maxQty;
				}
				
				updateTotal();
			});
			// Force immediate update on blur (when user leaves field)
			quantityInput.addEventListener("blur", function() {
				updateTotal.execute?.();
			});
		}
		if (startDateInput) {
			startDateInput.addEventListener("change", function () {
				syncFormToCalendar();
				// Immediate calculation on date selection (not debounced)
				updateTotal.execute?.();
			});
		}
		if (endDateInput) {
			endDateInput.addEventListener("change", function () {
				syncFormToCalendar();
				// Immediate calculation on date selection (not debounced)
				updateTotal.execute?.();
			});
		}

		// Handle form submission
		form.addEventListener("submit", function (e) {
			e.preventDefault();

			const quantity = parseInt(quantityInput.value) || 0;
			const maxQuantity = parseInt(quantityInput.max) || 0;
			const startDate = startDateInput.value;
			const endDate = endDateInput.value;
			const company = companyInput.value.trim();
			const notes = notesInput ? notesInput.value.trim() : "";

			// Validate quantity against available stock
			if (quantity > maxQuantity) {
				showToast("Cannot rent more than " + maxQuantity + " units. Available: " + maxQuantity, "error");
				quantityInput.classList.add("form-error");
				return;
			}

			if (quantity < 1) {
				showToast("Please enter a valid quantity (minimum 1)", "error");
				return;
			}

			// Validate
			if (!company) {
				showToast("Company name is required", "error");
				companyInput.classList.add("form-error");
				return;
			}

			const dateValidation = validateRentalDates(startDate, endDate);
			if (!dateValidation.valid) {
				showToast(dateValidation.message, "error");
				return;
			}

			if (!currentPriceData) {
				showToast("Loading pricing data. Please wait...", "info");
				return;
			}

			// Disable submit button
			const submitBtn = form.querySelector('button[type="submit"]');
			const originalText = submitBtn.textContent;
			submitBtn.disabled = true;
			submitBtn.textContent = "Processing...";

			// Submit via AJAX
			const formData = new FormData();
			formData.append("itemType", itemDetails.itemType);
			formData.append("itemID", itemDetails.itemID);
			formData.append("quantity", quantity);
			formData.append("startDate", startDate);
			formData.append("endDate", endDate);
			formData.append("company", company);
			formData.append("notes", notes);
			formData.append("totalAmount", currentPriceData.total_amount);
			
			// SECURITY FIX: Add CSRF token to prevent CSRF attacks
			if (window.CSRF_TOKEN_NAME && window.CSRF_TOKEN_VALUE) {
				formData.append(window.CSRF_TOKEN_NAME, window.CSRF_TOKEN_VALUE);
			}

			fetch(BASE_URL + "listing/processRentRequest", {
				method: "POST",
				body: formData,
			})
				.then((response) => response.json())
				.then((data) => {
					if (data.success) {
						console.log('✅ Rental request successful!', {
							message: data.message,
							totalCost: data.totalCost,
							days: data.days,
							quantityRented: quantity,
							itemID: itemDetails.itemID
						});
						console.log('📉 Equipment inventory decreased by: ' + quantity + ' units');
						showToast(data.message || "Rental request submitted successfully!", "success");
						form.reset();
						totalDisplay.style.display = "none";
					} else {
						showToast(data.message || "Request failed", "error");
						console.error('❌ Rental request failed:', data.message);
					}
				})
				.catch((error) => {
					showToast("Network error. Please try again.", "error");
					console.error("Submit error:", error);
				})
				.finally(() => {
					submitBtn.disabled = false;
					submitBtn.textContent = originalText;
				});
		});
	}

	// Initialize Workforce Rental Form
	function initWorkforceRental(form, itemDetails) {
		// Get input elements
		const companyInput = form.querySelector("#company_text") || form.querySelector('[name="company"]');
		const quantityInput = form.querySelector("#quantity");
		const startDateInput = form.querySelector("#startDate");
		const endDateInput = form.querySelector("#endDate");
		const notesInput = form.querySelector("#company_note");
		const stockInfo = form.querySelector(".stock-info");
		const totalDisplay = form.querySelector("#total-cost-display");
		const totalAmount = form.querySelector("#total-amount");
		const totalBreakdown = form.querySelector("#cost-breakdown");
		const errorDisplay = form.querySelector("#calc-error");
		const loadingDisplay = form.querySelector("#total-loading");
		const basePrice = parseFloat(form.dataset.basePrice || "0");
		const baseUnit = form.dataset.baseUnit || "";

		let currentPriceData = null;

		// Real-time calculation on input change (debounced)
		const updateTotal = debounce(function () {
			const startDate = startDateInput.value;
			const endDate = endDateInput.value;

			if (!startDate || !endDate) {
				if (basePrice > 0) {
					const baseTotal = basePrice;
					if (errorDisplay) errorDisplay.style.display = "none";
					totalDisplay.style.display = "block";
					if (totalAmount) {
						totalAmount.textContent = "$" + baseTotal.toFixed(2);
					}
					if (totalBreakdown) {
						totalBreakdown.textContent = baseUnit
							? "Base rate (" + baseUnit + ")"
							: "Base rate";
					}
					return;
				}

				totalDisplay.style.display = "none";
				if (errorDisplay) errorDisplay.style.display = "none";
				return;
			}

			// Validate date range first
			const dateValidation = validateRentalDates(startDate, endDate);
			if (!dateValidation.valid) {
				totalDisplay.style.display = "none";
				if (loadingDisplay) loadingDisplay.style.display = "none";
				if (errorDisplay) {
					errorDisplay.textContent = dateValidation.message;
					errorDisplay.style.display = "block";
				}
				return;
			}

			// Show loading indicator and hide errors while waiting
			if (loadingDisplay) loadingDisplay.style.display = "block";
			if (errorDisplay) errorDisplay.style.display = "none";
			totalDisplay.style.display = "none";

			// Call server-side price calculation (workforce is always qty 1)
			calculatePrice(itemDetails.itemID, itemDetails.itemType, 0, 1, startDate, endDate, (error, data) => {
				// Hide loading regardless of outcome
				if (loadingDisplay) loadingDisplay.style.display = "none";

				if (error) {
					if (errorDisplay) {
						errorDisplay.textContent = error;
						errorDisplay.style.display = "block";
					}
					totalDisplay.style.display = "none";
					return;
				}

				// Store for later validation
				currentPriceData = data;

				// Check inventory availability
				checkInventory(itemDetails.itemID, itemDetails.itemType, 1, startDate, endDate, (invError, invData) => {
					if (invError) {
						if (errorDisplay) {
							errorDisplay.textContent = invError;
							errorDisplay.style.display = "block";
						}
						totalDisplay.style.display = "none";
						return;
					}

					if (!invData.available) {
						if (errorDisplay) {
							errorDisplay.textContent = invData.message;
							errorDisplay.style.display = "block";
						}
						totalDisplay.style.display = "none";
						return;
					}

					// Display total
					if (errorDisplay) errorDisplay.style.display = "none";
					totalDisplay.style.display = "block";

					if (totalAmount) {
						totalAmount.textContent = "$" + parseFloat(data.total_amount).toFixed(2);
					}

					if (totalBreakdown) {
						totalBreakdown.textContent = data.breakdown;
					}
				});
			});
		}, 500);

		// Set up two-way sync with calendar
		let isUpdatingFromCalendar = false;
		let isUpdatingFromForm = false;

		// Attempt to bind to calendar sync (handles late-loaded calendar script)
		function bindCalendarSync() {
			if (!window.calendarSync) return false;
			window.calendarSync.onDateSelected = function (dates) {
				if (isUpdatingFromForm) return; // Prevent circular updates

				isUpdatingFromCalendar = true;
				startDateInput.value = dates.startDate || "";
				endDateInput.value = dates.endDate || "";
				isUpdatingFromCalendar = false;

				// Trigger calculation update
				updateTotal();
			};
			return true;
		}

		// Bind immediately if possible, otherwise retry briefly
		if (!bindCalendarSync()) {
			const syncInterval = setInterval(() => {
				if (bindCalendarSync()) {
					clearInterval(syncInterval);
					// Trigger calculation after calendar sync is ready
					setTimeout(updateTotal, 100);
				}
			}, 100);
			setTimeout(() => clearInterval(syncInterval), 5000);
		} else {
			// Calendar already available, trigger immediate calculation if dates present
			setTimeout(updateTotal, 100);
		}

		// Update calendar when form dates change
		function syncFormToCalendar() {
			if (isUpdatingFromCalendar) return; // Prevent circular updates
			if (!window.calendarSync) return;

			isUpdatingFromForm = true;
			const startDate = startDateInput.value;
			const endDate = endDateInput.value;

			if (startDate || endDate) {
				window.calendarSync.setDates(startDate, endDate);
			} else if (typeof window.calendarSync.clearSelection === "function") {
				window.calendarSync.clearSelection();
			}
			isUpdatingFromForm = false;
		}

		// Event listeners for date changes
		if (startDateInput) {
			startDateInput.addEventListener("change", function () {
				syncFormToCalendar();
				// Immediate calculation on date selection (not debounced)
				updateTotal.execute?.();
			});
		}
		if (endDateInput) {
			endDateInput.addEventListener("change", function () {
				syncFormToCalendar();
				// Immediate calculation on date selection (not debounced)
				updateTotal.execute?.();
			});
		}

		// Handle form submission
		form.addEventListener("submit", function (e) {
			e.preventDefault();

			const startDate = startDateInput.value;
			const endDate = endDateInput.value;
			const company = companyInput.value.trim();
			const notes = notesInput ? notesInput.value.trim() : "";

			// Validate
			if (!company) {
				showToast("Company name is required", "error");
				companyInput.classList.add("form-error");
				return;
			}

			const dateValidation = validateRentalDates(startDate, endDate);
			if (!dateValidation.valid) {
				showToast(dateValidation.message, "error");
				return;
			}

			if (!currentPriceData) {
				showToast("Loading pricing data. Please wait...", "info");
				return;
			}

			// Disable submit button
			const submitBtn = form.querySelector('button[type="submit"]');
			const originalText = submitBtn.textContent;
			submitBtn.disabled = true;
			submitBtn.textContent = "Processing...";

			// Submit via AJAX
			const formData = new FormData();
			formData.append("itemType", itemDetails.itemType);
			formData.append("itemID", itemDetails.itemID);
			formData.append("quantity", 1); // Workforce is always 1 unit
			formData.append("startDate", startDate);
			formData.append("endDate", endDate);
			formData.append("company", company);
			formData.append("notes", notes);
			formData.append("totalAmount", currentPriceData.total_amount);
			
			// SECURITY FIX: Add CSRF token to prevent CSRF attacks
			if (window.CSRF_TOKEN_NAME && window.CSRF_TOKEN_VALUE) {
				formData.append(window.CSRF_TOKEN_NAME, window.CSRF_TOKEN_VALUE);
			}

			fetch(BASE_URL + "listing/processRentRequest", {
				method: "POST",
				body: formData,
			})
				.then((response) => response.json())
				.then((data) => {
					if (data.success) {
						showToast(data.message || "Rental request submitted successfully!", "success");
						form.reset();
						totalDisplay.style.display = "none";
					} else {
						showToast(data.message || "Request failed", "error");
					}
				})
				.catch((error) => {
					showToast("Network error. Please try again.", "error");
					console.error("Submit error:", error);
				})
				.finally(() => {
					submitBtn.disabled = false;
					submitBtn.textContent = originalText;
				});
		});
	}

	// Initialize Buy Now Form (equipment only)
	function initBuyForm() {
		const form = document.getElementById("buy-form");
		if (!form) return;

		console.log('🛒 Initializing buy form...');

		const itemDetails = getItemDetails();
		if (!itemDetails || itemDetails.itemType !== 1) {
			console.warn('❌ Not equipment item type, skipping buy form init');
			return; // 1 = equipment
		}

		// Get input elements
		const companyInput = form.querySelector("#purchase_company");
		const quantityInput = form.querySelector("#purchase_quantity");
		const notesInput = form.querySelector("#purchase_notes");
		const stockInfo = form.querySelector("#purchase-stock-info");
		const totalDisplay = form.querySelector("#purchase-total-display");
		const totalAmount = form.querySelector("#purchase-total-amount");
		const totalBreakdown = form.querySelector("#purchase-breakdown");
		const errorDisplay = form.querySelector("#purchase-calc-error");
		const basePrice = parseFloat(form.dataset.basePrice || form.parentElement?.dataset?.basePrice || "0");

		let currentPriceData = null;

		console.log('💰 Base price for purchase:', basePrice);

		// Real-time calculation on input change (debounced)
		const updateTotal = debounce(function () {
			const quantity = parseInt(quantityInput.value) || 0;

			console.log('📊 Purchase quantity changed:', quantity);

			if (!quantity || quantity < 1) {
				totalDisplay.style.display = "none";
				if (errorDisplay) errorDisplay.style.display = "none";
				return;
			}

			// For purchase mode with valid base price, use it directly (no API call needed)
			if (basePrice > 0) {
				const baseTotal = basePrice * quantity;
				if (errorDisplay) errorDisplay.style.display = "none";
				totalDisplay.style.display = "block";
				if (totalAmount) {
					totalAmount.textContent = "$" + baseTotal.toFixed(2);
				}
				if (totalBreakdown) {
					totalBreakdown.textContent = "Price per unit: $" + basePrice.toFixed(2);
				}
				console.log('✅ Purchase total calculated:', baseTotal);
				
				// Store price data for form submission
				currentPriceData = {
					total_amount: baseTotal,
					breakdown: "Price per unit: $" + basePrice.toFixed(2),
					quantity: quantity,
					unit_price: basePrice
				};
				
				return; // Don't call API for purchase mode with base price
			}

			// If no base price, try API call (fallback)
			console.log('🔄 Calculating purchase price via API...');
			calculatePrice(itemDetails.itemID, itemDetails.itemType, 1, quantity, null, null, (error, data) => {
				if (error) {
					console.warn('⚠️ Price calculation error:', error);
					// Suppress error display for purchase mode - just use base price
					if (errorDisplay) errorDisplay.style.display = "none";
					totalDisplay.style.display = "none";
					return;
				}

				// Store for later validation
				currentPriceData = data;
				console.log('✅ Price data received:', data);

				// Display the calculated price
				if (errorDisplay) errorDisplay.style.display = "none";
				totalDisplay.style.display = "block";

				if (totalAmount) {
					totalAmount.textContent = "$" + parseFloat(data.total_amount).toFixed(2);
				}

				if (totalBreakdown) {
					totalBreakdown.textContent = data.breakdown || "Total Price";
				}
			});
		}, 500);

		// Event listeners
		if (quantityInput) {
			quantityInput.addEventListener("input", function() {
				const maxQty = parseInt(this.max);
				const currentQty = parseInt(this.value) || 0;
				
				// Enforce max attribute on input
				if (maxQty > 0 && currentQty > maxQty) {
					console.warn('⚠️ Purchase quantity (' + currentQty + ') exceeds available (' + maxQty + '), limiting...');
					this.value = maxQty;
				}
				
				updateTotal();
			});
			// Force immediate update on blur (when user leaves field)
			quantityInput.addEventListener("blur", function() {
				updateTotal.execute?.();
			});
		}

		// Trigger initial calculation if quantity > 0
		if (quantityInput && parseInt(quantityInput.value) > 0) {
			console.log('🚀 Triggering initial purchase calculation');
			setTimeout(function() {
				updateTotal.execute?.();
			}, 50);
		}

		// Handle form submission
		form.addEventListener("submit", function (e) {
			e.preventDefault();

			const quantity = parseInt(quantityInput.value) || 0;
			const maxQuantity = parseInt(quantityInput.max) || 0;
			const company = companyInput.value.trim();
			const notes = notesInput ? notesInput.value.trim() : "";

			// Validate quantity against available stock
			if (maxQuantity > 0 && quantity > maxQuantity) {
				showToast("Cannot purchase more than " + maxQuantity + " units. Available: " + maxQuantity, "error");
				quantityInput.classList.add("form-error");
				return;
			}

			if (quantity < 1) {
				showToast("Please enter a valid quantity (minimum 1)", "error");
				return;
			}

			// Validate
			if (!company) {
				showToast("Company name is required", "error");
				companyInput.classList.add("form-error");
				return;
			}

			if (!currentPriceData) {
				showToast("Loading pricing data. Please wait...", "info");
				return;
			}

			// Disable submit button
			const submitBtn = form.querySelector('button[type="submit"]');
			const originalText = submitBtn.textContent;
			submitBtn.disabled = true;
			submitBtn.textContent = "Processing...";

			// Submit via AJAX
			const formData = new FormData();
			formData.append("itemType", itemDetails.itemType);
			formData.append("itemID", itemDetails.itemID);
			formData.append("quantity", quantity);
			formData.append("company", company);
			formData.append("notes", notes);
			formData.append("totalAmount", currentPriceData.total_amount);
			
			// SECURITY FIX: Add CSRF token to prevent CSRF attacks
			if (window.CSRF_TOKEN_NAME && window.CSRF_TOKEN_VALUE) {
				formData.append(window.CSRF_TOKEN_NAME, window.CSRF_TOKEN_VALUE);
			}

			fetch(BASE_URL + "listing/processBuyRequest", {
				method: "POST",
				body: formData,
			})
				.then((response) => response.json())
				.then((data) => {
					if (data.success) {
						console.log('✅ Purchase request successful!', {
							message: data.message,
							totalCost: data.totalCost || currentPriceData.total_amount,
							quantityPurchased: quantity,
							itemID: itemDetails.itemID
						});
						console.log('📉 Equipment inventory decreased by: ' + quantity + ' units (PERMANENT)');
						showToast(data.message || "Purchase request submitted successfully!", "success");
						form.reset();
						totalDisplay.style.display = "none";
					} else {
						showToast(data.message || "Request failed", "error");
						console.error('❌ Purchase request failed:', data.message);
					}
				})
				.catch((error) => {
					showToast("Network error. Please try again.", "error");
					console.error("Submit error:", error);
				})
				.finally(() => {
					submitBtn.disabled = false;
					submitBtn.textContent = originalText;
				});
		});
	}

	// Debug helper - expose form state for console inspection
	window.debugRentalForm = function() {
		const form = document.getElementById("rent-form");
		const startInput = form?.querySelector('#rental_start');
		const endInput = form?.querySelector('#rental_end');
		const quantityInput = form?.querySelector('#rental_quantity');
		
		const state = {
			formExists: !!form,
			calendarReady: !!window.calendarSync,
			calendarDates: window.calendarSync?.getSelectedDates?.(),
			hiddenInputs: {
				startDate: startInput?.value || 'NOT FOUND',
				endDate: endInput?.value || 'NOT FOUND',
				quantity: quantityInput?.value || 'NOT FOUND'
			},
			callbackRegistered: !!window.calendarSync?.onDateSelected,
			formState: form ? {
				id: form.id,
				html: form.innerHTML.substring(0, 200) + '...'
			} : null
		};
		
		console.table(state);
		return state;
	};
	
	console.log('✅ Rent form handler ready. Debug with: window.debugRentalForm() in console');

	// Initialize when DOM is ready
	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", function () {
			initRentForm();
			initBuyForm();
		});
	} else {
		initRentForm();
		initBuyForm();
	}
})();
