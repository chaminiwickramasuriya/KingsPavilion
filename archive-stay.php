<?php
/**
 * Archive Template for stay
 * Template Name: T02 : Stay
 *
 * @package WordPress
 * @subpackage KingsPavilion
 * @since KingsPavilion 1.0
 */

get_header();
$archive_template = 'archive-stay.php';
$id = get_archive_page_id($archive_template);

$the_title = get_archive_page_id($archive_template);

$content_post       = get_post( $id );
$sub_title = get_field('pg_sub_title', $id);
$pg_heading = get_field('pg_heading', $id);
$introdiscription = apply_filters("the_content", $content_post->post_content);


$enable_banner = get_field('enable_banner',$id);

$parent_title = '';
$parent_id = wp_get_post_parent_id(get_the_ID()); 
if ($parent_id) {
    $parent_title = get_the_title($parent_id, $id); 
}

?>


<?php get_template_part( "inc/inc", "banner" ); ?>


<section id="introduction" class="padding-top--130 padding-bottom--60">
    <div class="wrapper--55">
        <?php if($sub_title || $pg_heading){?>
            <h1 class="creativeheader text-center <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
                <?php _e($pg_heading, "KingsPavilion");?>
            </h1>
            <p class="main-title font-family--dmserif heading--50 font-color--main-color text-center <?php if($introdiscription){ echo 'padding-bottom--40' ;}?> <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
                <?php if($sub_title){
                    _e($sub_title, "KingsPavilion");
                } else{
                    _e('Accommodation', "KingsPavilion");
                } ?>
            </p>
        <?php } else if($sub_title && !$pg_heading){?>
            <h1 class="main-title text-center font-family--dmserif heading--50 font-color--main-color padding-bottom--40 <?php if($introdiscription){ echo 'padding-bottom--40' ;}?> <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
                <?php _e($sub_title, "KingsPavilion");?>
            </h1>
        <?php } else {?>
            <h1 class="main-title text-center font-family--dmserif heading--50 font-color--main-color padding-bottom--40 <?php if($introdiscription){ echo 'padding-bottom--40' ;}?> <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
                <?php _e('Accommodation', "KingsPavilion");?>
            </h1>
        <?php } ?>
        <?php if($introdiscription):?>
        <div class="wysiwig-container text-center <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
            <?php _e($introdiscription, "KingsPavilion"); ?>
        </div>
        <?php endif;?>
    </div>
</section>

<?php
$check_in_time = get_field('check_in_time', $id);
$check_out_time = get_field('check_out_time', $id);

if($check_in_time || $check_out_time):
?>
<section id="checkTime" class="padding-bottom--100">
    <div class="wrapper--40 d-flex justify-content-center align-items-center">
        <div class="svgicon">
            <svg class="icon">
                <use xlink:href="#checko-in"></use>
            </svg>
        </div>
        <div class="checingtime">
            <p class="textcheck font-color--text-color font-family--opensans paragraph--16">Check In</p>
            <p class="timecheck font-color--dark-ash font-family--opensans paragraph--18"><?php _e( $check_in_time, "KingsPavilion");?></p>
        </div>
        <hr>
        <div class="svgicon">
            <svg class="icon">
                <use xlink:href="#checkout"></use>
            </svg>
        </div>
        <div class="checingtime">
            <p class="textcheck font-color--text-color font-family--opensans paragraph--16">Check Out</p>
            <p class="timecheck font-color--dark-ash font-family--opensans paragraph--18"><?php _e( $check_out_time, "KingsPavilion");?></p>
        </div>
    </div>
</section>
<?php endif;?>

<?php 
$terms = get_terms([
    'taxonomy'   => 'room_type',
    'hide_empty' => true,
    'orderby'    => 'menu_order',
    'order'      => 'ASC'
]);
$terms = array_filter($terms, function($term) {
    return strtolower($term->name) !== 'all';
});
if (!empty($terms)): 
?>
<section id="allaccommodations">
    <div class="categoryRoomTypes d-flex justify-content-center align-items-center bg-color--bg-cream padding-top--100">
        <?php 
        $co = 1;
        foreach ($terms as $term):
            $room_title = esc_html($term->name);
            $room_id = sanitize_title($room_title);
        ?>
            <p class="roomtypename font-family--dmserif font-color--main-color paragraph--28">
                <a href="#suitDetails-<?php echo $room_id; ?>" class="font-family--dmserif font-color--main-color paragraph--28">
                    <?php echo $room_title; ?>
                </a>
            </p>
        <?php $co++; endforeach; ?>    
    </div>
    <div class="suitBlocks">
        <?php 
        foreach ($terms as $term):
            $cate_title = esc_html($term->name);
            $cate_id = sanitize_title($cate_title);
        ?>
            <div id="suitDetails-<?php echo $cate_id; ?>" class="juniorsuits">
                <div class="wrapper--92">
                    <p class="suitName text-center font-color--main-color font-family--dmserif heading--50 padding-bottom--60 scroll-element js-scroll movetop">
                        <?php echo $cate_title; ?>
                    </p>
                    <?php
                    $posts = get_posts([
                        'post_type'      => 'stay',
                        'order'          => 'ASC',
                        'posts_per_page' => -1,
                        'tax_query'      => [[
                            'taxonomy' => 'room_type',
                            'field'    => 'slug',
                            'terms'    => $term->slug,
                        ]],
                    ]);
                    ?>
                    <div class="roomTypesPostListing d-flex justify-content-between aign-items-centers flex-wrap">
                        <?php 
                        if (!empty($posts)) {
                            foreach ($posts as $post) {
                            
                            $room_title = esc_html($post->post_title);

                            $hm_room_image = get_field('featured_image');
                            $hm_room_image = ($hm_room_image) ? $hm_room_image : validateImageData($hm_room_image, 860, 600, get_the_title());
                            $hp_room_imgix_param = get_field('feat_imgix_param');
                            $hp_room_img_url = (!empty($hm_room_image['url']) ? $hm_room_image['url'] : 'hhttps://placehold.co/860x600');
                            $hp_room_img_url .= '?w=860&h=600' . (!empty($hp_room_imgix_param) ? '&' . $hp_room_imgix_param : '');

                            $rm_type_amenities = get_field('rm_type_amenities', $post->ID);
                            $permalinkURL = get_permalink($post->ID);
                        ?>
                            <div class="roomStaysPosts half-div--48">
                                <a href="<?php echo esc_url($permalinkURL); ?>" title="Room Detail - <?php _e($room_title, "KingsPavilion");?>">
                                    <div class="imageRoom position-relative">
                                        <img class="large lazyImg" data-imgsrc="<?php echo esc_url($hp_room_img_url); ?>" alt="<?php echo esc_attr($hm_room_image['alt']); ?>">
                                        <div class="inerDetails">
                                            <p class="typename all-caps font-color--white font-family--opensans"><?php _e($cate_title, "KingsPavilion"); ?></p>
                                            <p class="roomname font-family--dmserif font-color--white heading--32"><?php _e($room_title, "KingsPavilion");?></p>
                                        </div>
                                    </div>
                                </a>
                                <?php if($rm_type_amenities):?>
                                <div class="amenitiestypes d-flex justify-content-center align-items-center m-auto mobile-flex-wrap protab-flex-wrap">
                                    <?php foreach($rm_type_amenities as $rm_type_amenity):
                                    $amenity_name = $rm_type_amenity['amenity_name'];
                                    ?>
                                        <p class="amenity_name font-family--opensans font-color--main-color font-weight--400"><?php _e($amenity_name, "KingsPavilion");?></p>
                                        <hr>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif;?>
                                <div class="booknowmoredetailBtn d-flex justify-content-center align-items-center <?php if (empty($rm_type_amenities)){echo 'padding-top--30';}?>"">
                                    <a class="moredetails" href="<?php echo esc_url($permalinkURL); ?>" title="Room Details">ROOM DETAILS</a>
                                    <button class="listingBooking booknowBtn book-widget-open" title="Book Now - Kings Pavilion">Book Now</button>
                                </div>
                            </div> 
                        <?php }
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php 
        endforeach; 
        wp_reset_query();
        wp_reset_postdata();
        ?>    
    </div>
</section>
<?php
endif;
?>

<?php
get_footer();
?>
<script>
jQuery(document).ready(function($) {
    var triggerOffset = $('#allaccommodations').offset().top;

    $(window).on('scroll', function() {
        var scrollPos = $(window).scrollTop();

        if (scrollPos >= triggerOffset - 100) {
            $('.categoryRoomTypes').addClass('active');
        } else {
            $('.categoryRoomTypes').removeClass('active');
        }
    });

    $('.roomtypename a').on('click', function(e) {
        e.preventDefault();

        // Remove active class from all
        $('.roomtypename').removeClass('active');

        // Add active class to the parent <p> of the clicked <a>
        $(this).closest('.roomtypename').addClass('active');

        // Smooth scroll to the target section
        var target = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(target).offset().top - 180 // adjust offset as needed
        }, 800);
    });
});
</script>


<script>
    jQuery(document).ready(function($) {
        $("li#menu-item-630, li#menu-item-270, .menu-item-has-children").addClass("current-menu-item");
    });




</script>