<?php
/**
 * Template Name: T05 : Offers Inner
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage KingsPavilion
 * @since KingsPavilion 1.0
 */
 
global $blog_id, $post;
get_header();

?>

<section id="introduction" class="OffersIntroduction position-relative padding-top--70 padding-bottom--70 bg-color--bg-cream">
    <?php get_template_part('inc/inc', 'introduction');?>
</section>


<?php
$disable_offer_inner_details = get_field('disable_offer_inner_details');
$offers_inner_main_image = get_field('offers_inner_main_image', $id);
$offers_inner_main_image = ($offers_inner_main_image) ? $offers_inner_main_image : validateImageData($offers_inner_main_image, 700, 840, get_the_title());
$offerinner_image_param = get_field('offerInner_image_param', $id);
$offer_nner_img_url= (!empty($offers_inner_main_image['url']) ? $offers_inner_main_image['url'] : 'hhttps://placehold.co/700x840');
$offer_nner_img_url.= '?w=700&h=840' . (!empty($offerinner_image_param) ? '&' . $offerinner_image_param : '');

$offer_inner_details = get_field('offer_inner_details');
$book_now_button_link = get_field('offers_book_now_link');
$value_addition_details = get_field('value_addition_details');
if(!$disable_offer_inner_details):
?>
<section id="offerDetails" class="padding-top--100 padding-bottom--100">
    <div class="wrapper--83-left d-flex justify-content-between align-items-start tab-flex-column mobile-flex-column">
        <div class="half-div--44 tab-width--100">
            <img class="large lazyImg" data-imgsrc="<?php echo esc_url($offer_nner_img_url); ?>" alt="<?php echo esc_attr($offers_inner_main_image['alt']); ?>">
        </div>
        <div class="half-div--50 tab-width--100 tab-padding-top--30 mobile-padding-top--30">
            <div class="wysiwig-container">
                <?php _e($offer_inner_details, "KingsPavilion");?>
            </div>            
            <?php if($book_now_button_link):?>
                <a href="<?php echo esc_url($book_now_button_link); ?>" class="booknowBtn m-0 mobile-margin-auto tab-margin-auto" target="_blank" title="Book Now - Kings Pavilion">Book Now</a>
            <?php endif;?>
        </div>
    </div>
</section>
<?php endif;
if($disable_offer_inner_details):
$offer_image = get_field('offer_image', $id);
$offer_image = ($offer_image) ? $offer_image : validateImageData($offer_image, 1420, 600, get_the_title());
$offerInner_cdn_param = get_field('offerInner_cdn_param', $id);
$offer_img_url= (!empty($offer_image['url']) ? $offer_image['url'] : 'hhttps://placehold.co/1420x600');
$offer_img_url.= '?w=1420&h=600' . (!empty($offerInner_cdn_param) ? '&' . $offerInner_cdn_param : '');    
?>
<section id="offerDetails" class="OffersIntroduction position-relative bg-color--bg-cream padding-bottom--100">
    <div class="wrapper--70">
        <img class="large z-top" src="<?php echo esc_url($offer_img_url); ?>" alt="<?php echo esc_attr($offer_image['alt']); ?>">
    </div>
</section>
<?php endif;?>



<?php if($value_addition_details):?>
<section id="ExclusiveValues" class="position-relative padding-bottom--70 padding-top--100 bg-color--bg-cream">
    <div class="wrapper--60">
        <div class="wysiwig-container">
            <?php _e($value_addition_details, "KingsPavilion");?>
        </div>    
    </div>          
</section>
<?php endif;?>

<?php get_footer();?>


<script>
    jQuery(document).ready(function($) {
        $("li#menu-item-631").addClass("current-menu-item");
        $("li.current-menu-ancestor li.current_page_item").addClass("active");
    });
</script>
