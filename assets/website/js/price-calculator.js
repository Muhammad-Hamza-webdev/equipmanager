/**
 * Secure Price Calculator & Inventory Checker
 *
 * Handles real-time price calculation and inventory availability checks
 * by communicating with the backend APIs.
 */

// Debounce function to prevent excessive API calls
function debounce(func, wait) {
	let timeout;
	return function executedFunction(...args) {
		const later = () => {
			clearTimeout(timeout);
			func(...args);
		};
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
	};
}

class PriceCalculator {
	constructor(config) {
		this.itemId = config.itemId;
		this.itemType = config.itemType; // 1=Equipment, 2=Workforce
		this.saleType = config.saleType ?? 0; // 0=Rental, 1=Purchase
		this.baseUrl = config.baseUrl;
		if (this.baseUrl && !this.baseUrl.endsWith("/")) {
			this.baseUrl += "/";
		}
		this.basePrice = config.basePrice ?? null;
		this.baseUnit = config.baseUnit ?? "";
		this.elementIds = config.elementIds || {};

		const resolveElement = (key, fallbackId) => {
			const elementId =
				this.elementIds[key] !== undefined
					? this.elementIds[key]
					: fallbackId;
			if (!elementId) return null;
			return (
				document.getElementById(elementId) ||
				document.querySelector("." + elementId)
			);
		};

		this.elements = {
			quantityInput: resolveElement("quantity", "quantity"),
			startDateInput: resolveElement("startDate", "startDate"),
			endDateInput: resolveElement("endDate", "endDate"),
			rentalTypeInput: resolveElement("rentalType", "rentalType"),
			totalDisplay: resolveElement("totalDisplay", "total-cost-display"),
			totalAmount: resolveElement("totalAmount", "total-amount"),
			breakdown: resolveElement("breakdown", "cost-breakdown"),
			stockInfo: resolveElement("stockInfo", "stock-info"),
			submitButton: resolveElement("submitButton", "submit-rental"),
			errorDisplay: resolveElement("errorDisplay", "calc-error"),
		};

		this.init();
	}

	init() {
		// Attach event listeners
		const inputs = [
			this.elements.quantityInput,
			this.elements.startDateInput,
			this.elements.endDateInput,
		];

		inputs.forEach((input) => {
			if (input) {
				input.addEventListener("change", () => this.update());
				input.addEventListener(
					"input",
					debounce(() => this.update(), 500),
				);
			}
		});

		// Specific handler for quantity to validate min/max immediately
		if (this.elements.quantityInput) {
			this.elements.quantityInput.addEventListener("input", (e) => {
				if (e.target.value < 1) e.target.value = 1;
			});
		}

		// Trigger an initial calculation/display
		this.update();
	}

	async update() {
		const startDate = this.elements.startDateInput?.value;
		const endDate = this.elements.endDateInput?.value;
		const quantity = this.elements.quantityInput
			? this.elements.quantityInput.value
			: 1;

		// If workforce, quantity is always 1
		const effectiveQty = this.itemType == 2 ? 1 : quantity;

		if (this.saleType === 0 && (!startDate || !endDate)) {
			if (this.basePrice !== null && !Number.isNaN(Number(this.basePrice))) {
				const baseTotal = Number(this.basePrice) * Number(effectiveQty || 1);
				if (this.elements.totalDisplay)
					this.elements.totalDisplay.style.display = "block";
				if (this.elements.totalAmount)
					this.elements.totalAmount.textContent = `$${baseTotal.toFixed(2)}`;
				if (this.elements.breakdown) {
					this.elements.breakdown.textContent = this.baseUnit
						? `Base rate (${this.baseUnit})`
						: "Base rate";
				}
				if (this.elements.errorDisplay)
					this.elements.errorDisplay.style.display = "none";
				this.disableSubmit(true);
				return;
			}

			this.resetDisplay("Please select dates");
			return;
		}

		this.setLoading(true);

		try {
			// 1. Check Inventory
			const inventoryParams = new URLSearchParams({
				item_id: this.itemId,
				item_type: this.itemType,
				quantity: effectiveQty,
			});

			if (this.saleType === 0) {
				inventoryParams.append("start_date", startDate);
				inventoryParams.append("end_date", endDate);
			}
			
			// SECURITY FIX: Add CSRF token to prevent CSRF attacks
			if (window.CSRF_TOKEN_NAME && window.CSRF_TOKEN_VALUE) {
				inventoryParams.append(window.CSRF_TOKEN_NAME, window.CSRF_TOKEN_VALUE);
			}

			const invResponse = await fetch(
				`${this.baseUrl}api/InventoryChecker/check`,
				{
					method: "POST",
					headers: { "Content-Type": "application/x-www-form-urlencoded" },
					body: inventoryParams,
				},
			);
			const invData = await invResponse.json();

			if (this.elements.stockInfo && invData.success) {
				const color = invData.available ? "green" : "red";
				this.elements.stockInfo.style.color = color;
				this.elements.stockInfo.textContent = invData.message;
			}

			if (!invData.available) {
				this.showError(invData.message);
				this.disableSubmit(true);
				return; // Stop if not available
			}

			// 2. Calculate Price
			const priceParams = new URLSearchParams({
				item_id: this.itemId,
				item_type: this.itemType,
				sale_type: this.saleType,
				quantity: effectiveQty, // Use effective quantity (1 for workforce)
			});

			if (this.saleType === 0) {
				priceParams.append("start_date", startDate);
				priceParams.append("end_date", endDate);
			}
			
			// SECURITY FIX: Add CSRF token to prevent CSRF attacks
			if (window.CSRF_TOKEN_NAME && window.CSRF_TOKEN_VALUE) {
				priceParams.append(window.CSRF_TOKEN_NAME, window.CSRF_TOKEN_VALUE);
			}

			const priceResponse = await fetch(
				`${this.baseUrl}api/PriceCalculator/calculate`,
				{
					method: "POST",
					headers: { "Content-Type": "application/x-www-form-urlencoded" },
					body: priceParams,
				},
			);
			const priceData = await priceResponse.json();

			if (priceData.success) {
				this.showPrice(priceData.data);
				this.disableSubmit(false);
			} else {
				this.showError(priceData.message);
				this.disableSubmit(true);
			}
		} catch (error) {
			console.error("Calculation error:", error);
			this.showError("Error calculating price. Please try again.");
		} finally {
			this.setLoading(false);
		}
	}

	showPrice(data) {
		if (this.elements.totalDisplay)
			this.elements.totalDisplay.style.display = "block";
		if (this.elements.totalAmount)
			this.elements.totalAmount.textContent = `$${data.total_amount}`;
		if (this.elements.breakdown)
			this.elements.breakdown.textContent = data.breakdown;
		if (this.elements.errorDisplay)
			this.elements.errorDisplay.style.display = "none";

		// Update hidden total input if exists (for fallback/display form submission)
		const hiddenTotal = document.getElementById("hidden_total_amount");
		if (hiddenTotal) hiddenTotal.value = data.total_amount;
	}

	showError(msg) {
		if (this.elements.errorDisplay) {
			this.elements.errorDisplay.style.display = "block";
			this.elements.errorDisplay.textContent = msg;
			this.elements.errorDisplay.style.color = "red";
		}
		if (this.elements.totalDisplay)
			this.elements.totalDisplay.style.display = "none";
	}

	resetDisplay(msg) {
		if (this.elements.totalDisplay)
			this.elements.totalDisplay.style.display = "none";
		if (this.elements.errorDisplay) {
			this.elements.errorDisplay.style.display = "none"; // clear error
		}
		this.disableSubmit(true);
	}

	setLoading(isLoading) {
		if (this.elements.breakdown) {
			this.elements.breakdown.textContent = isLoading ? "Calculating..." : "";
		}
	}

	disableSubmit(disabled) {
		if (this.elements.submitButton) {
			this.elements.submitButton.disabled = disabled;
			this.elements.submitButton.style.opacity = disabled ? "0.5" : "1";
		}
	}
}
