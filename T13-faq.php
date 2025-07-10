<?php
/**
 * Template Name: T13 : FAQ
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

<section id="accordionFAQ" class="bg-image-bottom">
    <div class="wrapper--60">
        <div class="accordion" id="accordionExample">
            <?php
                $args = array('post_type' => 'cpt_faq', 'order' => 'ASC', 'orderby' => 'menu_order', 'posts_per_page' => -1);
                $loop = new WP_Query($args);
                if ($loop->have_posts()) : $n = 1;
                while ($loop->have_posts()) : $loop->the_post();
            ?>	 
            <div class="accordion-item">
                <h2 class="accordion-header d-flex faq-heading" id="heading-<?php echo $n; ?>">                    
                    <div class="accordion-button font-color--text-color font-family--font-lora heading--20">	
                        <?php echo get_the_title(); ?>
                    </div>
                </h2>
                <div id="collapse-<?php echo $n; ?>" class="accordion-collapse">
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
    <div class="bgImagefaq">
        
    </div>
</section>


<script>
jQuery(document).ready(function($) {
    $('.faq-heading').each(function(index) {
        const number = (index + 1).toString().padStart(2, '0');
        $(this).attr('data-number', number + '.');
    });
});


</script>


<?php get_footer();?>