<?php
/**
 * Template Name: T01 : Home
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage KingsPavilion
 * @since KingsPavilion 1.0
 */
 
global $blog_id, $post;
get_header();

?>

<?php
$sub_title = get_field('pg_sub_title');
$pg_heading = get_field('pg_heading');
$introdiscription = apply_filters( "the_content" , $post->post_content );
$hp_wlcm_sec_title = get_field('hp_wlcm_sec_title');
?>
<section id="introduction" class="padding-top--130 padding-bottom--85">
    <div class="wrapper--40">
        <p class="creativeheader text-center scroll-element js-scroll movetop"><?php _e($hp_wlcm_sec_title, "KingsPavilion");?></p>
        <?php if($pg_heading){?>
            <p class="text-center font-family--dmserif heading--50 font-color--main-color scroll-element js-scroll movetop">
                <?php _e($sub_title, "KingsPavilion");?>
            </p>    
        <?php } else{?>
            <h1 class="text-center font-family--dmserif heading--50 font-color--main-color scroll-element js-scroll movetop">
                <?php _e($sub_title, "KingsPavilion");?>
            </h1>    
        <?php }?>
        <?php if($introdiscription):?>
        <div class="wysiwig-container <?php if($introdiscription){ echo 'padding-top--60 padding-bottom--70' ;}?> text-center scroll-element js-scroll movetop">
            <?php _e($introdiscription, "Layanlife"); ?>
        </div>
        <?php endif;?>
    </div>
</section>

<?php
$disabled_welcome_section = get_field('disabled_welcome_section');
$hm_welcome_image = get_field('hm_welcome_image');
$hm_welcome_image = ($hm_welcome_image) ? $hm_welcome_image : validateImageData($hm_welcome_image, 960, 600, get_the_title());
$hp_left_imgix_param = get_field('hp_wlcm_img_param');
$hp_left_img_url = (!empty($hm_welcome_image['url']) ? $hm_welcome_image['url'] : 'hhttps://placehold.co/960x600');
$hp_left_img_url .= '?w=960&h=600' . (!empty($hp_left_imgix_param) ? '&' . $hp_left_imgix_param : '');

$hp_wlcm_sec_desc = get_field('hp_wlcm_sec_desc');
if(!$disabled_welcome_section):
?>
<section id="welcomesection" class="padding-bottom--130">
    <div class="wrapper--83-left d-flex justify-content-between align-items-center mobile-flex-column tab-flex-column protab-flex-column">
        <div class="half-div--55 scroll-element js-scroll slideIn toptobottom">
            <img class="large lazyImg" data-imgsrc="<?php echo esc_url($hp_left_img_url); ?>" src="<?php bloginfo('template_directory'); ?>/assets/img/placeholderImg.png" alt="<?php echo esc_attr($hm_welcome_image['alt']); ?>">
        </div>
        <div class="half-div--40 tab-width--100 protab-width--100 mobile-width--100 mobile-padding-top--30 tab-padding-top--30">
            <?php if($pg_heading){?>
            <h1 class="font-color--main-color font-family--dmserif paragraph--28 padding-bottom--50 font-weight--400 mobile-text-center tab-text-center protab-text-center scroll-element js-scroll movetop"><?php _e($pg_heading, "KingsPavilion");?></h1>
            <?php }?>
            <div class="font-color--text-color paragraph--20 font-family--opensans font-weight--400 mobile-text-center tab-text-center protab-text-center"><?php _e($hp_wlcm_sec_desc, "KingsPavilion");?></div>
        </div>
    </div>
</section>
<?php endif;?>


<?php
$disabled_why_book = get_field('disabled_why_book');
$hp_why_sec_sub_title = get_field('hp_why_sec_sub_title');
$hp_why_sec_title = get_field('hp_why_sec_title');
$hp_why_sec_facilities = get_field('hp_why_sec_facilities');

if(!$disabled_why_book):
?>
<section id="whybookus" class="padding-bottom--120">
    <div class="wrapper--75 d-flex justify-content-between align-items-end mobile-flex-column tab-flex-column protab-flex-column tab-align-centre">
        <div class="width--20">
            <p class="creativeheader text-left mobile-text-center tab-text-center protab-text-center"><?php _e($hp_why_sec_sub_title, "KingsPavilion");?></p>
            <h2 class="text-left mobile-text-center tab-text-center protab-text-center font-family--dmserif heading--50 font-color--main-color">
                <?php _e($hp_why_sec_title , "KingsPavilion");?>
            </h2>
        </div>
        <div class="width--75 mobile-padding-top--30 tab-padding-top--30">
            <div class="icons-set">
                <?php if ($hp_why_sec_facilities): $n = 1;?>
                    <div class="icons-boxes d-flex w-100 justify-content-between align-items-end mobile-flex-wrap mobile-flex-column mobile-align-start tab-flex-wrap tab-align-start protab-align-center">
                        <?php foreach ($hp_why_sec_facilities as $fackey => $facility) :
                        $fac_svg_id = $facility['fac_svg_id'];
                        $facility_text = $facility['facility_text'];
                        ?>
                            <div class="set d-flex align-items-center scroll-element js-scroll fade-bottom" style="--i: <?php echo $n; ?>;">
                                <svg width="45" height="45" aria-hidden="true" class=" drawsvg-initialized ">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#<?php _e($fac_svg_id, "KingsPavilion"); ?>"></use>
                                </svg>
                                <div class="icon-title font-family--opensans font-color--text-color font-weight--500"><?php _e($facility_text, "KingsPavilion"); ?></div>
                            </div>
                            <hr class="scroll-element js-scroll fade-bottom" style="--i: <?php echo $n; ?>;">
                        <?php $n++;  endforeach; ?>
                    </div>
                <?php endif; ?>                                       
            </div>
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

function render_room_slider($posts, $cate_title) {
    if (empty($posts)) return;

    foreach ($posts as $post) {
        $room_for_home = get_field('enabled_in_hmpge', $post->ID);
        if (!$room_for_home) continue;

        $room_title = esc_html($post->post_title);
        $permalink = esc_url(get_permalink($post->ID));

        $hm_room_image = get_field('featured_image', $post->ID);
        $hm_room_image = $hm_room_image ?: validateImageData($hm_room_image, 860, 600, get_the_title());
        $img_url = !empty($hm_room_image['url']) ? $hm_room_image['url'] : 'hhttps://placehold.co/860x600';
        $imgix_param = get_field('feat_imgix_param', $post->ID);
        $img_url .= '?w=860&h=600' . (!empty($imgix_param) ? '&' . $imgix_param : '');

        $amenities = get_field('rm_type_amenities', $post->ID);
        ?>
        <div class="slide-item">
            <div class="roomStaysSlider">
                <a href="<?php echo $permalink; ?>" title="Room Details - <?php _e($room_title, "KingsPavilion"); ?>">
                    <div class="imageRoom position-relative">
                        <img class="large" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($hm_room_image['alt']); ?>">
                        <div class="inerDetails">
                            <p class="typename all-caps font-color--white font-family--opensans"><?php _e($cate_title, "KingsPavilion"); ?></p>
                            <p class="roomname font-family--dmserif font-color--white heading--32"><?php _e($room_title, "KingsPavilion"); ?></p>
                        </div>
                    </div>
                </a>
                <?php if ($amenities): ?>
                <div class="amenitiestypes d-flex justify-content-center align-items-center m-auto mobile-flex-wrap tab-flex-wrap">
                    <?php foreach ($amenities as $amenity): ?>
                        <p class="amenity_name font-family--opensans font-color--main-color font-weight--400"><?php _e($amenity['amenity_name'], "KingsPavilion"); ?></p>
                        <hr>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <div class="booknowmoredetailBtn d-flex justify-content-center align-items-center mobile-justify-content-between <?php if (empty($amenities)){echo 'padding-top--30';}?>"">
                    <a class="moredetails" href="<?php echo $permalink; ?>" title="Room Details - <?php _e($room_title, "KingsPavilion"); ?>">ROOM DETAILS</a>
                    <button class="booknowBtn book-widget-open" title="Book Now - Kings Pavilion">Book Now</button>
                </div>
            </div>
        </div>
        <?php
    }
}

if (!empty($terms)):
?>
<section id="accommodationHome" class="padding-bottom--130 padding-top--115 bg-color--bg-cream">
    <div class="wrapper--92">
        <h2 class="accommotitle text-center font-color--light-green font-family--dmserif gont-weight--400 scroll-element js-scroll reveal-left">Accommodation</h2>
        <div class="accommodationTabs">
            <a href="#" class="exploreBtn visibility-hidden mobile-display-none tab-display-none">Explore All</a>
            <!-- Normal Tabs for Desktop -->
                <ul class="nav nav-tabs desktop-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                    </li>
                    <?php foreach ($terms as $term): 
                        $room_id = sanitize_title($term->name); ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="<?php echo $room_id; ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo $room_id; ?>" type="button" role="tab" aria-controls="<?php echo $room_id; ?>" aria-selected="false">
                                <?php echo esc_html($term->name); ?>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Dropdown Tabs for Mobile -->
                <!-- <div class="dropdown mobile-tabs d-md-none mb-4">
                    <button class="dropdown-toggle w-100" type="button" id="roomTabDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Room Type
                    </button>
                    <ul class="dropdown-menu w-100" aria-labelledby="roomTabDropdown">
                        <li><a class="dropdown-item" href="#" data-tab-target="#all">All</a></li>
                        <?//php foreach ($terms as $term): 
                            // $room_id = sanitize_title($term->name); ?>
                            <li><a class="dropdown-item" href="#" data-tab-target="#<?//php echo $room_id; ?>"><?//php echo esc_html($term->name); ?></a></li>
                        <?//php endforeach; ?>
                    </ul>
                </div> -->
 
            <a href="<?php echo site_url(); ?>/stay" class="exploreBtn mobile-display-none" title="Explore All Accommodation">Explore All</a>
            <div class="tab-content tab-padding-top--50" id="myTabContent">
                <!-- ALL TAB -->
                <div class="tab-pane fade active show" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="roomTypesPost-slider two-item-slider slider">
                        <?php foreach ($terms as $term): 
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
                            render_room_slider($posts, esc_html($term->name));
                        endforeach; ?>
                    </div>
                </div>
                <!-- INDIVIDUAL TABS -->
                <?php foreach ($terms as $term): 
                    $room_id = sanitize_title($term->name);
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
                <div class="tab-pane fade" id="<?php echo $room_id; ?>" role="tabpanel" aria-labelledby="<?php echo $room_id; ?>-tab">
                    <div class="roomTypesPost-slider two-item-slider slider">
                        <?php render_room_slider($posts, esc_html($term->name)); ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>



<?php 
$disabled_offers = get_field('disabled_offers');
$hm_off_sub_title = get_field('hm_off_sub_title');
$hp_off_section_title = get_field('hp_off_section_title');
$hp_off_description = get_field('hp_off_description');
$offers_page_link = get_field('offers_page_link');

if(!$disabled_offers):
?>
<section id="specialOffers" class="padding-top--130 padding-bottom--130">
    <div class="wrapper--92 d-flex justify-content-between align-items-center mobile-flex-column tab-flex-column protab-flex-column">
        <div class="half-div--30">
            <p class="creativeheader text-left mobile-text-center tab-text-center protab-text-center scroll-element js-scroll movetop"><?php _e($hm_off_sub_title, "KingsPavilion");?></p>
            <h2 class="text-left mobile-text-center font-family--dmserif heading--50 font-color--main-color tab-text-center protab-text-center scroll-element js-scroll movetop">
                <?php _e($hp_off_section_title , "KingsPavilion");?>
            </h2>
            <?php if($hp_off_description):?>
            <div class="descriptionsec description-padding--30 font-family--opensans font-color--text-color font-weight--400 mobile-text-center tab-text-center protab-text-center">
                <?php _e($hp_off_description, "KingsPavilion");?>
            </div>
            <?php endif; ?>
            <?php if($offers_page_link):?>
            <a href="<?php _e($offers_page_link, "KingsPavilion");?>" class="booknowBtn m-0 mobile-display-none tab-display-none  mobile-margin-auto tab-margin-auto" title="Explore All Offers">EXPLORE ALL</a>
            <?php endif;?>
        </div>
        <div class="half-div--63 tab-padding-bottom--30 protab-padding-bottom--50 mobile-padding-bottom--30">
            <div class="slider-offers-home two-item-slider slider">
                <?php 
                    $page_ids = [];
                    $_acc_page_id  = _getTplPageID('T04-offers');
                    $top_items  = _getSubPages($_acc_page_id);				
                    if ( !empty( $top_items ) ) {
                        foreach ($top_items as $tival) {
                            $id = $tival->ID; 
                            $page_ids[] = $id;

                    $hm_offer_image = get_field('featured_image', $id);
                    $hm_offer_image = ($hm_offer_image) ? $hm_offer_image : validateImageData($hm_offer_image, 520, 610, get_the_title());
                    $hp_offer_imgix_param = get_field('feat_imgix_param', $id);
                    $hp_offer_img_url = (!empty($hm_offer_image['url']) ? $hm_offer_image['url'] : 'hhttps://placehold.co/520x610');
                    $hp_offer_img_url .= '?w=520&h=610' . (!empty($hp_offer_imgix_param) ? '&' . $hp_offer_imgix_param : '');

                    $offerhmDesc = get_field('feat_desc', $id);

                    $offer_title = get_the_title($id);
                    $enable_for_hmpge = get_field('enable_for_hmpge', $id);

                    if($enable_for_hmpge):
                ?>
                    <div class="slide-item">
                        <div class="imageOffersHome position-relative">
                            <a href="<?php echo esc_url(get_permalink($id)); ?>" title="More Details <?php _e($offer_title, "KingsPavilion");?>">
                                <img class="large" src="<?php echo esc_url($hp_offer_img_url); ?>" alt="<?php echo esc_attr($hm_offer_image['alt']); ?>">
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
                    </div>
                <?php
                   endif; } }
                ?>
            </div>
        </div>
        <?php if($offers_page_link):?>
            <a href="<?php _e($offers_page_link, "KingsPavilion");?>" class="booknowBtn m-0 mobile-display-flex tab-display-flex desktop-display-none mobile-margin-auto tab-margin-auto" title="Explore All Offers">EXPLORE ALL</a>
        <?php endif;?>
    </div>
</section>
<?php endif;?>


<?php
$disabled_dining_hm = get_field('disabled_dining_hm');
$hm_dining_sub_title = get_field('hm_dining_sub_title');
$hm_dining_title = get_field('hm_dining_title');
$hm_dining_discription = get_field('hm_dining_discription');
$dining_page_link = get_field('dining_page_link');

$dining_left_side_image = get_field('dining_left_side_image');
$dining_left_side_image = ($dining_left_side_image) ? $dining_left_side_image : validateImageData($dining_left_side_image, 860, 600, get_the_title());
$dining_cdn_param = get_field('dining_cdn_param');
$hp_dining_img_url = (!empty($dining_left_side_image['url']) ? $dining_left_side_image['url'] : 'hhttps://placehold.co/860x600');
$hp_dining_img_url .= '?w=860&h=600' . (!empty($dining_cdn_param) ? '&' . $dining_cdn_param : '');

if(!$disabled_dining_hm):
?>
<section id="diningHome" class="padding-bottom--130">
    <div class="wrapper--92 d-flex justify-content-between align-items-center tab-align-start mobile-flex-column-revers tab-flex--revers protab-flex-column-revers">
        <div class="half-div--52 scroll-element js-scroll slideIn toptobottom tab-padding-top--30 protab-padding-top--50 mobile-padding-top--50 tab-width--100 protab-width--100  mobile-width--100">  
            <img class="large lazyImg" data-imgsrc="<?php echo esc_url($hp_dining_img_url); ?>" alt="<?php echo esc_attr($dining_left_side_image['alt']); ?>">
        </div>  
        <div class="half-div--44 tab-width--100 protab-width--100  mobile-width--100">
            <p class="creativeheader text-left mobile-text-center tab-text-center protab-text-center scroll-element js-scroll movetop"><?php _e($hm_dining_sub_title, "KingsPavilion");?></p>
            <h2 class="text-left mobile-text-center tab-text-center protab-text-center font-family--dmserif heading--50 font-color--main-color scroll-element js-scroll movetop">
                <?php _e($hm_dining_title  , "KingsPavilion");?>
            </h2>
            <?php if($hm_dining_discription):?>
            <div class="descriptionsec font-family--opensans font-color--text-color font-weight--400 mobile-text-center tab-text-center protab-text-center">
                <?php _e($hm_dining_discription, "KingsPavilion");?>
            </div>
            <?php endif; ?>
            <?php if($dining_page_link):?>
            <a href="<?php _e($dining_page_link, "KingsPavilion");?>" class="booknowBtn m-0 mobile-margin-auto tab-margin-auto protab-margin-auto" title="Explore Dining">EXPLORE</a>
            <?php endif;?>
        </div>  
    </div>
</section>
<?php endif;?>


<?php
$disabled_experience = get_field('disabled_experience');
$hm_expo_sub_title = get_field('hm_expo_sub_title');
$hm_expo_title = get_field('hm_expo_title');
$hm_expo_description = get_field('hm_expo_description');
$experience_page_link = get_field('experience_page_link');
if(!$disabled_experience):
?>
<section id="experienceHM" class="padding-top--130 padding-bottom--130 bg-color--bg-cream">
    <div class="wrapper--75 d-flex justify-content-between align-items-start mobile-flex-column tab-flex-column protab-flex-column">
        <div class="half-div--40 tab-width--100 protab-width--100">
            <p class="creativeheader text-left mobile-text-center tab-text-center protab-text-center scroll-element js-scroll movetop"><?php _e($hm_expo_sub_title, "KingsPavilion");?></p>
            <h2 class="text-left mobile-text-center tab-text-center protab-text-center tab-padding-bottom--30 font-family--dmserif heading--50 font-color--main-color scroll-element js-scroll movetop">
                <?php _e($hm_expo_title  , "KingsPavilion");?>
            </h2>            
        </div>
        <div class="half-div--52 tab-width--100 protab-width--100">
            <?php if($hm_expo_description):?>
                <div class="descriptionsec expodescription mobile-text-center tab-text-center protab-text-center mobile-padding-top--30 font-family--opensans font-color--text-color font-weight--400">
                    <?php _e($hm_expo_description, "KingsPavilion");?>
                </div>
            <?php endif; 
            if($experience_page_link):
            ?>
            <a href="<?php _e($experience_page_link, "KingsPavilion");?>" class="booknowBtn m-0 mobile-display-none tab-display-none mobile-margin-auto tab-margin-auto font-weight--400 font-color--white font-family--opensans" title="Explore All Experience">Explore All</a>
            <?php endif; ?>
        </div>
    </div>
    <?php 
    $experience_gallery = get_field('experience_gallery');
    if(!empty($experience_gallery)):
    ?>
    <div class="galleryExperience">
        <div class="slider-expo-gallery-hm slider">
            <?php foreach($experience_gallery as $expo_gallery):
                $experience_name = $expo_gallery['experience_name'];
                $experience_image = $expo_gallery['experience_image'];
                $experience_image = ($experience_image) ? $experience_image : validateImageData($experience_image, 710, 550, get_the_title());
                $expo_hm_cdn_param = $expo_gallery['expo_hm_cdn_param'];
                $hp_expo_img_url = (!empty($experience_image['url']) ? $experience_image['url'] : 'hhttps://placehold.co/710x550');
                $hp_expo_img_url .= '?w=710&h=550' . (!empty($expo_hm_cdn_param) ? '&' . $expo_hm_cdn_param : '');
            ?>
                <div>
                    <div class="imagegal-expo position-relative">
                        <img class="large" src="<?php echo esc_url($hp_expo_img_url); ?>" alt="<?php echo esc_attr($experience_image['alt']); ?>">
                        <div class="inerDetails position-absolute">
                            <p class="exponame font-family--dmserif font-color--white heading--32 padding-bottom--30"><?php _e($experience_name, "KingsPavilion");?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php if($experience_page_link):?>
        <a href="<?php _e($experience_page_link, "KingsPavilion");?>" class="z-index--8 position-relative booknowBtn m-0 mobile-display-flex tab-display-flex desktop-display-none mobile-margin-auto tab-margin-auto protab-margin-auto font-weight--400 font-color--white font-family--opensans" title="Explore All Experience">Explore All</a>
    <?php endif; ?>
</section>
<?php endif;?>



<?php
$disabled_locate = get_field('disabled_locate');
$hm_locate_sub_title = get_field('hm_locate_sub_title');
$hm_locate_title =  get_field('hm_locate_title');

if(!$disabled_locate):
?>
<section id="locatemap" class="padding-top--130 padding-bottom--100">
    <div class="wrapper--87-left d-flex justify-content-between align-items-start protab-flex-column mobile-flex-column">
        <div class="half-div--30">
            <p class="creativeheader text-left mobile-text-center tab-text-center protab-text-center scroll-element js-scroll movetop"><?php _e($hm_locate_sub_title, "KingsPavilion");?></p>
            <h2 class="text-left mobile-text-center tab-text-center protab-text-center font-family--dmserif heading--50 font-color--main-color padding-bottom--70 scroll-element js-scroll movetop">
                <?php _e($hm_locate_title  , "KingsPavilion");?>
            </h2> 
            <div class="locateHomeAll">
                <div class="slider-location slider">
                    <?php
						$args = array('post_type' => 'cpt_location', 'order' => 'ASC', 'orderby' => 'menu_order', 'posts_per_page' => -1);
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
                        <div>
                            <div class="box-locatewrap">
                                <img class="large lazyImg" data-imgsrc="<?php echo esc_url($hp_locate_img_url); ?>" alt="<?php echo esc_attr($hm_locate_image['alt']); ?>">
                                <p class="title-locate font-family--dmserif font-color--main-color mobile-text-center tab-text-center protab-text-center font-weight--400 heading--32 padding-top--30 padding-bottom--30"><?php _e(get_the_title(), "KingsPavilion");?><span class="font-family--dmserif font-color--main-color font-weight--400">/ <?php _e($location_name, "KingsPavilion");?></span> </p> 
                                <?php if($introdiscription):?>
                                    <div class="wysiwig-container text-left mobile-text-center tab-text-center protab-text-center">
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
        </div>
        <div class="half-div--55">
            <div class="mapimageHome">
                <picture>
                    <source srcset="https://kingspavilion.imgix.net/2025/05/mapwithtextmobile.png" media="(max-width: 991px)">
                    <img class="banner-img large" src="https://kingspavilion.imgix.net/2025/05/mapwithlinefull.png" alt="map">
                </picture>
                <div class="wrap-map-attols-div">
                    <?php
						$args = array('post_type' => 'cpt_location', 'order' => 'ASC', 'orderby' => 'menu_order', 'posts_per_page' => -1);
						$loop = new WP_Query($args);
						if ($loop->have_posts()) : $n = 1;
						while ($loop->have_posts()) : $loop->the_post();
                        $mapLocation = get_the_title();
					?>
                        <div class="attoll-body-div desktop-div" id="attoll-body-div-<?php echo $n;?>">
                            <p class="attol_name-div"><?php _e($mapLocation, "KingsPavilion")?></p>
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
        </div>
    </div>
</section>
<?php endif;?>


<?php
$disabled_sustainability = get_field('disabled_sustainability');
$hm_sus_sub_title = get_field('hm_sus_sub_title');
$hm_sus_title = get_field('hm_sus_title');
$hm_sus_description = get_field('hm_sus_description');
$sustainability_link = get_field('sustainability_link');

$sustainable_bg_image = get_field('sustainable_bg_image');
$sustainable_bg_image = ($sustainable_bg_image) ? $sustainable_bg_image : validateImageData($sustainable_bg_image, 1920, 740, get_the_title());
$sustainable_cdn_param = get_field('sustainable_cdn_param');
$hp_sustainable_img_url = (!empty($sustainable_bg_image['url']) ? $sustainable_bg_image['url'] : 'hhttps://placehold.co/1920x740');
$hp_sustainable_img_url .= '?w=1920&h=740' . (!empty($sustainable_cdn_param) ? '&' . $sustainable_cdn_param : '');

$disabled_faq = get_field('disabled_faq');
$faq_hm_sub_title = get_field('faq_hm_sub_title');
$faq_hm_title = get_field('faq_hm_title');

if(!$disabled_sustainability || !$disabled_faq):
?>


<section id="sustaiblefaq" class="position-relative">
    <img class="large lazyImg susfaqBGImage" data-imgsrc="<?php echo esc_url($hp_sustainable_img_url); ?>" alt="<?php echo esc_attr($sustainable_bg_image['alt']); ?>">
    <div class="wrapper--75 d-flex justify-content-between align-items-start mobile-flex-column tab-flex-column protab-flex-column">
        <?php if(!$disabled_sustainability):?>
            <div class="half-div--48 tab-width--100 mobile-width--100 tab-padding-bottom--50 mobile-padding-bottom--50">
                <p class="creativeheader text-left mobile-text-center tab-text-center protab-text-center scroll-element js-scroll movetop"><?php _e($hm_sus_sub_title , "KingsPavilion");?></p>
                <h2 class="text-left mobile-text-center tab-text-center protab-text-center font-family--dmserif heading--50 font-color--main-color title-case scroll-element js-scroll movetop">
                    <?php _e($hm_sus_title  , "KingsPavilion");?>
                </h2>
                <?php if($hm_sus_description):?>
                 <div class="descriptionsec expodescription mobile-text-center tab-text-center protab-text-center mobile-padding-top--30 font-family--opensans font-color--text-color font-weight--400">
                    <?php _e($hm_sus_description, "KingsPavilion");?>
                </div>
                <?php endif;?>
                <?php if($sustainability_link):?>
                    <a href="<?php _e($sustainability_link, "KingsPavilion");?>" class="booknowBtn m-0 mobile-margin-auto tab-margin-auto protab-margin-auto font-weight--400 font-color--white font-family--opensans" title="Explore Sustainability">Explore</a>
                <?php endif; ?>
            </div>
        <?php endif; 
        if(!$disabled_faq):
        ?>
            <div class="half-div--48 tab-width--100 mobile-width--100  accordian-half <?php if($disabled_sustainability){ echo 'w-100'; }?>">
                <p class="creativeheader text-left mobile-text-center tab-text-center mobile-padding-top--30"><?php _e($faq_hm_sub_title, "KingsPavilion");?></p>
                <h2 class="text-left mobile-text-center tab-text-center font-family--dmserif heading--50 font-color--main-color padding-bottom--70 title-case">
                    <?php _e($faq_hm_title  , "KingsPavilion");?>
                </h2>
                <div class="accordion" id="accordionExample">
					<?php
						$args = array('post_type' => 'cpt_faq', 'order' => 'ASC', 'orderby' => 'menu_order', 'posts_per_page' => 6);
						$loop = new WP_Query($args);
						if ($loop->have_posts()) : $n = 1;
						while ($loop->have_posts()) : $loop->the_post();
					?>	 
					<div class="accordion-item">
						<h2 class="accordion-header" id="heading-<?php echo $n; ?>">
							<button class="accordion-button <?php echo ($n != 1) ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $n; ?>" aria-expanded="<?php echo ($n == 1) ? 'true' : 'false'; ?>" aria-controls="collapse-<?php echo $n; ?>">
								<?php the_title(); ?>
							</button>
						</h2>
						<div id="collapse-<?php echo $n; ?>" class="accordion-collapse collapse <?php echo ($n == 1) ? 'show' : ''; ?>" aria-labelledby="heading-<?php echo $n; ?>" data-bs-parent="#accordionExample">
							<div class="accordion-body">
								<?php the_content(); ?>
							</div>
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
        <?php endif; ?>
    </div>
</section>
<?php endif;?>


<?php
$disabled_instagram = get_field('disabled_instagram');
$insta_sub_title = get_field('insta_sub_title');
$insta_title = get_field('insta_title');
$insta_right_text = get_field('insta_right_text');
$instagram = get_field('sm_instagram','option');

if(!$disabled_instagram):
?>
<section id="instagramSection" class="padding-top--130 padding-bottom--100">
    <div class="wrapper--75 d-flex justify-content-between align-items-end padding-bottom--50 mobile-flex-column tab-flex-column protab-flex-column">
        <div class="half-div--40 mobile-width--100 tab-width--100 protab-width--100">
            <p class="creativeheader text-left mobile-text-center tab-text-center protab-text-center scroll-element js-scroll movetop"><?php _e($insta_sub_title, "KingsPavilion");?></p>
            <h2 class="text-left mobile-text-center tab-text-center protab-text-center tab-padding-bottom--30 font-family--dmserif heading--50 font-color--main-color scroll-element js-scroll movetop">
                <?php _e($insta_title  , "KingsPavilion");?>
            </h2>
        </div>
        <div class="half-div--30 text-right mobile-width--100 tab-width--100 protab-width--100 mobile-text-center tab-text-center protab-text-center">
            <a class="instafollow font-family--opensans font-color--main-color mobile-text-center tab-text-center protab-text-center font-weight--500 scroll-element js-scroll movetop" href="<?php _e($instagram, "KingsPavilion");?>" target="_blank" title="Follow Instagram"><?php _e($insta_right_text, "KingsPavilion");?></a>
        </div>
    </div>
    <div class="wrapper--92">
        <?php
            $instagram_feeder = get_post_meta(get_the_ID(), 'instagram_feeder', true);
            if (!empty($instagram_feeder)) {
                echo do_shortcode($instagram_feeder);
            }
        ?>
    </div>
</section>
<?php endif;?>


<?php
$all_awards = get_field('all_awards', 'option');
if($all_awards):
?>
<section id="AwardsHM" class="padding-bottom--100">
    <div class="wrapper--50">
        <div class="slider-awards five-item-slider slider">
            <?php foreach( $all_awards as $image ): ?>
                <div class="slide-item">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>                
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif;?>




<script>
document.addEventListener("DOMContentLoaded", function () {
    const dropdownItems = document.querySelectorAll('.mobile-tabs .dropdown-item');

    dropdownItems.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const tabTarget = this.getAttribute('data-tab-target');

            const tabTrigger = document.querySelector(`button[data-bs-target="${tabTarget}"]`);
            if (tabTrigger) {
                new bootstrap.Tab(tabTrigger).show();
                document.getElementById('roomTabDropdown').innerText = this.innerText;
            }
        });
    });
});



jQuery(document).ready(function($) {
    // Click from map to slider
    $('#attoll-body-div-1').addClass('active');
    $('.attol_name-div').on('click', function() {
        const index = $(this).closest('.attoll-body-div').index();
        $('.slider-location').slick('slickGoTo', index);
    });

    // Slide from slider to map (add hover/active effect)
    $('.slider-location').on('afterChange', function(event, slick, currentSlide) {
        $('.attoll-body-div').removeClass('active');
        $('#attoll-body-div-' + (currentSlide + 1)).addClass('active');
    });
});

</script>




<?php get_footer();?>