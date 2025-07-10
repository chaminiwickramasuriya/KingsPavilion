<?php
/**
 * Template Name: Sitemap
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Kings Pavilion
 * @since Kings Pavilion 1.0
 */
 
get_header();
?>

<section id="introduction" class="padding-top--100">
    <?php get_template_part('inc/inc', 'introduction');?>
</section>

<section class="padding-top--100 padding-bottom--100">
	<div class="wrapper--55">
		<div class="wysiwig-container padding-top--30 sitemap-div">
			<?php echo _getSiteMap(); ?>
		</div>
	</div>
</section>
<?php
	get_footer();
?>