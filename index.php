<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Kings Pavilion
 * @since Kings Pavilion 1.0
 */
 
get_header();
$h1_heading = get_field('pg_heading');
$overview_small_heading = get_field('pg_sub_title');
$overview_heading = get_the_title();
$overview_text = apply_filters("the_content", get_the_content());
?>
<section class="padding-top--100 padding-bottom--100">
	<div class="wrapper--80">
		<?php if($overview_small_heading){ ?>
		<p class="font-family--poppins text-center paragraph--18 font-weight--300 font-color--seablue letter-space--27 all-caps"><?php _e( $overview_small_heading, "Kings Pavilion" ); ?></p>
		<?php } ?>
		<h1 class="font-family--garamond text-center  span-euphoria--blue heading--65 font-weight--300 font-color--black <?php if($overview_text){ echo "padding-bottom--50"; } ?>"><?php if($h1_heading ){ _e( $h1_heading, "Kings Pavilion" ); }else{ _e( $overview_heading, "Kings Pavilion" );} ?></h1>
		<?php if($overview_text){ ?>
		<div class="wysiwig-container font-family--poppins paragraph--20 font-weight--300 font-color--black letter-space--1"><?php _e( $overview_text, "Kings Pavilion" ); ?></div>
		<?php } ?>
	</div>
</section>
<?php
	get_footer();
?>