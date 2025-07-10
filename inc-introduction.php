<?php
$page_id = get_the_ID();
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
    <?php if($sub_title || $pg_heading){?>
        <h1 class="creativeheader text-center <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
            <?php _e($pg_heading, "KingsPavilion");?>
        </h1>
        <p class="main-title font-family--dmserif heading--50 font-color--main-color text-center <?php if($introdiscription){ echo 'padding-bottom--40' ;}?> <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
            <?php if($sub_title){
                _e($sub_title, "KingsPavilion");
            } else{
            echo get_the_title();
            } ?>
        </p>
    <?php } else if($sub_title && !$pg_heading){?>
        <h1 class="main-title text-center font-family--dmserif heading--50 font-color--main-color padding-bottom--40 <?php if($introdiscription){ echo 'padding-bottom--40' ;}?> <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
            <?php _e($sub_title, "KingsPavilion");?>
        </h1>
    <?php } else {?>
        <h1 class="main-title text-center font-family--dmserif heading--50 font-color--main-color padding-bottom--40 <?php if($introdiscription){ echo 'padding-bottom--40' ;}?> <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
            <?php echo get_the_title();?>
        </h1>
    <?php } ?>
    <?php if($introdiscription):?>
    <div class="wysiwig-container text-center <?php if ($enable_banner) { echo 'scroll-element js-scroll movetop' ;}?>">
        <?php
        _e($introdiscription, "KingsPavilion"); 
         ?>
    </div>
    <?php endif;?>
</div>