<?php
/**
 * Template Name: View PDF
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Kings Pavilion
 * @since Kings Pavilion 1.0
 */
global $blog_id;

$_mid = "";

$_mid = ( isset( $_REQUEST["id"] )? $_REQUEST["id"] : "" );

$opts = get_field("download_tags", "option");
$data = array();

if ( is_array( $opts ) ){
	foreach( $opts as $opt ){
		$pdf = $opt["download_pdf"];
		$data[$opt["download_key"]] = array(
			"label" => $opt["download_label"],
			"file" 	=> $pdf["url"]
		);
	}

}

if ( !is_array($opts) || ( is_array( $opts ) && sizeof( $opts ) == 0 ) || $_mid == "" || !isset( $data[$_mid] )){
	wp_redirect( network_home_url(), 301 );
}else{
	wp_redirect( $data[$_mid]["file"], 301);
}