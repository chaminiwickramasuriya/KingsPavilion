<?php
/**
 * Template Name: T04 : Offers
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage KingsPavilion
 * @since KingsPavilion 1.0
 */

global $blog_id, $post;
get_header();

$page_id = get_the_ID();
$sub_title = get_field('pg_sub_title');
$pg_heading = get_field('pg_heading');
$introdiscription = apply_filters( "the_content" , $post->post_content );
$enable_banner = get_field('enable_banner', $page_id);
$no_offers_description = get_field('no_offers_description');

$scroll_class = $enable_banner ? 'scroll-element js-scroll movetop' : '';
$heading_class = $introdiscription ? 'padding-bottom--40' : '';
$parent_title = '';
$parent_id = wp_get_post_parent_id($page_id);
if ($parent_id) {
    $parent_title = get_the_title($parent_id);
}

$offers = _getSubPages($page_id);
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
        <div class="wysiwig-container text-center <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
            <?php
            if(!empty($offers)){
                _e($introdiscription, "KingsPavilion");                               
            }else{
                _e($no_offers_description, "KingsPavilion"); 
            }?>
        </div>
    </div>
</section>

<section id="AllOffers" class="padding-bottom--120">
    <div class="wrapper--80 d-flex justify-content-between align-items-start flex-wrap protab-align-start tab-align-start mobile-align-start">
        <?php if (!empty($offers)): ?>
            <?php foreach ($offers as $offer): 
                $offer_id = $offer->ID;
                $offer_title = get_the_title($offer_id);
                $offer_link = get_permalink($offer_id);
                $offer_desc = get_field('feat_desc', $offer_id);

                $image = get_field('featured_image', $offer_id);
                if (!$image) {
                    $image = validateImageData(null, 700, 770, $offer_title);
                }
                $img_url = !empty($image['url']) ? $image['url'] : 'hhttps://placehold.co/700x770';
                $imgix_param = get_field('feat_imgix_param', $offer_id);
                $img_url .= '?w=700&h=770' . (!empty($imgix_param) ? "&$imgix_param" : '');
                $img_alt = $image['alt'] ?? $offer_title;
            ?>
                <div class="allOffers position-relative half-div--48">
                    <a href="<?php echo esc_url($offer_link); ?>" title="More Details <?php echo esc_attr($offer_title); ?>">
                        <img class="large" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        <div class="inerDetails">
                            <p class="roomname font-family--dmserif font-color--white heading--32 padding-bottom--30"><?php echo esc_html($offer_title); ?></p>
                            <p class="offersmoredetails moredetails all-caps font-family--opensans font-color--white"><?php esc_html_e('More Details', 'KingsPavilion'); ?></p>
                        </div>
                        <div class="hoverDescription">
                            <p class="roomnameH font-family--dmserif font-color--white heading--32 padding-bottom--30"><?php echo esc_html($offer_title); ?></p>
                            <div class="discriptionofer padding-bottom--30"><?php echo esc_html($offer_desc); ?></div>
                            <p class="offersmoredetailsH moredetails all-caps font-family--opensans font-color--white"><?php esc_html_e('More Details', 'KingsPavilion'); ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
