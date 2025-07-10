<?php
/**
 * The template for displaying Default Page
 *
 * @package WordPress
 * @subpackage Kings Pavilion
 * @since Kings Pavilion 1.0
 */
get_header();
?>


<section id="introduction" class="padding-top--130 padding-bottom--50">
    <?php get_template_part('inc/inc', 'introduction');?>
</section>

<?php

$disabled_download_discription = get_field('disabled_download_discription');
$disabled_download_btn = get_field('disabled_download_btn');
$disabled_page_content = get_field('disabled_page_content');
$disabled_list_items = get_field('disabled_list_items');
$disabled_table_details = get_field('disabled_table_details');
$disabled_default_gallery = get_field('disabled_default_gallery');

$df_download_description = get_field('df_download_description');
$df_page_contents = get_field('df_page_contents');
$df_table_details = get_field('df_table_details');
$df_list_items = get_field('df_list_items');
$df_table_title = get_field('df_table_title');


$df_download_pdf_id = get_field('df_download_pdf_id');
$df_download_text = get_field('df_download_text');
$_download_pdf_page_id      = _getTplPageID('view_download');
$_download_pdf_page_link    = get_permalink( $_download_pdf_page_id );
$brochure_download_pdf_link     = ( isset( $df_download_pdf_id )  ? $_download_pdf_page_link .'?id='.$df_download_pdf_id : "" );
?>
<section id="descriptionBox" class="<?php if($disabled_table_details || $disabled_list_items || $disabled_page_content || $disabled_default_gallery){echo 'padding-bottom--100' ; }?>">
	<div class="wrapper--60">
		<?php if(!$disabled_download_discription):?>
			<div class="wysiwig-container text-left mobile-text-center scroll-element js-scroll movetop">
				<?php _e($df_download_description, "KingsPavilion"); ?>
			</div>
		<?php endif; 
		if(!$disabled_download_btn):?>
			<a class="downloadBtn m-auto mobile-margin-auto padding-top--40 scroll-element js-scroll movetop"  href="<?php echo esc_url($brochure_download_pdf_link);?>" title="<?php _e($df_download_text, "KingsPavilion");?>">
				<?php _e($df_download_text, "KingsPavilion");?>
			</a>
		<?php endif; 
		if(!$disabled_page_content):
		?>
			<div class="wysiwig-container text-left mobile-text-center scroll-element js-scroll movetop <?php if($disabled_download_btn){echo 'padding-bottom--100 padding-top--0' ; }?> padding-top--70">
				<?php _e($df_page_contents, "KingsPavilion"); ?>
			</div>
		<?php endif;
		if(!$disabled_list_items):
		?>
			<div class="wysiwig-container text-left padding-bottom--100 scroll-element js-scroll movetop <?php if($disabled_page_content){echo 'padding-bottom--100' ; }?>">
				<?php _e($df_list_items, "KingsPavilion"); ?>
			</div>
		<?php endif;
		if(!$disabled_table_details):
		?>
			<div class="table-responsive table-details <?php if($disabled_default_gallery){echo 'padding-bottom--100' ; }?> <?php if(!$df_list_items){echo 'padding-top--100' ; }?> <?php if($disabled_page_content){echo 'padding-top--100' ; }?>">
				<div class="wysiwig-container">
					<h6><?php _e($df_table_title, "KingsPavilion"); ?></h6>
					<?php if (!empty($df_table_details) && is_array($df_table_details)): ?>
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<?php foreach ($df_table_details as $df_tbl_header): 
										$df_table_column_name = $df_tbl_header['df_table_column_name'] ?? ''; ?>
										<th class="text-left" scope="col"><?php _e($df_table_column_name, "KingsPavilion"); ?></th>
									<?php endforeach; ?>
								</tr>
							</thead>
							<tbody>
								<?php
								// Determine number of rows by counting the cells in the first column
								$num_rows = isset($df_table_details[0]['df_table_cells']) && is_array($df_table_details[0]['df_table_cells']) 
									? count($df_table_details[0]['df_table_cells']) 
									: 0;

								for ($i = 0; $i < $num_rows; $i++): ?>
									<tr>
										<?php foreach ($df_table_details as $column): 
											$cell_data = $column['df_table_cells'][$i]['df_table_cell_name'] ?? ''; ?>
											<td><?php _e($cell_data, "KingsPavilion"); ?></td>
										<?php endforeach; ?>
									</tr>
								<?php endfor; ?>
							</tbody>
						</table>
					<?php endif; ?>
				</div>				
			</div>
		<?php endif; ?>		
	</div>
	<?php
	if(!$disabled_default_gallery):
	$default_page_gallery = get_field('default_page_gallery');
	if($default_page_gallery):
	?>
		<div class="sustainableGaleery <?php if($disabled_default_gallery){ echo 'padding-bottom--100' ;}?>">
			<div class="slider-sustanable-gallery slider">
				<?php foreach($default_page_gallery as $default_gallery):
					$df_gallery_image_text = $default_gallery['df_gallery_image_text'];
					$default_gallery_images = $default_gallery['default_gallery_images'];
					$default_gallery_images = ($default_gallery_images) ? $default_gallery_images : validateImageData($default_gallery_images, 710, 550, get_the_title());
					$df_gallery_image_param = $default_gallery['df_gallery_image_param'];
					$default_gallery_img_url = (!empty($default_gallery_images['url']) ? $default_gallery_images['url'] : 'hhttps://placehold.co/710x550');
					$default_gallery_img_url .= '?w=710&h=550' . (!empty($df_gallery_image_param) ? '&' . $df_gallery_image_param : '');
				?>
					<div>
						<!-- <a class="d-flex flex-column position-relative " title="Image Gallery" href="<?//php echo esc_url($default_gallery_img_url); ?>" data-fancybox="gallery"> -->
							<div class="imagegal-sustanable position-relative">                        
								<img class="large" src="<?php echo esc_url($default_gallery_img_url); ?>" alt="<?php echo esc_attr($default_gallery_images['alt']); ?>">
								<div class="inerDetails position-absolute">
									<p class="sustanablename font-family--opensans font-color--white paragraph--16 padding-bottom--30"><?php _e($df_gallery_image_text, "KingsPavilion");?></p>
								</div>                        
							</div>
						<!-- </a> -->
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; endif;?>
</section>


<?php
	get_footer();
?>