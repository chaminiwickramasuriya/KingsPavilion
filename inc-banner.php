<?php

if (!isset($id)) {
    if (is_category() || is_tag() || is_tax()) {
        $term = get_queried_object();
        $id = $term->term_id;
    } elseif (is_post_type_archive('stay')) {
        $archive_template = 'archive-stay.php';
        if (function_exists('get_archive_page_id')) {
            $id = get_archive_page_id($archive_template);
        } else {
            $id = 0;
        }
    } else {
        global $post;
        $id = isset($post) ? get_the_ID() : 0;
    }
}


$enable_banner = get_field('enable_banner', $id);

if ($enable_banner) {
    if (is_front_page()) {
        $enable_video = get_field('enable_banner_video', $id);
        $rows = get_field('pg_hd', $id);

        ?>
        <section class="position-relative banner-section">
            <?php if ($enable_video): 
                $banner_video = get_field('desktop_video', $id);
                $banner_video_thumb = get_field('desktop_video_thumbnail', $id);
                $banner_video_thumb_cdn = get_field('desktop_video_thumbnail_cdn_parameters', $id);
                $cdn_param = $banner_video_thumb ? "?w=1920&h=1080" . $banner_video_thumb_cdn : "";
                $mobile_video = get_field('mobile_video', $id);
                $mobile_video_thumb = get_field('mobile_video_thumbnail', $id);
                $mobile_video_thumb_cdn = get_field('mobile_video_thumbnail_cdn_parameters', $id);
                $cdn_param_mobile = $mobile_video_thumb ? "?w=350&h=500" . $mobile_video_thumb_cdn : "";
                ?>
                <div class="video-container">
                    <?php if ($banner_video_thumb): ?>
                        <picture>
                            <?php if ($mobile_video_thumb): ?>
                                <source srcset="<?php echo esc_url($mobile_video_thumb['url']) . $cdn_param_mobile; ?>" media="(max-width: 600px)">
                            <?php endif; ?>
                            <img class="w-100 video-poster" src="<?php echo esc_url($banner_video_thumb['url']) . $cdn_param; ?>" alt="<?php echo esc_attr($banner_video_thumb['alt']); ?>">
                        </picture>
                    <?php endif; ?>
                </div>
            <?php elseif ($rows): ?>
                <div id="bannerSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-touch="false">
                    <div class="carousel-inner">
                        <?php $n = 1;
                        foreach ($rows as $row) {
                            if (!empty($row['pg_hd_enabled'])) {
                                $banner_thumb = $row['pg_hd_img'] ?? null;
                                $banner_thumb_cdn = $row['desktop_image_cdn_parameters'] ?? '';
                                $cdn_param = $banner_thumb ? "?w=1920&h=1080" . $banner_thumb_cdn : '';

                                $mobile_thumb = $row['pg_hd_img_mobile'] ?? null;
                                $mobile_thumb_cdn = $row['mobile_image_cdn_parameters'] ?? '';
                                $cdn_param_mobile = $mobile_thumb ? "?w=350&h=500" . $mobile_thumb_cdn : '';
                                ?>
                                <div class="carousel-item overflow-hidden <?php echo ($n == 1) ? 'active' : ''; ?>">
                                    <?php if ($banner_thumb): ?>
                                        <picture>
                                            <?php if ($mobile_thumb): ?>
                                                <source srcset="<?php echo esc_url($mobile_thumb['url']) . $cdn_param_mobile; ?>" media="(max-width: 600px)">
                                            <?php endif; ?>
                                            <img data-scroll data-scroll-speed="-0.3" class="banner-img" src="<?php echo esc_url($banner_thumb['url']) . $cdn_param; ?>" alt="<?php echo esc_attr($banner_thumb['alt']); ?>">
                                        </picture>
                                    <?php endif; ?>
                                </div>
                            <?php }
                            $n++;
                        } ?>
                    </div>
                </div>
            <?php endif; ?>
        </section>
        <?php
        if ($enable_video): ?>
            <script>
                jQuery(document).ready(function($) {

                    if (window.innerWidth > 600) {
                        var $videoContainer = $(".video-container"); // Ensure you have a container to append the video
                        var videoHtml = `
                            <video id="bannervideo" poster="<?php echo $banner_video_thumb['url']; ?>" class="bannervideo video-element" playsinline autoplay muted loop>
                                <source src="<?php echo esc_url($banner_video['url']); ?>" type="video/mp4">
                            </video>
                        `;

                        $videoContainer.html(videoHtml); // Append the video inside the container

                        var $video = $("#bannervideo");
                        var $poster = $(".video-poster");

                        $video.on("loadeddata", function() {
                            $poster.hide(); // Hide the poster when video loads
                        });

                    } else {

                        <?php if($mobile_video){ ?>
                        var $videoContainer = $(".video-container"); // Ensure you have a container to append the video
                        var videoHtml = `
                            <video id="bannervideo" poster="<?php echo $mobile_video_thumb['url']; ?>" class="bannervideo video-element" playsinline autoplay muted loop>
                                <source src="<?php echo esc_url($mobile_video['url']); ?>" type="video/mp4">
                            </video>
                        `;

                        $videoContainer.html(videoHtml); // Append the video inside the container

                        var $video = $("#bannervideo");
                        var $poster = $(".video-poster");

                        $video.on("loadeddata", function() {
                            $poster.hide(); // Hide the poster when video loads
                        });
                        <?php } ?>
                    }

                });
            </script>
        <?php endif;
    } else {
        $banner_thumb = get_field('pg_hd_img', $id);
        $banner_thumb_cdn = get_field('desktop_image_cdn_parameters', $id);
        $cdn_param = $banner_thumb ? "?w=1920&h=750" . $banner_thumb_cdn : 'hhttps://placehold.co/1920x750';

        $mobile_thumb = get_field('pg_hd_img_mobile', $id);
        $mobile_thumb_cdn = get_field('mobile_image_cdn_parameters', $id);
        $cdn_param_mobile = $mobile_thumb ? "?w=350&h=500" . $mobile_thumb_cdn : 'hhttps://placehold.co/350x500';
        ?>
        <section class="position-relative banner-section-inner overflow-hidden">
            <?php if ($banner_thumb): ?>
                <picture>
                    <?php if ($mobile_thumb): ?>
                        <source srcset="<?php echo esc_url($mobile_thumb['url']) . $cdn_param_mobile; ?>" media="(max-width: 600px)">
                    <?php endif; ?>
                    <img data-scroll data-scroll-speed="-0.3" class="banner-img" src="<?php echo esc_url($banner_thumb['url']) . $cdn_param; ?>" alt="<?php echo esc_attr($banner_thumb['alt']); ?>">
                </picture>
            <?php endif; ?>
        </section>
    <?php }
} else { ?>
    <div class="without-banner"></div>
<?php } ?>
