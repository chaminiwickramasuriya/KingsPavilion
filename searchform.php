<?php
/**
 * The template for displaying Default Search Template
 *
 * @package WordPress
 * @subpackage Kings Pavilion
 * @since Kings Pavilion 1.0
 */
?>
<div class="search-from-wrap w-100">
	<h3 class="heading--24 font-color--dark-black text-center all-caps para-weight--300 font-family--redhat padding-bottom--20">Search</h3>
	<form role="search w-100" method="get" class="search-form d-flex curve-div" action="<?php echo home_url( '/' ); ?>">
		<label class="flex-grow-1">
			<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ); ?></span>
			<input type="search" class="search-field curve-div w-100" placeholder="<?php echo esc_attr_x( 'Search for Flight', 'placeholder' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		</label>
		<button type="submit" class="search-submit curve-div">
			<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
				<path d="M25.7628 24.5945L19.0475 17.9866C20.806 16.076 21.8865 13.5493 21.8865 10.7688C21.8857 4.82099 16.9866 0 10.9428 0C4.89906 0 0 4.82099 0 10.7688C0 16.7167 4.89906 21.5377 10.9428 21.5377C13.5541 21.5377 15.9492 20.6345 17.8305 19.1329L24.5718 25.7668C24.9002 26.0904 25.4335 26.0904 25.762 25.7668C26.0912 25.4433 26.0912 24.9181 25.7628 24.5945ZM10.9428 19.8808C5.82914 19.8808 1.68371 15.8013 1.68371 10.7688C1.68371 5.73641 5.82914 1.65685 10.9428 1.65685C16.0565 1.65685 20.2019 5.73641 20.2019 10.7688C20.2019 15.8013 16.0565 19.8808 10.9428 19.8808Z" fill="white"/>
			</svg>
		</button>
	</form>
</div>