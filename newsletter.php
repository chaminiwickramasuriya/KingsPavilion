<?php
/**
 * Template Name: Newsletter
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Kings Pavilion
 * @since Kings Pavilion 1.0
 */
 
get_header();
?>

<section id="introduction" class="padding-top--130 padding-bottom--70">
    <?php get_template_part('inc/inc', 'introduction');?>
</section>

<section id="ContactSection" class="padding-bottom--100">
    <div class="wrapper--55">
        <div class="formFeast">
            <?php echo do_shortcode( '[form_builder]' ); ?> 
        </div>
    </div>
</section>


<?php
	get_footer();
?>