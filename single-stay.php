<?php
/**
 * Template Name: T03 : Stay Inner
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage KingsPavilion
 * @since KingsPavilion 1.0
 */
 
global $blog_id, $post;
get_header();

$room_gallery = get_field('room_gallery');
?>

<?php
$creative_header = get_field('creative_header');
$sub_title = get_field('pg_sub_title');
$pg_heading = get_field('pg_heading');
$introdiscription = apply_filters( "the_content" , $post->post_content );

$enable_banner = get_field('enable_banner',$id);

$parent_id = get_the_terms( get_the_ID(), 'room_type' );
if ( ! empty( $parent_id ) && ! is_wp_error( $parent_id ) ) {
    $parent_title = esc_html( $parent_id[0]->name );
}
?>
<section id="introduction" class="padding-top--130 padding-bottom--100">
    <div class="wrapper--55">
        <?php if($sub_title || $pg_heading){?>
            <h1 class="creativeheader text-center <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
                <?php _e($pg_heading, "KingsPavilion");?>
            </h1>
            <p class="main-title font-family--dmserif heading--50 font-color--main-color text-center <?php if($introdiscription){ echo 'padding-bottom--40' ;}?> <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
                <?php if($sub_title){
                    _e($sub_title, "KingsPavilion");
                } else{
                    echo get_the_title();
                } ?>
            </p>
        <?php } else if($sub_title && !$pg_heading){?>
            <h1 class="main-title text-center font-family--dmserif heading--50 font-color--main-color padding-bottom--40 <?php if($introdiscription){ echo 'padding-bottom--40' ;}?> <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
                <?php _e($sub_title, "KingsPavilion");?>
            </h1>
        <?php } else {?>
            <h1 class="main-title text-center font-family--dmserif heading--50 font-color--main-color padding-bottom--40 <?php if($introdiscription){ echo 'padding-bottom--40' ;}?> <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
                <?php echo get_the_title();?>
            </h1>
        <?php } ?>
        <?php if($introdiscription):?>
        <div class="wysiwig-container text-center <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
            <?php _e($introdiscription, "Layanlife"); ?>
        </div>
        <?php endif;?>
    </div>
</section>


<?php
$disabled_key_features = get_field('disabled_key_features');
$key_features = get_field('key_features');
$book_now_button_link = get_field('ibe_base_url', 'option');

if(!$disabled_key_features):
?>
<section id="keyFeatures" class="<?php if(!$room_gallery){echo 'padding-bottom--100' ;}?>">
    <div class="wrapper--60">
        <div class="keyfeaturesIcons d-flex justify-content-center align-items-center flex-wrap mobile-flex-column mobile-align-start">
            <?php
                if(!empty($key_features)):
                foreach($key_features as $key_featuresItems):
                $key_feature_icon_id = $key_featuresItems['key_feature_icon_id'];
                $key_feature_icon_text = $key_featuresItems['key_feature_icon_text'];
            ?>
                <div class="featureIconstext tab-width--33 padding-bottom--60 d-flex  justify-content-center align-items-center flex-wrap mobile-justify-content-start mobile-align-start">
                    <svg class="icon <?php _e($key_feature_icon_id, "KingsPavilion");?>">
                        <use xlink:href="#<?php _e($key_feature_icon_id, "KingsPavilion");?>"></use>
                    </svg>
                    <p class="textFeatureIcon padding-left--15 font-family--opensans font-color--text-color paragraph--20 title-case">
                        <?php _e($key_feature_icon_text, "KingsPavilion");?>
                    </p>
                </div>
            <?php 
            endforeach;
            endif;
            ?>
        </div>        
        <?php if($book_now_button_link):?>
            <a href="<?php echo esc_url($book_now_button_link); ?>" class="booknowBtn m-auto" target="_blank" title="Book Now - Kings Pavilion">Book Now</a>
        <?php else: ?>
            <button class="listingBooking booknowBtn book-widget-open m-auto" title="Book Now - Kings Pavilion">Book Now</button>
        <?php endif;?>
    </div>
</section>
<?php endif; ?>


<?php 
$room_gallery_image_param = get_field('room_gallery_image_param');

// Ensure $room_gallery is an array with valid images
if (!empty($room_gallery) && is_array($room_gallery)) : ?>
<section id="aboutGallery" class="padding-bottom--100 padding-top--100">
    <div class="wrapper--85">
        <div class="gal-img two-item-slider">
            <?php foreach ($room_gallery as $gallery_image): 
                $img_url = !empty($gallery_image['url']) ? $gallery_image['url'] : 'hhttps://placehold.co/780x550';
                $img_alt = !empty($gallery_image['alt']) ? $gallery_image['alt'] : get_the_title();

                // Add image parameters
                $separator = (strpos($img_url, '?') !== false) ? '&' : '?';
                $img_url .= $separator . 'w=780&h=550';
                if (!empty($room_gallery_image_param)) {
                    $img_url .= '&' . ltrim($room_gallery_image_param, '&');
                }
            ?>
                <div>
                    <div class="slide-item">
                        <img class="large gal-img-slider" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                    </div> 
                </div> 
            <?php endforeach; ?>          
        </div>
    </div>
</section>
<?php endif; ?>


<?php 
$amenity_title = get_field('amenity_title');

// Get the selected amenity_type terms for this stay post
$terms = get_the_terms(get_the_ID(), 'amenity_type');

if (!empty($terms) && !is_wp_error($terms)): 
?>
<section id="amenityfacility" class="bg-color--bg-cream padding-top--85 padding-bottom--85">
    <div class="wrapper--60">
        <p class="amenitytitlefacility heading--32 text-center font-family--dmserif font-color--main-color">
            <?php _e($amenity_title, "KingsPavilion");?>
        </p>
        <ul class="amenitynames">
            <?php 
            foreach ($terms as $term):
                $term_name = esc_html($term->name);
            ?>
                <li class="txtamnity padding-bottom--20 font-family--opensans font-color--main-color paragraph--20">
                    <?php _e($term_name, "KingsPavilion");?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
<?php endif; ?>





<section id="otherStays" class="padding-top--115 padding-bottom--120">
    <div class="wrapper--85">
        <h2 class="text-center font-family--dmserif heading--50 font-color--main-color padding-bottom--40 scroll-element js-scroll movetop">
            Other Stays
        </h2>
        <div class="otherstaysSlide three-item-slider">
            <?php
            $current_post_id = get_the_ID();
            $args = array(
                'post_type'      => 'stay',
                'order'          => 'ASC',
                'posts_per_page' => -1,
                'post__not_in'   => [$current_post_id],
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'room_type',
                        'field'    => 'slug',
                        'operator' => 'EXISTS',
                    ),
                ),
            );

            $accommodation_posts = get_posts($args);

            if (!empty($accommodation_posts)) :
                foreach ($accommodation_posts as $post) :
                    setup_postdata($post);

                    $room_title       = get_the_title();
                    $permalinkURL     = get_permalink($post->ID);
                    $hm_room_image    = get_field('featured_image', $post->ID);
                    $hm_room_image    = ($hm_room_image) ? $hm_room_image : validateImageData($hm_room_image, 510, 600, $room_title);
                    $hp_room_imgix_param = get_field('feat_imgix_param', $post->ID);
                    $hp_room_img_url  = (!empty($hm_room_image['url']) ? $hm_room_image['url'] : 'hhttps://placehold.co/510x600');
                    $hp_room_img_url .= '?w=510&h=600' . (!empty($hp_room_imgix_param) ? '&' . $hp_room_imgix_param : '');

                    $rm_type_amenities = get_field('rm_type_amenities', $post->ID);
            ?>
                <div class="slide-item">
                    <div class="roomStaysPosts">
                        <a href="<?php echo esc_url($permalinkURL); ?>" title="Room Detail - <?php echo esc_attr($room_title); ?>">
                            <div class="imageRoom position-relative">
                                <img class="large" src="<?php echo esc_url($hp_room_img_url); ?>" alt="<?php echo esc_attr($room_title); ?>">
                                <div class="inerDetails">
                                    <p class="typename all-caps font-color--white font-family--opensans">
                                        <?php
                                       $terms = get_the_terms($post->ID, 'room_type');
                                       if (!empty($terms) && !is_wp_error($terms)) {
                                           foreach ($terms as $term) {
                                               _e(esc_html($term->name), "KingsPavilion");
                                           }
                                       }                                       
                                        ?>
                                    </p>
                                    <p class="roomname font-family--dmserif font-color--white heading--32">
                                        <?php _e($room_title,"KingsPavilion"); ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                        <?php if (!empty($rm_type_amenities)) : ?>
                            <div class="amenitiestypes d-flex justify-content-center align-items-center m-auto mobile-flex-wrap tab-flex-wrap protab-flex-wrap">
                                <?php foreach ($rm_type_amenities as $index => $amenity) : ?>
                                    <p class="amenity_name font-family--opensans font-color--main-color font-weight--400">
                                        <?php echo esc_html($amenity['amenity_name']); ?>
                                    </p>
                                    <?php if ($index !== array_key_last($rm_type_amenities)) : ?>
                                        <hr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="booknowmoredetailBtn d-flex justify-content-center align-items-center <?php if (empty($rm_type_amenities)){echo 'padding-top--30';}?>">
                            <a class="moredetails" href="<?php echo esc_url($permalinkURL); ?>" title="Room Details - <?php echo esc_attr($room_title); ?>">ROOM DETAILS</a>
                            <?php if($book_now_button_link):?>
                                <a href="<?php echo esc_url($book_now_button_link); ?>" class="booknowBtn" target="_blank" title="Book Now - Kings Pavilion">Book Now</a>
                                <?php else: ?>
                                    <button class="listingBooking booknowBtn book-widget-open" title="Book Now - Kings Pavilion">Book Now</button>
                                <?php endif;?>
                        </div>
                    </div>
                </div>
            <?php
                endforeach;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>



<?php get_footer();?>


<script>
    jQuery(document).ready(function($) {
        $("li#menu-item-630, li#menu-item-270, .menu-item-object-stay.current-menu-item").addClass("current-menu-item");
        $('.menu-item-object-stay.current-menu-item a').addClass('active');
    });
</script>
