<?php

validate_CSRF(); //do not remove this need for From Builder
global $version;
global $post, $blog_id;
$version = '1.2';

$common_desc = get_field('common_description','option');
$common_og = get_field('fb_image','option');

$favicon = get_field('favicon_icon','option');
$logo = get_field('site_logo','option');
$logo_white = get_field('logo_white','option');

$site_name = get_bloginfo('name');
$site_description = get_bloginfo('description');

$current_url = get_permalink();
$site_url = get_site_url();
$dynamic_url = esc_url( $current_url ? $current_url : $site_url );

$site_url = get_site_url();
$parsed_url = parse_url($site_url);
$domain = isset($parsed_url['host']) ? $parsed_url['host'] : '';
$twitter_domain = esc_attr($domain);

$common_og_image = $common_og['url'] ?? '';


$pg_title = $pg_desc = $pg_keywords = $fb_title = $fb_desc = $fb_img = "";
$pg_noindex = false;

$meta_fields = ['pg_title', 'pg_desc', 'pg_keywords', 'fb_title', 'fb_desc', 'fb_img', 'pg_noindex'];

if (is_category() || is_tag() || is_tax()) {
    $term = get_queried_object();
    if ($term) {
        foreach ($meta_fields as $field) {
            ${$field} = get_field($field, 'category_' . $term->term_id);
        }
    }
} elseif (is_archive('stay')) {
    if ($id = get_archive_page_id('archive-stay.php')) {
        foreach ($meta_fields as $field) {
            ${$field} = get_field($field, $id) ?? ${$field};
        }
    }
} else {
    $id = get_the_ID();
    foreach ($meta_fields as $field) {
        ${$field} = get_field($field, $id) ?? ${$field};
    }
}

if (!$pg_title) {
    $pg_title = $pg_title = is_front_page() ? "$site_name | $site_description" : wp_title('', false) . " | $site_name";
}
  
$fb_title = $fb_title ?: $pg_title;
$fb_desc = $fb_desc ?: $pg_desc;
$fb_img = $fb_img ?: $common_og_image;


$_hostName = $_SERVER['HTTP_HOST'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="format-detection" content="telephone=no">

	<title><?php echo $pg_title; ?> </title>
	

	<meta name="description" content="<?php echo $pg_desc; ?>" />
	<meta name="keywords" content="<?php echo $pg_keywords; ?>" />

	<!-- Facebook Meta Tags -->
	<meta property="og:url" content="<?php echo $dynamic_url; ?>">
	<meta property="og:title" content="<?php echo $pg_title; ?>" />
	<meta property="og:description" content="<?php echo $fb_desc; ?>" />
	<meta property="og:image" content="<?php echo $fb_img; ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="<?php echo $site_name; ?>" />

	<!-- Twitter Meta Tags -->
	<meta name="twitter:card" content="summary_large_image">
	<meta property="twitter:domain" content="<?php echo $twitter_domain; ?>">
	<meta property="twitter:url" content="<?php echo $dynamic_url; ?>">
	<meta name="twitter:title" content="<?php echo $pg_title; ?>" />
    <meta name="twitter:description" content="<?php echo $fb_desc; ?>" />
    <meta name="twitter:image" content="<?php echo $fb_img; ?>" />

	<link rel="canonical" href="<?php echo $dynamic_url; ?>">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">


	<?php getVerificationCodes(); ?>

	<?php if($favicon){ ?>
		<link rel="shortcut icon" href="<?php echo $favicon['url']; ?>" type="image/x-icon">
		<link rel="icon" href="<?php echo $favicon['url']; ?>" type="image/x-icon">
	<?php } ?>
	<?php loadExternalCodes('header'); ?>

	<?php
    $_hostName  = $_SERVER['HTTP_HOST'];
    if ( LIVE_SITE_HOST != $_hostName ): ?>
    <meta name="robots" content="noindex,nofollow" />
    <?php else: ?>
        <?php 
        $pg_noindex = false;
        if ( isset($post) ) {
            $pg_noindex = htmlspecialchars_decode( get_field('pg_noindex',$post->ID) );
        }
        if( $pg_noindex=="true" ): ?>
            <meta name="robots" content="noindex, nofollow" />
        <?php  else: ?>
            <meta name="robots" content="index,follow" />
        <?php endif;
         ?>
    <?php endif; ?>

<?php wp_head(); ?>
</head>
<body class="<?php echo implode(' ', get_body_class()); ?>">
<?php loadExternalCodes('body'); ?>
<?php get_template_part( "inc/inc", "header" ); ?>