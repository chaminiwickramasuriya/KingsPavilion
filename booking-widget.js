jQuery(document).ready(function($) {
    
    $(".booking-widget").each(function () {
        const $widget = $(this);
        const $form = $widget.find("form");
    
        const $dateInput = $widget.find(".date-range");
        const $promoInput = $widget.find(".promo-code");
        const $flexiCheckbox = $widget.find(".flexi-dates");
    
        const $nationalitySelect = $widget.find(".nationality");
        const $nationalityTemp = $widget.find(".nationality-temp");
    
        const $dateError = $widget.find(".date-error");
        const $nationalityError = $widget.find(".nationality-error");
    
        let checkIn = '';
        let checkOut = '';
    
        // Get settings from data attributes
        const showNationality = $widget.data("show-nationality") !== false;
        const showFlexi = $widget.data("show-flexi") !== false;
    
        // Hide fields based on config
        if (!showNationality) {
            $widget.find(".form-row:has(.nationality)").hide();
            $widget.find(".nationality-drop").hide();
        }
    
        if (!showFlexi) {
            $widget.find(".form-row:has(.flexi-dates)").hide();
        }
    
        // Init datepicker
        $dateInput.flatpickr({
            mode: "range",
            dateFormat: "d-m-Y",
            minDate: "today",
            onChange: function (selectedDates) {
                if (selectedDates.length === 2) {
                    const isSameDay = selectedDates[0].toDateString() === selectedDates[1].toDateString();
    
                    if (isSameDay) {
                        checkIn = '';
                        checkOut = '';
                        $dateError.text("Check-in and check-out dates cannot be the same.").show();
                        return;
                    }
    
                    checkIn = flatpickr.formatDate(selectedDates[0], "d-m-Y");
                    checkOut = flatpickr.formatDate(selectedDates[1], "d-m-Y");
                    $dateError.hide();
                } else {
                    checkIn = '';
                    checkOut = '';
                    if ((!checkIn && checkOut) || (checkIn && !checkOut)) {
                        $dateError.text("Please select both check-in and check-out dates.").show();
                        hasError = true;
                    } else {
                        $dateError.hide();
                    }
                }
            }
        });
    
        // Handle nationality dropdown
        $widget.find(".dropdown-menu .dropdown-item").on("click", function (e) {
            e.preventDefault();
    
            const value = $(this).data("value");
            const text = $(this).text();
    
            $nationalitySelect.val(value);
            $nationalityTemp.text(text);
    
            $widget.find(".dropdown-menu .dropdown-item").removeClass("active");
            $(this).addClass("active");
    
            if (value !== "") {
                $nationalityError.hide();
            }
        });
    
        // Form submit
        $form.on("submit", function (e) {
            e.preventDefault();
    
            let hasError = false;
            const nationality = $nationalitySelect.val();
            const promo = $.trim($promoInput.val());
            const flexiDates = $flexiCheckbox.is(":checked") ? 1 : 0;
    
            // Validate date
            if (!checkIn || !checkOut) {
                $dateError.text("Please select valid check-in and check-out dates.").show();
                hasError = true;
            } else {
                $dateError.hide();
            }
    
            // Validate nationality if visible
            if (showNationality && !nationality) {
                $nationalityError.text("Please select your nationality.").show();
                hasError = true;
            } else {
                $nationalityError.hide();
            }
    
            if (hasError) return;
    
            // Build URL
            let url = `http://reservations.kingspavilion.com/rooms?pr=1&ci=${checkIn}&co=${checkOut}`;
    
            if (showNationality) {
                url += `&islocal=${nationality}`;
            }
    
            if (showFlexi) {
                url += `&flexidates=${flexiDates}`;
            }
    
            if (promo !== "") {
                url += `&promo=${encodeURIComponent(promo)}`;
            }
    
            window.open(url, '_blank');
    
            // Reset form
            $form[0].reset();
            $nationalitySelect.val('');
            $nationalityTemp.text("Select Nationality");
            $dateInput.val('');
            checkIn = '';
            checkOut = '';
            $dateError.hide();
            $nationalityError.hide();
            $widget.find(".dropdown-menu .dropdown-item").removeClass("active");

            if ($dateInput[0]._flatpickr) {
                $dateInput[0]._flatpickr.clear();
            }
        });
    });


    $(window).scroll(function() {
        var currentScrollTop = $(this).scrollTop();
        if (currentScrollTop > 100) {
            $('.booking-widget').addClass('booking-scrolled');
        } else {
            $('.booking-widget').removeClass('booking-scrolled');
        }
    });

    $(".book-widget-open").on("click", function (e) {
        e.preventDefault();
    
        $(".booking-widget").toggleClass("show");
        $(".book-widget-open").toggleClass("show");
        $(".book-overlay").toggleClass("show");
    });
});