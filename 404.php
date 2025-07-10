<?php
/**
 * The template for displaying 404 Template
 *
 * @package WordPress
 * @subpackage Kings Pavilion
 * @since Kings Pavilion 1.0
 */
get_header();?>
<section class="padding-top--100 padding-bottom--100">
	<div class="wrapper--60 text-center">
		<p class="font-family--dmserif paragraph--16  font-color--main-color all-caps">404</p>
		<h1 class="font-family--dmserif  heading--50  font-color--main-color padding-bottom--50">404 : Page not found</h1>
		<div class="wysiwig-container font-family--dmserif paragraph--16  font-color--main-color">
            You may have typed the web address incorrectly. Please check the address and spelling ensuring that it does not contain spaces.
            An incorrect link was given either on an internal or external page.
            It is possible that the page you were looking for may have been moved, updated or deleted.
            Please make sure you have refreshed/reloaded the page you were on before this one.
		</div>
        <h2 class="font-family--dmserif padding-top--30  heading--32  font-color--main-color padding-bottom--50">Please try one of the following</h2>
        <div class="btn-wrap d-flex justify-content-center flex-wrap">
            <a href="/" class="downloadBtn next-btn next-btn--brown-line">Back To Home</a>
            <a href="/sitemap" class="downloadBtn next-btn next-btn--brown-line">View Sitemap</a>
        </div>
	</div>
</section>
<?php get_footer();
