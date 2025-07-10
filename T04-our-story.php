<?php
/**
 * Template Name: T04 : Our Story
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage KingsPavilion
 * @since KingsPavilion 1.0
 */
 
global $blog_id, $post;
get_header();

?>

<section id="introduction" class="padding-top--130 padding-bottom--100">
    <?php get_template_part('inc/inc', 'introduction');?>
</section>


<section id="AllOffers" class="padding-bottom--120">
    <div class="wrapper--80 d-flex justify-content-between align-items-start flex-wrap ">
        <?php
            $page_ids = [];
            $pageid = get_the_ID();
            $top_items = _getSubPages($pageid);
            if ( !empty( $top_items ) ):
            foreach ($top_items as $tikey => $tival ):
            $id = $tival->ID; 
            $page_ids[] = $id;  

            $hm_offer_image = get_field('featured_image', $id);
            $hm_offer_image = ($hm_offer_image) ? $hm_offer_image : validateImageData($hm_offer_image, 700, 770, get_the_title());
            $hp_offer_imgix_param = get_field('feat_imgix_param', $id);
            $hp_offer_img_url = (!empty($hm_offer_image['url']) ? $hm_offer_image['url'] : 'hhttps://placehold.co/700x770');
            $hp_offer_img_url .= '?w=700&h=770' . (!empty($hp_offer_imgix_param) ? '&' . $hp_offer_imgix_param : '');

            $offerhmDesc = get_field('feat_desc', $id);

            $offer_title = get_the_title($id);
        ?> 
            <div class="allOffers position-relative half-div--48">
                <a href="<?php echo esc_url(get_permalink($id)); ?>" title="More Details <?php _e($offer_title, "KingsPavilion");?>">
                    <img class="large lazyImg" data-imgsrc="<?php echo esc_url($hp_offer_img_url); ?>" alt="<?php echo esc_attr($hm_offer_image['alt']); ?>">
                    <div class="inerDetails">
                        <p class="roomname font-family--dmserif font-color--white heading--32 padding-bottom--30"><?php _e($offer_title, "KingsPavilion");?></p>
                        <p class="offersmoredetails moredetails all-caps font-family--opensans font-color--white"> More Details</p>
                    </div>
                    <div class="hoverDescription">
                        <p class="roomnameH font-family--dmserif font-color--white heading--32 padding-bottom--30"><?php _e($offer_title, "KingsPavilion");?></p>
                        <div class="discriptionofer padding-bottom--30"><?php _e($offerhmDesc, "KingsPavilion");?></div>
                        <p class="offersmoredetailsH moredetails all-caps font-family--opensans font-color--white"> More Details</p>
                    </div>
                </a>
            </div>
        <?php
            endforeach;
            endif;            
        ?>
    </div>
</section>



<?php get_footer();?>

<script>
    jQuery(document).ready(function($) {
        $("li#menu-item-274 a , li.page-item-258 a").addClass("active");
    });
</script>