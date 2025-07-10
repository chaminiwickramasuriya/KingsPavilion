<?php
/**
 * Template Name: T08 : Press and Awards
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage KingsPavilion
 * @since KingsPavilion 1.0
 */
 
global $blog_id, $post;
get_header();

$tripadvisor_description = get_field('tripadvisor_description');
?>


<section id="introduction" class="padding-top--130 padding-bottom--70">
    <?php get_template_part('inc/inc', 'introduction');?>
</section>

<?php
$all_awards = get_field('all_awards', 'option');
if($all_awards):
?>
<section id="AwardsHM" class="padding-bottom--100">
    <div class="wrapper--60">
        <div class="slider-awards-press five-item-slider slider">
            <?php foreach( $all_awards as $image ): ?>
                <div class="slide-item">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>                
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif;?>

<section id="tripadviserwidget" class="padding-bottom--100">
    <div class="wrapper--55 d-flex justify-content-between align-items-center mobile-flex-column">
    <div class="half-div--30">
        <div id="TA_certificateOfExcellence810" class="TA_certificateOfExcellence">
            <ul id="eW9kLSuIpC" class="TA_links n9fWHfqCTL">
                <li id="VswOldrQ" class="8u7TE4Epe">
                    <a title="Click TripAdvisor" target="_blank" href="https://www.tripadvisor.com/Hotel_Review-g304138-d11925680-Reviews-Kings_Pavilion-Kandy_Kandy_District_Central_Province.html">
                        <img src="https://static.tacdn.com/img2/travelers_choice/widgets/tchotel_2025_L.png" alt="TripAdvisor" class="widCOEImg" id="CDSWIDCOELOGO"/>
                    </a>
                </li>
            </ul>
        </div>
        <script async src="https://www.jscache.com/wejs?wtype=certificateOfExcellence&amp;uniq=810&amp;locationId=11925680&amp;lang=en_US&amp;year=2025&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>
    </div>    
    <div class="half-div--70 wysiwig-container mobile-text-center">
            <?php _e($tripadvisor_description, "KingsPavilion");?>
        </div>
    </div>
</section>

<?php 
$press_and_awards = get_field('press_and_awards');
$press_text_title = get_field('press_text_title');
if($press_and_awards): $n =1;
?>
<section id="pressDetailsLinks" class="padding-bottom--85">
    <div class="wrapper--92">
        <h2 class="text-center font-family--dmserif heading--50 font-color--main-color padding-bottom--100 scroll-element js-scroll movetop">
            <?php _e($press_text_title, "KingsPavilion");?>
        </h2>
        <div class="three-item-grid pressBlocks d-flex justify-content-center align-items-start flex-wrap">
            <?php
            foreach($press_and_awards as $pressDetails):
                $press_date = $pressDetails['press_date'];
                $press_detail = $pressDetails['press_detail'];
                $press_external_link_url = $pressDetails['press_external_link_url'];

                $press_image = $pressDetails['press_image'];
                $press_image = ($press_image) ? $press_image : validateImageData($press_image, 555, 400, get_the_title());
                $press_image_cdn_param = $pressDetails['press_image_cdn_param'];
                $press_img_url = (!empty($press_image['url']) ? $press_image['url'] : 'hhttps://placehold.co/555x400');
                $press_img_url .= '?w=555&h=400' . (!empty($press_image_cdn_param) ? '&' . $press_image_cdn_param : '');
            ?>
                <div class="list-item scroll-element js-scroll fade-bottom" style="--i: <?php echo $n; ?>;">
                    <a href="<?php echo esc_url($press_external_link_url); ?>" target="_blank" title="More Details about Latest Press">
                        <img class="large lazyImg" data-imgsrc="<?php echo esc_url($press_img_url); ?>" alt="<?php echo esc_attr($press_image['alt']); ?>">
                        <?php 
                            if ($press_date) {
                                $timestamp = strtotime($press_date);
                                $day = date('d', $timestamp);
                                $month = strtolower(date('M', $timestamp)); // "Feb" to "feb"
                                $year = date('Y', $timestamp);
                            }
                        ?>
                        <div class="boxpressDeta">
                            <p class="datePress">
                                <span class="day d-block"><?php echo esc_html($day); ?></span>
                                <span class="month d-block"><?php echo esc_html($month); ?></span>
                                <span class="year d-block"><?php echo esc_html($year); ?></span>
                            </p>
                            <p class="descriptionPress paragraph--20 font-family--opensans font-color--text-color font-weight--600 text-left mobile-text-center"><?php _e($press_detail, "KingsPavilion");?></p>
                            <?php if($press_external_link_url):?>
                            <p class="moredetails m-0 mobile-margin-auto">More DETAILS</p>
                            <?php endif;?>
                        </div>
                    </a>
                </div>                
            <?php $n++; endforeach; ?>
        </div>
    </div>
</section>
<?php  endif;?>



<?php get_footer();?>