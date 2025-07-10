<?php
/**
 * Booking Widget Template
 */
?>
<div class="book-overlay d-flex"></div>
<div class="booking-widget" data-show-nationality="true" data-show-flexi="true">
    <button class="mobile-el book-widget-open book-widget-open-mobile">
        <img src="<?php bloginfo('template_directory'); ?>/assets/img/close-b.png" alt="Button Close">
    </button>
    <p class="booking-title heading--32 all-caps text-center font-family--opensans font-color--btn-color font-weight--400 padding-bottom--30">ONLINE RESERVATIONS</p>
    <form id="booking-form">
        <div class="form-row">
            <label for="">Check-in - Check-out</label>
            <input class="date-range" name="date-range" type="text" placeholder="Select Dates">
            <div class="error-text date-error" style="color: red; display: none;"></div>
        </div>
        <div class="form-row">
            <label for="">Nationality</label>
            <select name="nationality" class="nationality">
                <option value="">Select Nationality</option>
                <option value="1">Sri Lankan</option>
                <option value="0">Non Sri Lankan</option>
            </select>
            <div class="dropdown nationality-drop">
                <button class="nationality-temp" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Nationality
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" data-value="">Select Nationality</a></li>
                    <li><a class="dropdown-item" href="#" data-value="1">Sri Lankan</a></li>
                    <li><a class="dropdown-item" href="#" data-value="0">Non Sri Lankan</a></li>
                </ul>
            </div>
            <div class="error-text nationality-error" style="color: red; display: none;"></div>
        </div>
        <div class="form-row">
            <label for="">Promo Code</label>
            <input class="promo-code" name="promo" type="text" placeholder="Promo Code">
        </div>
        <div class="form-row">
            <div class="checkbox-wrap">
                <input class="flexi-dates" name="flexi-dates" type="checkbox">
                <label for="">Flexible Dates</label>
            </div>
        </div>
        <div class="form-row form-row-submit">
            <button type="submit" class="booking-submit">Book Now</button>
        </div>
        <div class="form-row error-message" style="display:none; color: red;"></div>
        <p class="best-rate paragraph--18 padding-top--20 m-0 all-caps text-center font-family--opensans font-color--main-color font-weight--600">Best Rate</p>
        <p class="best-rate paragraph--18 all-caps m-0 text-center font-family--dmserifopensans font-color--main-color font-weight--400">Guarantee</p>
    </form>
</div>