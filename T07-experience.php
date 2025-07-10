<?php
/**
 * Template Name: T07 : Experience
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage KingsPavilion
 * @since KingsPavilion 1.0
 */
 
global $blog_id, $post;
get_header();

?>


<section id="introduction" class="padding-top--130 padding-bottom--70">
    <?php get_template_part('inc/inc', 'introduction');?>
</section>

<?php
$download_pdf_text = get_field('download_button_text');
$brochure_id = get_field('download_pdf_id');
$_download_page_id      = _getTplPageID('view_download');
$_download_page_link    = get_permalink( $_download_page_id );
$brochure_download_link     = ( isset( $brochure_id )  ? $_download_page_link .'?id='.$brochure_id : "" );
if($brochure_id):
?>
<section id="downloadBtnExpo" class="padding-bottom--100">
    <div class="wrapper--55">
        <div class="readMoreBtn m-auto">
            <a class="downloadBtn m-auto" href="<?php echo esc_url($brochure_download_link);?>" title="DOWNLOAD BROCHURE" target="_blank"><?php _e($download_pdf_text, "KingsPavilion");?></a>
        </div>
    </div>
</section>
<?php endif;?>

<?php
$side_by_side_block = get_field('side_by_side_block');
if(!empty($side_by_side_block)):
?>
<section id="experienceBlock">
    <div class="wrapper--80">
        <?php 
        foreach($side_by_side_block as $sideBlocks):
        $side_image = $sideBlocks['side_image'];
        $side_image = ($side_image) ? $side_image : validateImageData($side_image, 750, 600, get_the_title());
        $side_image_cdn_param = $sideBlocks['side_image_cdn_param'];
        $side_img_url = (!empty($side_image['url']) ? $side_image['url'] : 'hhttps://placehold.co/750x600');
        $side_img_url .= '?w=750&h=600' . (!empty($side_image_cdn_param) ? '&' . $side_image_cdn_param : '');

        $side_block_title = $sideBlocks['side_block_title'];
        $side_block_description = $sideBlocks['side_block_description'];
        $side_block_sub_text = $sideBlocks['side_block_sub_text'];
        $select_data_text = $sideBlocks['select_data_text'];

        $link_url_text = $sideBlocks['link_url_text'];
        $sideblock_link_url = $sideBlocks['sideblock_link_url'];
        $data_text_name = $sideBlocks['data_text_name'];

        $select_if_need_to_add_video = $sideBlocks['select_if_need_to_add_video'];
        $video_link = $sideBlocks['video_link'];

        $download_pdf_id_expo = $sideBlocks['download_pdf_id_expo'];
        $download_pdf_text_expo = $sideBlocks['download_pdf_text_expo'];
        $_download_pdf_page_id      = _getTplPageID('view_download');
        $_download_pdf_page_link    = get_permalink( $_download_pdf_page_id );
        $brochure_download_pdf_link     = ( isset( $download_pdf_id_expo )  ? $_download_pdf_page_link .'?id='.$download_pdf_id_expo : "" );
        ?>
        <div class="sidebysideBlock d-flex justify-content-between align-items-center padding-bottom--100 protab-flex-column mobile-flex-column">
            <div class="half-div--49 expoImage <?php if($select_if_need_to_add_video){ echo 'vedioheight';}?> protab-padding-bottom--30 mobile-padding-bottom--30 scroll-element js-scroll slideIn toptobottom">
                <?php if(!$select_if_need_to_add_video){?>
                    <img class="large lazyImg" data-imgsrc="<?php echo esc_url($side_img_url); ?>" alt="<?php echo esc_attr($side_image['alt']); ?>">
                <?php } else {?>
                    <video class="video-player w-100" autoplay muted loop playsinline preload="metadata" poster="hhttps://placehold.co/750x600">
                        <source src="<?php echo esc_url($video_link); ?>" type="video/mp4">
                    </video>
                <?php }?>
            </div>
            <div class="half-div--46 descriptionBlock">
                <div class="blocktext heading--32 font-family--dmserif font-color--main-color padding-bottom--30 mobile-text-center tab-text-center protab-text-center"><?php _e($side_block_title, "KingsPavilion");?></div>
                <div class="descriptiontext paragraph--20 font-family--opensans font-color--text-color padding-bottom--30 mobile-text-center tab-text-center protab-text-center"><?php _e($side_block_description, "KingsPavilion");?></div>
                <?php
                if (in_array('link', $select_data_text)):
                ?>
                    <a class="moredetails font-color--text-color font-weight--400 m-auto mobile-margin-auto tab-margin-auto mobile-display-flex tab-display-flex" href="<?php echo esc_url($sideblock_link_url); ?>" title="<?php _e($link_url_text, "KingsPavilion");?>">
                        <?php _e($link_url_text, "KingsPavilion");?>
                    </a>
                <?php endif;
                if (in_array('text', $select_data_text)):
                ?>
                    <?php if($side_block_sub_text){?> 
                        <p class="subtext font-color--btn-color font-family--opensans title-case paragraph--16 padding-bottom--15 mobile-text-center  tab-text-center protab-text-center">
                            <?php _e($side_block_sub_text, "KingsPavilion");?>
                        </p>
                    <?php }?>
                    <p class="dataText heading--32 font-family--dmserif font-color--btn-color mobile-text-center tab-text-center protab-text-center">
                        <?php _e($data_text_name, "KingsPavilion");?>
                    </p>
                <? endif;
                if (in_array('pdf', $select_data_text)):
                ?>
                    <a class="downloadBtn m-0 mobile-margin-auto tab-margin-auto protab-margin-auto" href="<?php echo esc_url($brochure_download_pdf_link);?>" title="<?php _e($download_pdf_text_expo, "KingsPavilion");?>">
                        <?php _e($download_pdf_text_expo, "KingsPavilion");?>
                    </a>
                <?php endif;?>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</section>
<?php endif;?>

<?php get_footer();?>