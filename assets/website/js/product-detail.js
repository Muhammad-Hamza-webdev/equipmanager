const mainImg = document.querySelector(".product-showcase-main-img img");
const subImgs = document.querySelectorAll(".product-showcase-sub-img img");

subImgs.forEach((img) => {
  img.addEventListener("click", () => {
    // Swap the clicked sub image with the main image
    const tempSrc = mainImg.src;
    mainImg.src = img.src;
    img.src = tempSrc;
  });
});

// calender
document.addEventListener("DOMContentLoaded", () => {
  const yearList = document.querySelector(".year");
  const monthList = document.querySelector(".month");
  const main = document.querySelector(".booking-calender-main");
  const monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  const panel = {
    headerMonth: document.querySelector(".prev-section .month-calender"),
    headerYear: document.querySelector(".prev-section .year-calender"),
    days: document.querySelector(".first-month .days-date"),
  };

  // Parse availability dates in local time to avoid timezone offsets
  function parseAvailabilityDate(dateStr) {
    if (!dateStr || typeof dateStr !== 'string') return null;
    const parts = dateStr.split('-').map((val) => parseInt(val, 10));
    if (parts.length !== 3 || parts.some(Number.isNaN)) return null;
    return new Date(parts[0], parts[1] - 1, parts[2]);
  }

  // Parse availability dates from PHP (supports both equipment and workforce)
  let availableStart = null;
  let availableEnd = null;
  
  // Check for equipment availability first, then workforce availability
  const availabilityData = window.equipmentAvailability || window.workforceAvailability;
  
  if (availabilityData && availabilityData.startDate && availabilityData.endDate) {
    availableStart = parseAvailabilityDate(availabilityData.startDate);
    availableEnd = parseAvailabilityDate(availabilityData.endDate);
    console.log('📅 Availability dates parsed:', { availableStart, availableEnd });
  } else {
    console.warn('⚠️ No availability data found. All dates will be available.');
  }

  // Date selection state
  let selectedStartDate = null;
  let selectedEndDate = null;

  // Expose sync functions for form integration
  window.calendarSync = {
    // Get selected dates
    getSelectedDates: function() {
      return {
        startDate: selectedStartDate,
        endDate: selectedEndDate
      };
    },
    // Set dates from form inputs
    setDates: function(start, end) {
      if (start) {
        const startParts = start.split('-');
        selectedStartDate = {
          year: parseInt(startParts[0]),
          month: parseInt(startParts[1]) - 1,
          day: parseInt(startParts[2])
        };
      }
      if (end) {
        const endParts = end.split('-');
        selectedEndDate = {
          year: parseInt(endParts[0]),
          month: parseInt(endParts[1]) - 1,
          day: parseInt(endParts[2])
        };
      }
      // Re-render calendar
      const currentMonth = monthIndex(panel.headerMonth.textContent);
      const year = +panel.headerYear.textContent;
      updateCalendar(year, currentMonth);
    },
    // Clear selection
    clearSelection: function() {
      selectedStartDate = null;
      selectedEndDate = null;
      const currentMonth = monthIndex(panel.headerMonth.textContent);
      const year = +panel.headerYear.textContent;
      updateCalendar(year, currentMonth);
    },
    // Listen for calendar changes
    onDateSelected: null,
    
    // Debug helper - show current state
    debugState: function() {
      return {
        selectedStartDate: selectedStartDate,
        selectedEndDate: selectedEndDate,
        formattedDates: {
          startDate: formatDateForInput(selectedStartDate),
          endDate: formatDateForInput(selectedEndDate)
        },
        hasCallback: !!this.onDateSelected,
        rentFormExists: !!document.getElementById('rent-form'),
        hiddenInputsExist: !!(document.getElementById('rental_start') && document.getElementById('rental_end'))
      };
    }
  };
  
  console.log('✅ Calendar initialized. Try: window.calendarSync.debugState() in console to check status');

  // Function to format date as YYYY-MM-DD
  function formatDateForInput(dateObj) {
    if (!dateObj) return '';
    const year = dateObj.year;
    const month = String(dateObj.month + 1).padStart(2, '0');
    const day = String(dateObj.day).padStart(2, '0');
    return `${year}-${month}-${day}`;
  }

  // Function to notify form when calendar dates change
  function notifyFormOfDateChange() {
    const formattedDates = {
      startDate: formatDateForInput(selectedStartDate),
      endDate: formatDateForInput(selectedEndDate)
    };
    
    console.log('📅 Calendar Date Change Detected:', {
      selectedStartDate: selectedStartDate,
      selectedEndDate: selectedEndDate,
      formattedDates: formattedDates,
      callbackExists: !!window.calendarSync.onDateSelected
    });
    
    if (window.calendarSync.onDateSelected) {
      try {
        window.calendarSync.onDateSelected(formattedDates);
        console.log('✅ Callback executed successfully');
      } catch (error) {
        console.error('❌ Error in calendar callback:', error);
      }
    } else {
      console.warn('⚠️ No onDateSelected callback registered. Waiting for form binding...');
    }
  }

  // Function to check if a date is available
  function isDateAvailable(year, month, day) {
    if (!availableStart || !availableEnd) return true; // If no restrictions, all dates are available
    const checkDate = new Date(year, month, day);
    return checkDate >= availableStart && checkDate <= availableEnd;
  }

  // Function to compare dates (returns -1, 0, or 1)
  function compareDates(date1, date2) {
    const d1 = new Date(date1.year, date1.month, date1.day);
    const d2 = new Date(date2.year, date2.month, date2.day);
    if (d1 < d2) return -1;
    if (d1 > d2) return 1;
    return 0;
  }

  // Function to calculate days between dates
  function daysBetween(date1, date2) {
    const d1 = new Date(date1.year, date1.month, date1.day);
    const d2 = new Date(date2.year, date2.month, date2.day);
    const diffTime = Math.abs(d2 - d1);
    return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
  }

  // Function to check if a date is in the selected range
  function isDateInRange(year, month, day) {
    if (!selectedStartDate || !selectedEndDate) return false;
    const checkDate = new Date(year, month, day);
    const start = new Date(selectedStartDate.year, selectedStartDate.month, selectedStartDate.day);
    const end = new Date(selectedEndDate.year, selectedEndDate.month, selectedEndDate.day);
    return checkDate >= start && checkDate <= end;
  }

  const monthIndex = (name) =>
    monthNames.findIndex((m) => m.toLowerCase() === name.trim().toLowerCase());

  function render(year, mIndex) {
    const container = panel.days;
    container.innerHTML = "";
    const firstDay = new Date(year, mIndex, 1).getDay();
    const lead = firstDay === 0 ? 6 : firstDay - 1;
    for (let i = 0; i < lead; i++)
      container.innerHTML += '<span class="text-day-num empty"></span>';
    const daysInMonth = new Date(year, mIndex + 1, 0).getDate();
    for (let d = 1; d <= daysInMonth; d++) {
      const available = isDateAvailable(year, mIndex, d);
      const disabledClass = available ? '' : ' disabled';
      
      // Check if this date is selected or in range
      let additionalClasses = '';
      if (selectedStartDate && selectedStartDate.year === year && selectedStartDate.month === mIndex && selectedStartDate.day === d) {
        additionalClasses = ' selected-start';
      } else if (selectedEndDate && selectedEndDate.year === year && selectedEndDate.month === mIndex && selectedEndDate.day === d) {
        additionalClasses = ' selected-end';
      } else if (isDateInRange(year, mIndex, d)) {
        additionalClasses = ' in-range';
      }
      
      container.innerHTML += `<span class="text-day-num${disabledClass}${additionalClasses}" data-day="${d}" data-month="${mIndex}" data-year="${year}">${d}</span>`;
    }
  }

  function updateCalendar(year, monthIndex) {
    render(year, monthIndex);
    panel.headerMonth.textContent = monthNames[monthIndex];
    panel.headerYear.textContent = year;
  }

  function openSelector(type) {
    main.classList.add("hidden");
    yearList.classList.toggle("hide", type !== "year");
    monthList.classList.toggle("hide", type !== "month");
  }

  panel.headerYear.addEventListener("click", () => openSelector("year"));
  panel.headerMonth.addEventListener("click", () => openSelector("month"));

  // ✅ Generate years 2025–2035 with the required classes
  yearList.innerHTML = Array.from(
    { length: 11 },
    (_, i) => `<span class="text-month-name text-dark-gray">${2025 + i}</span>`
  ).join("");

  yearList.addEventListener("click", (e) => {
    if (!e.target.matches("span")) return;
    const y = +e.target.textContent;
    panel.headerYear.textContent = y;
    yearList.classList.add("hide");
    monthList.classList.remove("hide");
  });

  monthList.addEventListener("click", (e) => {
    if (!e.target.matches("span")) return;
    const picked = monthIndex(e.target.textContent);
    const y = +panel.headerYear.textContent || new Date().getFullYear();
    updateCalendar(y, picked);
    monthList.classList.add("hide");
    main.classList.remove("hidden");
  });

  // prev / next buttons
  document.querySelectorAll(".prev, .next").forEach((btn) => {
    btn.addEventListener("click", () => {
      const isNext = btn.classList.contains("next");
      const currentMonth = monthIndex(panel.headerMonth.textContent);
      let year = +panel.headerYear.textContent;
      let newMonth = isNext ? currentMonth + 1 : currentMonth - 1;
      if (newMonth < 0) {
        newMonth = 11;
        year--;
      }
      if (newMonth > 11) {
        newMonth = 0;
        year++;
      }
      updateCalendar(year, newMonth);
    });
  });

  // day active toggle - now handles range selection
  document.addEventListener("click", (e) => {
    if (
      !e.target.classList.contains("text-day-num") ||
      e.target.classList.contains("empty") ||
      e.target.classList.contains("disabled")
    )
      return;
    
    const clickedDate = {
      day: parseInt(e.target.dataset.day),
      month: parseInt(e.target.dataset.month),
      year: parseInt(e.target.dataset.year)
    };
    
    console.log('🖱️ Date clicked:', clickedDate, 'Current state:', {selectedStartDate, selectedEndDate});
    
    // Check if clicking on already selected start date
    if (selectedStartDate && 
        selectedStartDate.day === clickedDate.day &&
        selectedStartDate.month === clickedDate.month &&
        selectedStartDate.year === clickedDate.year) {
      // Deselect start date
      console.log('🗑️ Clearing start date selection');
      selectedStartDate = null;
      selectedEndDate = null;
      const currentMonth = monthIndex(panel.headerMonth.textContent);
      const year = +panel.headerYear.textContent;
      updateCalendar(year, currentMonth);
      notifyFormOfDateChange();
      return;
    }
    
    // Check if clicking on already selected end date
    if (selectedEndDate && 
        selectedEndDate.day === clickedDate.day &&
        selectedEndDate.month === clickedDate.month &&
        selectedEndDate.year === clickedDate.year) {
      // Deselect end date only
      console.log('🗑️ Clearing end date selection');
      selectedEndDate = null;
      const currentMonth = monthIndex(panel.headerMonth.textContent);
      const year = +panel.headerYear.textContent;
      updateCalendar(year, currentMonth);
      notifyFormOfDateChange();
      return;
    }
    
    // If no start date or both dates are set, start fresh
    if (!selectedStartDate || (selectedStartDate && selectedEndDate)) {
      console.log('📍 Setting start date');
      selectedStartDate = clickedDate;
      selectedEndDate = null;
    } else {
      // Second click - set as end date
      const comparison = compareDates(clickedDate, selectedStartDate);
      
      if (comparison === 0) {
        // Same date clicked - do nothing
        console.log('ℹ️ Same date clicked, no action');
        return;
      } else if (comparison < 0) {
        // Clicked date is before start date - swap them
        console.log('🔀 Swapping dates (end before start)');
        selectedEndDate = selectedStartDate;
        selectedStartDate = clickedDate;
      } else {
        // Clicked date is after start date - normal case
        console.log('📍 Setting end date');
        selectedEndDate = clickedDate;
      }
      
      // Validate minimum 2-day rental
      const days = daysBetween(selectedStartDate, selectedEndDate);
      console.log(`📆 Range selected: ${days} days`);
      if (days < 2) {
        console.warn('❌ Less than 2 days selected, clearing');
        toastr.warning('Minimum rental period is 2 days. Please select an end date at least 2 days after the start date.', 'Invalid Selection');
        selectedEndDate = null;
      }
    }
    
    // Re-render calendar to show the selection
    const currentMonth = monthIndex(panel.headerMonth.textContent);
    const year = +panel.headerYear.textContent;
    updateCalendar(year, currentMonth);
    
    // Notify form of date changes
    notifyFormOfDateChange();
  });

  // click outside
  document.addEventListener("click", (e) => {
    if (e.target.closest(".year, .month, .mon-year")) return;
    yearList.classList.add("hide");
    monthList.classList.add("hide");
    main.classList.remove("hidden");
  });

  // initial render
  if (availableStart) {
    // Start with the availability start month
    updateCalendar(availableStart.getFullYear(), availableStart.getMonth());
  } else {
    const now = new Date();
    updateCalendar(now.getFullYear(), now.getMonth());
  }
});
