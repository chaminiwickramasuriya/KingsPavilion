<?php
global $post;
if (is_category() || is_tag() || is_tax()) {
    $term = get_queried_object();
    $id = $term->term_id;
} elseif ($post) {
    $id = get_the_ID();
}
$enable_banner = get_field('enable_banner',$id);
$logo = get_field('site_logo', 'option');

?>
<div class="IBEWidget">
    <?php get_template_part('template-parts/content', 'booking-widget'); ?>
</div>
<header class="header <?php if(!$enable_banner && !(is_front_page()) && !(is_archive('archive-stay.php'))){ echo "no-banners"; } ?>" id="header">
    <div class="wrapper--92 mainheaderdiv">
        <div class="hamburg-menu width--200" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
            <svg class="icon">
                <g id="Group 802">
                    <rect id="Rectangle 82" width="37" height="1.5" fill="white"></rect>
                    <rect id="Rectangle 83" y="12" width="37" height="1.5" fill="white"></rect>
                    <rect id="Rectangle 84" y="24" width="37" height="1.5" fill="white"></rect>
                </g>
            </svg>
        </div>   
        <div class="logoheader">
            <a class="d-flex" href="<?php echo site_url(); ?>" title="Kings Pavilion">   
                <img src="<?php echo $logo["url"]; ?>" alt="<?php echo $logo["alt"]; ?>">
            </a>
        </div>
        <div class="hederbooknow site-btn bk-now width--200">
            <button class="BooknowBtn next-btn next-btn--white-line desktop_tab_el book-widget-open">
                <span class="btn-next">BOOK NOW</span>
                <span class="btn-close-btn">CLOSE</span>
            </button>
        </div>
    </div>    
</header>

<div class="fixedHeaderMenu <?php if(!$enable_banner && !(is_front_page()) && !(is_archive('archive-stay.php'))){ echo "fixednobanner"; } ?>">
    <div class="wrapper--92 d-flex justify-content-between align-items-center">
        <div class="logoheader width--200 d-flex align-items-center justify-content-start">
            <div class="hamburg-menu-mobile" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" role="button" aria-controls="offcanvasMenu">
                <img src="<?php bloginfo('template_directory'); ?>/assets/img/hamburgericon.png" alt="hamburger icon">
            </div>
            <a class="logoicon d-flex margin-left--20" href="<?php echo site_url(); ?>" title="Kings Pavilion">   
                <img src="<?php echo $logo["url"]; ?>" alt="<?php echo $logo["alt"]; ?>">
            </a>
        </div>
        <div class="fixedmenubar">
            <?php  
                $args =  array(
                    "theme_location"    => "fixed-menu", 
                    "menu_id"           => "", 
                    "menu_class"        => "",
                    "container"         => false
                    ); 
                wp_nav_menu( $args );
            ?>            
        </div>
        <div class="fixedhederbooknow width--200">
            <button class="BooknowBtn next-btn next-btn--white-line desktop_tab_el book-widget-open">
                <span class="btn-next">BOOK NOW</span>
                <span class="btn-close-btn">CLOSE</span>
            </button>
        </div>
    </div>
</div>


<div class="offcanvas offcanvas-start bg-color--text-color" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
    <div class="offcanvas-header bg-color--dark-cream">
        <div class="text-reset close-btn" data-bs-dismiss="offcanvas" aria-label="Close">
            <svg class="icon">
                <use xlink:href="#Hamburger-close"></use>
            </svg>
        </div>
    </div>
    <div class="offcanvas-body bg-color--lightcream" data-lenis-prevent>
        <div class="offmenu_top">
            <?php  
                $args =  array(
                    "theme_location"    => "hamburger-main-menu", 
                    "menu_id"           => "", 
                    "menu_class"        => "navbar-nav",
                    "container"         => false,
                    "walker"         => new Hamburger_Menu_Walker()
                    ); 
                wp_nav_menu( $args );
            ?>
            <hr>
            <?php  
                $args =  array(
                    "theme_location"    => "hamburger-bottom-menu", 
                    "menu_id"           => "", 
                    "menu_class"        => "",
                    "container"         => false
                    ); 
                wp_nav_menu( $args );
            ?>
        </div>  
    </div>
</div>

<div class="reservationMenuFixMobile d-none">
    <div class="reserveBtnMobile">
        <button class="BooknowBtn next-btn next-btn--white-line desktop_tab_el book-widget-open">
            <span class="btn-next">BOOK NOW</span>
            <span class="btn-close-btn">CLOSE</span>
        </button>
    </div>   
</div>





<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggles = document.querySelectorAll('.submenu-toggle');

    toggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            const parent = this.closest('li');
            const submenu = parent.querySelector('.sub-menu');

            // Close all open items except the one being clicked
            document.querySelectorAll('#offcanvasMenu li.menu-item-has-children.open').forEach(item => {
                if (item !== parent) {
                    item.classList.remove('open');
                    const openSub = item.querySelector('.sub-menu');
                    if (openSub) openSub.style.maxHeight = null;
                }
            });

            // Toggle current one
            if (submenu) {
                const isOpen = parent.classList.contains('open');
                if (isOpen) {
                    submenu.style.maxHeight = null;
                    parent.classList.remove('open');
                } else {
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    parent.classList.add('open');
                }
            }
        });
    });
});
</script>


<?php 
if(!is_archive('archive-stay.php')):
get_template_part( "inc/inc", "banner" ); 
endif;
?>