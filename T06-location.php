<?php
/**
 * Template Name: T06 : Location
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage KingsPavilion
 * @since KingsPavilion 1.0
 */
 
global $blog_id, $post;
get_header();

?>


<section id="introduction" class="padding-top--130 padding-bottom--30">
    <?php get_template_part('inc/inc', 'introduction');?>
</section>

<?php 
$ba_location_text = get_field('ba_location_text');
$ba_location_miles = get_field('ba_location_miles');
$kt_location_text = get_field('kt_location_text');
$kt_location_miles = get_field('kt_location_miles');
?>
<section id="locationBlocks" class="padding-bottom--100">
    <div class="wrapper--45">
        <div class="two-item-grid d-flex justify-content-center align-items-center mobile-flex-column">
            <?php if($ba_location_text):?>
            <div class="list-item d-flex justify-content-center align-items-center mobile-justify-content-start">
                <svg class="icon">
                    <use xlink:href="#airplane"></use>
                </svg>
                <div class="itemicon">                    
                    <p class="baLocateText font-family--opensans paragraph--16 font-color--text-color font-weight--600 padding-bottom--5"><?php _e($ba_location_text, "KingsPavilion");?></p>
                    <p class="baLicateMile font-family--opensans paragraph--16 font-color--text-color font-weight--400"><?php _e($ba_location_miles, "KingsPavilion");?></p>
                </div>
            </div>
            <?php 
            endif;
            if($kt_location_text):?>
            <div class="list-item d-flex justify-content-center align-items-center mobile-justify-content-start">
                <svg class="icon">
                    <use xlink:href="#train"></use>
                </svg>
                <div class="itemicon">                    
                    <p class="baLocateText font-family--opensans paragraph--16 font-color--text-color font-weight--600 padding-bottom--5"><?php _e($kt_location_text, "KingsPavilion");?></p>
                    <p class="baLicateMile font-family--opensans paragraph--16 font-color--text-color font-weight--400"><?php _e($kt_location_miles, "KingsPavilion");?></p>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</section>

<?php
$google_map_url = get_field('google_map_url');
if($google_map_url):
?>
<section id="googlemap" class="padding-bottom--100">
    <div class="wrapper--65">
        <iframe src="<?php _e($google_map_url, "kingsPavilion");?>" width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>
<?php endif;?>

<?php
$location_details = get_field('location_details');
if($location_details):
?>
<section id="MapDetails" class="padding-bottom--100">
    <div class="wrapper--45">
        <div class="wysiwig-container">
            <?php _e($location_details, "KingsPavilion");?>
        </div>
    </div>
</section>
<?php endif;?>


<?php 
$near_by_title = get_field('near_by_title');
?>
<section id="nearAttractions" class="padding-bottom--100">
    <div class="wrapper--75">
        <p class="font-family--dmserif font-color--main-color heading--50 title-case text-center padding-bottom--50"><?php _e($near_by_title, "KingsPavilion");?></p>
        <div class="three-item-grid d-flex justify-content-center flex-wrap">
            <?php
                $args = array('post_type' => 'cpt_location', 'order' => 'ASC', 'orderby' => 'menu_order', 'posts_per_page' => -1, 'post__not_in' => array(725));
                $loop = new WP_Query($args);
                if ($loop->have_posts()) : $n = 1;
                while ($loop->have_posts()) : $loop->the_post();

                $hm_locate_image = get_field('featured_image');
                $hm_locate_image = ($hm_locate_image) ? $hm_locate_image : validateImageData($hm_locate_image, 450, 285, get_the_title());
                $hp_locate_imgix_param = get_field('feat_imgix_param');
                $hp_locate_img_url = (!empty($hm_locate_image['url']) ? $hm_locate_image['url'] : 'hhttps://placehold.co/450x285');
                $hp_locate_img_url .= '?w=450&h=285' . (!empty($hp_locate_imgix_param) ? '&' . $hp_locate_imgix_param : '');

                $location_name = get_field('location_name');
                $introdiscription = apply_filters( "the_content" , $post->post_content );
            ?>
                <div class="list-item <?php if(!$introdiscription){ echo 'padding-bottom--30';}?> scroll-element js-scroll fade-bottom" style="--i: <?php echo $n; ?>;">
                    <div class="box-locatewrap">
                        <img class="large lazyImg" data-imgsrc="<?php echo esc_url($hp_locate_img_url); ?>" alt="<?php echo esc_attr($hm_locate_image['alt']); ?>">
                        <p class="title-locate font-family--dmserif font-color--main-color font-weight--400 heading--32 padding-top--30 mobile-text-center"><?php _e(get_the_title(), "KingsPavilion");?><span class="font-family--dmserif font-color--main-color font-weight--400">/ <?php _e($location_name, "KingsPavilion");?></span> </p> 
                        <?php if($introdiscription):?>
                            <div class="wysiwig-container text-left mobile-text-center">
                                <?php _e($introdiscription, "Layanlife"); ?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            <?php
                $n++;
                endwhile;
                endif;
                wp_reset_query();
                wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<?php get_footer();?>