<?php
/**
 * The template for displaying Default Search Page
 *
 * @package WordPress
 * @subpackage Kings Pavilion
 * @since Kings Pavilion 1.0
 */
?>
<?php
get_header();
$h1_heading = "Search Results";
$overview_small_heading = "Search Results";
$overview_heading = "Search Results";
?>
<section class="padding-top--100 padding-bottom--100">
	<div class="wrapper--80">
		<?php if($overview_small_heading){ ?>
		<p class="font-family--poppins text-center paragraph--18 font-weight--300 font-color--seablue letter-space--27 all-caps"><?php _e( $overview_small_heading, "Kings Pavilion" ); ?></p>
		<?php } ?>
		<h1 class="font-family--garamond text-center  span-euphoria--blue heading--65 font-weight--300 font-color--black <?php if($overview_text){ echo "padding-bottom--50"; } ?>"><?php if($h1_heading ){ _e( $h1_heading, "Kings Pavilion" ); }else{ _e( $overview_heading, "Kings Pavilion" );} ?></h1>
	</div>
</section>
<section class="padding-bottom--100">
    <?php if ( have_posts() ) { ?>
    <div class="wrapper--80 d-flex flex-wrap justify-content-center three-item-grid large-height">
        <?php while ( have_posts() ) : the_post();
        $img_param = get_field('image_cdn_parameters');
        $img = get_field('featured_image');
		if($img){
			$img_mob = $img['sizes']['large'];
		}else{
			$img_mob = "";
		}
        ?>
        <div class="list-item">
			<a title="View <?php echo get_the_title(); ?>" href="<?php the_permalink(); ?>" class="image-content-box image-content-box-top-full-shadow d-block curve-div scale-a">
				
				<div class="image-content-box__img-wrap">
					<?php if($img){ ?>
					<picture>
						<source srcset="<?php echo esc_url($img_mob); ?><?php if($img_param){ echo "?".$img_param; } ?>" media="(max-width: 600px)">
						<source srcset="<?php echo esc_url($img_mob); ?><?php if($img_param){ echo "?".$img_param; } ?>" media="(max-width: 1025px)">
						<img class="image-content-box__img w-100 scale-img" src="<?php echo esc_url($img['url']); ?><?php if($img_param){ echo "?".$img_param; } ?>" alt="<?php echo esc_attr($img['alt']); ?>">
					</picture>
					<?php }else{ ?>	
						<img class="image-content-box__img w-100 scale-img" src="<?php echo site_url(); ?>/wp-content/uploads/2024/10/mountain-with-large-rock-middle-it-1.jpg" alt="common-img">
					<?php } ?>
				</div>
				<div class="image-content-box__hover-text">
					<h6 class="mobile-tab_el heading--24 text-deco-none d-block text-center font-color--black all-caps para-weight--400 font-family--redhat padding-bottom--20"><?php echo get_the_title(); ?></h6>
					<div class="paragraph--16 wysiwig-container padding-bottom--30 text-center m-0 font-color--white font-family--nunito para-weight--300"><?php the_excerpt(); ?></div>
					<div
						class="next-btn mobile-m-auto next-btn--purple-fill"
					>
					<span class="top-text">  more details</span>
					<span class="bottom-text">  more details</span>
					</div>
				</div>
			</a>
			<a title="View <?php echo get_the_title(); ?>" href="<?php the_permalink(); ?>" class="heading--24 desktop_el d-block text-deco-none padding-top--30 text-center font-color--black all-caps para-weight--400 font-family--redhat padding-bottom--30"><?php echo get_the_title(); ?></a>
		</div>
        <?php endwhile; ?>
    </div>
    <?php }else{ ?>
    <div class="no-results text-center wrapper--40 paragraph--20 wysiwig-container font-color--light-black font-family--nunito para-weight--300">
        <div class="padding-bottom--30">
            <h2><?php esc_html_e( 'Nothing Found', 'textdomain' ); ?></h2>
            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'textdomain' ); ?></p>
        </div>
        <?php get_search_form(); ?>
    </div>
    <?php } ?>
</section>
<?php get_footer(); ?>