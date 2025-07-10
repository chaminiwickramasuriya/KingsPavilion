<?php
/**
 * Template Name: Request Acknowledgment
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Kings Pavilion
 * @since Kings Pavilion 1.0
 */
 
get_header();

?>

<section id="introduction" class="padding-top--130 padding-bottom--130">
<?php
$sub_title = get_field('pg_sub_title');
$pg_heading = get_field('pg_heading');
$introdiscription = apply_filters( "the_content" , $post->post_content );

$enable_banner = get_field('enable_banner',$id);

$parent_title = '';
$parent_id = wp_get_post_parent_id(get_the_ID()); 
if ($parent_id) {
    $parent_title = get_the_title($parent_id); 
}

?>
<div class="wrapper--55">
    <p class="creativeheader text-center <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
        <?php 
        if ($sub_title) { 
            _e($sub_title, "KingsPavilion");
        } elseif($parent_title){
            _e($parent_title, "KingsPavilion");
        } else { }?>
    </p>
    <h1 class="text-center font-family--dmserif heading--50 font-color--main-color <?php if(!$introdiscription){ echo 'padding-bottom--40' ;}?> <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
        <?php if($pg_heading){
            _e($pg_heading, "KingsPavilion");
        } else {
            echo get_the_title();
        }?>
    </h1>
    <?php if($introdiscription):?>
    <div class="wysiwig-container text-center <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
		<?php _e($introdiscription, "KingsPavilion"); ?>
    </div>
    <?php endif;?>
    <div class="padding-top--50 mobile-padding-top--50">
        <?php echo do_shortcode( '[form_builder_submit]' ); ?>
    </div>
</div>
</section>


<?php
	get_footer();
?>
