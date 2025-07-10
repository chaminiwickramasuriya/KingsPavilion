<?php
/**
 * Template Name: T11 : Gallery
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Renew By Authenticities
 * @since Renew By Authenticities 1.0
 */

global $post, $blog_id;
get_header();

?>

<section id="introduction" class="padding-top--130 padding-bottom--70">
    <?php get_template_part('inc/inc', 'introduction');?>
</section>

<section id="GalleryPg" class="padding-bottom--100">
    <div class="wrapper--92 tabsGallery">
        <?php
        $args = array('post_type' => 'cpt_gallery', 'order' => 'ASC', 'posts_per_page' => -1);
        $loop = new WP_Query($args);

        if ($loop->have_posts()) :
            $n = 1;
            $tab_items = [];
            while ($loop->have_posts()) : $loop->the_post();
                $tab_title = get_the_title();
                $tab_items[] = [
                    'index' => $n,
                    'title' => $tab_title
                ];
                $n++;
            endwhile;
        ?>

            <!-- Mobile Dropdown -->
            <select class="form-select d-md-none mb-4  heading--18" id="GalleryTabsSelect" aria-label="Select gallery tab">
                <?php foreach ($tab_items as $tab): ?>
                    <option class="heading--18" value="gallery-<?php echo $tab['index']; ?>" <?php echo ($tab['index'] === 1) ? 'selected' : ''; ?>>
                        <?php _e($tab['title'], "Layanlife"); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Desktop Tabs -->
            <ul class="nav nav-tabs d-none d-md-flex" id="GalleryTabs" role="tablist">
                <?php foreach ($tab_items as $tab): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link heading--18 <?php echo ($tab['index'] === 1) ? 'active' : ''; ?>"
                                id="gallery-tab-<?php echo $tab['index']; ?>"
                                data-bs-toggle="tab"
                                data-bs-target="#gallery-<?php echo $tab['index']; ?>"
                                type="button"
                                role="tab"
                                aria-controls="gallery-<?php echo $tab['index']; ?>"
                                aria-selected="<?php echo ($tab['index'] === 1) ? 'true' : 'false'; ?>">
                            <?php _e($tab['title'], "Layanlife"); ?>
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>

        <?php
        endif;
        wp_reset_query();
        wp_reset_postdata();
        ?>

        <div class="tab-content" id="GalleryTabsContent">
            <?php
                $args = array(
                    'post_type'      => 'cpt_gallery',
                    'order'          => 'ASC',
                    'posts_per_page' => -1
                );
                $loop = new WP_Query($args);

                if ($loop->have_posts()) : 
                $m = 1;
                while ($loop->have_posts()) : 
                $loop->the_post();
            ?>
                <div class="tab-pane fade machinarywrap <?php echo ($m === 1) ? 'show active' : ''; ?>" id="gallery-<?php echo $m; ?>" role="tabpanel" aria-labelledby="gallery-tab-<?php echo $m; ?>">
                    <?php 
                        if( have_rows('gi_gallery') ):
                        while( have_rows('gi_gallery') ) : the_row();

                        $item_type = get_sub_field('item_type');
                        $thumbnail_image = get_sub_field('thumbnail_image');
                        $large_image = get_sub_field('large_image');
                        $video_type = get_sub_field('video_type'); 
                        $video_url = get_sub_field('video_file_name'); 
                        $youtube_id = get_sub_field('youtube_video_id');
                        $vimeo_video_id = get_sub_field('vimeo_video_id');
                        $hover_text = get_sub_field('hover_text');
                    ?>
                        <div class="masionary-item <?php if ($item_type === 'video') { echo 'video-wrap' ;}?> <?php if ($item_type === 'image') { echo 'image-wrap' ;}?>">
                            <?php if ($item_type === 'image') { ?>
                                <a class="d-flex flex-column position-relative " title="Image Gallery" href="<?php echo esc_url($large_image['url']); ?>" data-fancybox="gallery">
                                    <img class="img-fluid w-100 lazyload lazyImg" data-imgsrc="<?php echo esc_url($large_image['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($large_image['alt']); ?>" />
                                    <div class="hoverText font-family--font-lora font-color--white heading--18"><?php _e($hover_text, "Layanlife");?></div>
                                </a>
                            <?php } else { 
                                if ($video_type === 'self') { ?>
                                    <a title="Video Gallery" class="position-relative d-flex flex-column" href="<?php echo esc_url($video_url); ?>" data-fancybox="gallery">
                                        <img class="img-fluid w-100 lazyload lazyImg" data-imgsrc="<?php echo esc_url($thumbnail_image['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($thumbnail_image['alt']); ?>" />
                                        <div class="hoverText-img">
                                            <img src="<?php bloginfo('template_directory'); ?>/assets/img/play-button.png" alt="play-button">
                                        </div>
                                    </a>
                                    <?php } elseif ($video_type === 'vimeo') {
                                        $video_url = 'https://vimeo.com/' . $vimeo_video_id;
                                        $fallback_image = esc_url($thumbnail_image['sizes']['medium_large']); 
                                        $thumbnail_src = !empty($thumbnail_image['sizes']['medium_large']) 
                                            ? esc_url($thumbnail_image['sizes']['medium_large']) 
                                            : esc_url($fallback_image); ?>
                                        <a title="Video Gallery" class="d-flex flex-column position-relative" href="<?php echo esc_url($video_url); ?>" data-fancybox="gallery">
                                            <img class="img-fluid w-100 lazyload lazyImg" data-imgsrc="<?php echo $thumbnail_src; ?>"  alt="<?php echo esc_attr($thumbnail_image['alt']); ?>" />
                                            <div class="hoverText-img">
                                                <img src="<?php bloginfo('template_directory'); ?>/assets/img/play-button.png" alt="play-button">
                                            </div>
                                        </a>
                                    <?php } elseif ($video_type === 'youtube') {
                                    $video_url = 'https://www.youtube.com/watch?v=' . $youtube_id; ?>
                                    <a title="Video Gallery" class="d-flex flex-column position-relative" href="<?php echo esc_url($video_url); ?>" data-fancybox="gallery">
                                        <img class="img-fluid w-100 lazyload lazyImg" data-imgsrc="<?php echo esc_url($thumbnail_image['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($thumbnail_image['alt']); ?>" />
                                        <div class="hoverText-img">
                                            <img src="<?php bloginfo('template_directory'); ?>/assets/img/play-button.png" alt="play-button">
                                        </div>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php endwhile;
                    endif;
                    ?>
                </div>
            <?php 
            $m++;
            endwhile; 
            endif; 
            wp_reset_query();
            wp_reset_postdata();
			?>
        </div>
    </div>
</section>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const gallerySelect = document.getElementById('GalleryTabsSelect');
    if (gallerySelect) {
        gallerySelect.addEventListener('change', function () {
            const selectedId = this.value;
            const triggerBtn = document.querySelector(`button[data-bs-target="#${selectedId}"]`);
            if (triggerBtn) {
                new bootstrap.Tab(triggerBtn).show();
            }
        });
    }
});
</script>


<?php get_footer();?>