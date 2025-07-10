<?php
/**
 * Template Name: T10 : Testimornials
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



<section id="TestimornialSection" class="padding-bottom--100">
    <div class="wrapper--70">
        <?php
            $args = array('post_type' => 'cpt_testimornials', 'order' => 'ASC', 'orderby' => 'menu_order', 'posts_per_page' => -1);
            $loop = new WP_Query($args);
            if ($loop->have_posts()) : 
            while ($loop->have_posts()) : $loop->the_post();

            $title_test = get_the_title();
            $testimonialDescription = apply_filters( "the_content" , $post->post_content );
            $tm_select_rate = get_field('tm_select_rate');
            $rating_value = is_array($tm_select_rate) ? intval($tm_select_rate['value']) : intval($tm_select_rate);
            $person_name = get_field('person_name');
            $tm_date = get_field('tm_date');

        ?>
            <div class="testimonialBx  scroll-element js-scroll movetop">
                <p class="titleTestimornial heading--32"><?php _e($title_test , "KingsPavilion");?></p>
                <?php if ($rating_value): ?>
                    <div class="star-rating">
                        <?php 
                            $max_stars = 5;
                            for ($i = 1; $i <= $max_stars; $i++) {
                                if ($i <= $rating_value) {
                                    echo '<span class="star filled">★</span>';
                                } else {
                                    echo '<span class="star">☆</span>';
                                }
                            }
                        ?>
                    </div>
                <?php endif; ?>
                <div class="wysiwig-container contentTestimornial padding-bottom--30"><?php _e($testimonialDescription, "KingsPavilion");?></div>
                <p class="paragraph--16 font-family--opensans font-color--blue-color font-weight--600 all-caps"><?php _e($person_name, "KingsPavilion");?> - <?php _e($tm_date , "KingsPavilion");?></p>
            </div>
        <?php 
        endwhile;
        endif;
        wp_reset_query();
        wp_reset_postdata();
        ?>
    </div>
</section>



<?php get_footer();?>