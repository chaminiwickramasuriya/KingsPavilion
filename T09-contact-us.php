<?php
/**
 * Template Name: T09 : Contact US
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

<?php
$facebook = get_field('sm_facebook','option');
$instagram = get_field('sm_instagram','option');
$x_account = get_field('sm_twitter','option');
$linkedin = get_field('sm_linkedin','option');
$youtube = get_field('sm_youtube','option');
$tiktok = get_field('sm_tiktok','option');

$property_address = get_field('property_address', 'option');

$phone_number = get_field('contact_phone','option');
$whatsapp_number = get_field('contact_watsapp','option');
$whatsapp_number_nospace = str_replace(' ', '', get_field('contact_watsapp', 'option'));
$email_address = get_field('contact_email','option');
$com_name = get_field('contact_name','option');
$main_address1 = get_field('address_line1','option');
$main_address2 = get_field('address_line2','option');
$main_address3 = get_field('address_line3','option');
$main_address4 = get_field('address_line4','option');

$address = $com_name . ' ' . $main_address1 . ' ' . $main_address2 . ' ' . $main_address3 . ' ' . $main_address4;
?>
<section id="ContactPg" class="padding-bottom--100">
    <div class="wrapper--65 d-flex justify-content-between align-items-start tab-flex-column mobile-flex-column protab-flex-column">
        <div class="half-div--25 tab-text-center protab-text-center tab-display-flex tab-flex-column protab-flex-column tab-justify-center tab-align-center protab-align-center">
            <?php if($property_address):?>
                <div class="titleaddress font-color--text-color font-family--dmserif paragraph--20 padding-bottom--10 d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                        <path d="M12.4994 0C7.50693 0 3.44531 4.06162 3.44531 9.054C3.44531 15.2497 11.5478 24.3454 11.8928 24.7295C12.2168 25.0904 12.7825 25.0898 13.106 24.7295C13.4509 24.3454 21.5534 15.2497 21.5534 9.054C21.5533 4.06162 17.4917 0 12.4994 0ZM12.4994 13.6093C9.98755 13.6093 7.94409 11.5658 7.94409 9.054C7.94409 6.54219 9.9876 4.49873 12.4994 4.49873C15.0111 4.49873 17.0546 6.54224 17.0546 9.05405C17.0546 11.5659 15.0111 13.6093 12.4994 13.6093Z" fill="#CB997E"/>
                    </svg>
                    HQ Address
                </div>
                <p class="addressField font-color--text-color font-family--opensans paragraph--16 letter-space--32 line-height--32"><?php _e($property_address, "KingsPavilion"); ?></p>
                <hr>
            <?php endif;
            if($address):
            ?>
                <div class="titleaddress font-color--text-color font-family--dmserif paragraph--20 padding-bottom--10 d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                        <path d="M12.4994 0C7.50693 0 3.44531 4.06162 3.44531 9.054C3.44531 15.2497 11.5478 24.3454 11.8928 24.7295C12.2168 25.0904 12.7825 25.0898 13.106 24.7295C13.4509 24.3454 21.5534 15.2497 21.5534 9.054C21.5533 4.06162 17.4917 0 12.4994 0ZM12.4994 13.6093C9.98755 13.6093 7.94409 11.5658 7.94409 9.054C7.94409 6.54219 9.9876 4.49873 12.4994 4.49873C15.0111 4.49873 17.0546 6.54224 17.0546 9.05405C17.0546 11.5659 15.0111 13.6093 12.4994 13.6093Z" fill="#CB997E"/>
                    </svg>
                    Property Address
                </div>
                <p class="addressField font-color--text-color font-family--opensans paragraph--16 letter-space--32 line-height--32">
                    <?php _e($com_name, "KingsPavilion");?><br/>
                    <?php _e($main_address1, "KingsPavilion");?><br/>
                    <?php _e($main_address2, "KingsPavilion");?><br/>
                    <?php _e($main_address3, "KingsPavilion");?><br/>
                    <?php _e($main_address4, "KingsPavilion");?>
                </p>
                <hr>
            <?php endif;?>
                <?php if(!empty($phone_number)):?>
                    <div class="titleaddress font-color--text-color font-family--dmserif paragraph--20 padding-bottom--10 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                            <path d="M17.7309 13.9441L15.1845 11.2926C14.2751 10.3456 12.7291 10.7244 12.3653 11.9554C12.0925 12.8077 11.183 13.2812 10.3646 13.0918C8.54573 12.6183 6.0903 10.1562 5.63559 8.16758C5.36276 7.31527 5.90841 6.36831 6.72689 6.08425C7.90913 5.70547 8.2729 4.09563 7.36348 3.14866L4.81711 0.497157C4.08957 -0.165719 2.99827 -0.165719 2.36168 0.497157L0.633781 2.29639C-1.09412 4.19032 0.815665 9.20924 5.08994 13.66C9.36421 18.1107 14.1841 20.1941 16.003 18.3001L17.7309 16.5009C18.3675 15.7433 18.3675 14.6069 17.7309 13.9441Z" fill="#CB997E"/>
                        </svg>
                        Phone
                    </div>
                    <div class="d-flex">
                        <span class="font-color--text-color font-family--opensans paragraph--16 letter-space--32 line-height--32"> Hotline : </span>
                        <div class="d-flex flex-column">
                            <?php foreach($phone_number as $phone):
                                    $ph_num_lbl = $phone['ph_num_lbl'];
                                    $ph_num = $phone['ph_num'];
                            ?>            
                            <a class="font-color--text-color font-family--opensans paragraph--16 letter-space--32 line-height--32" href="tel:<?php echo $ph_num;?>" title="Contact to Kings Pavilion"><?php echo $ph_num_lbl;?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif;
                if($whatsapp_number):
                ?>
                    <div class="d-flex">
                        <span class="font-color--text-color font-family--opensans paragraph--16 letter-space--32 line-height--32">WhatsApp : </span>
                        <a class="font-color--text-color font-family--opensans paragraph--16 letter-space--32 line-height--32" href="https://api.whatsapp.com/send?phone=<?php _e($whatsapp_number_nospace, "KingsPavilion");?>&text=Hi" title="Message to Kings Pavilion" target="_blank">
                            <?php _e($whatsapp_number, "KingsPavilion");?>
                        </a> 
                    </div>
                    <hr>
                <?php endif;?>
            <?php if($email_address):
            ?>
                <div class="titleaddress font-color--text-color font-family--dmserif paragraph--20 padding-bottom--10 d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="18" viewBox="0 0 22 18" fill="none">
                        <path d="M12.8386 11.2323C12.2913 11.6281 11.6555 11.8373 11 11.8373C10.3446 11.8373 9.70881 11.6281 9.16147 11.2323L0.146481 4.71268C0.096465 4.67651 0.0477384 4.6388 0 4.60002V15.2831C0 16.5079 0.91631 17.48 2.02525 17.48H19.9748C21.1039 17.48 22 16.486 22 15.2831V4.59998C21.9522 4.63885 21.9034 4.67665 21.8532 4.71287L12.8386 11.2323Z" fill="#CB997E"/>
                        <path d="M0.861523 4.01835L9.8765 10.6627C10.2178 10.9143 10.6089 11.04 11 11.04C11.3911 11.04 11.7822 10.9142 12.1235 10.6627L21.1385 4.01835C21.6779 3.62099 22 2.95595 22 2.23818C22 1.00402 21.0918 0 19.9754 0H2.02456C0.908231 4.75027e-05 0 1.00406 0 2.23937C0 2.95595 0.322094 3.62099 0.861523 4.01835Z" fill="#CB997E"/>
                    </svg>
                    Email
                </div>
                <a class="emiladdress font-color--text-color font-family--opensans paragraph--16 letter-space--32 line-height--32" href="mailto:<?php echo $email_address;?>" title="Email to Kings Pavilion"><?php echo $email_address;?></a>
                <hr>
            <?php endif; ?>
            <div class="titleaddress font-color--text-color font-family--dmserif paragraph--20 padding-bottom--10 d-flex align-items-center">
                Find Us On
            </div>
            <div class="socialicons d-flex">
                <?php if($facebook):?>
                    <a href="<?php _e($facebook, "kingsPavilion");?>" target="_blank" title="Follow Kings Pavilion on Facebook">
                        <svg class="icon">
                            <use xlink:href="#Cfb"></use>
                        </svg>
                    </a>
                <?php endif;?>
                <?php if($instagram):?>
                    <a href="<?php _e($instagram, "kingsPavilion");?>" target="_blank" title="Follow Kings Pavilion on Instagram">
                        <svg class="icon">
                            <use xlink:href="#Cinsta"></use>
                        </svg>
                    </a>    
                <?php endif;?>
                <?php if($linkedin):?>
                    <a href="<?php _e($linkedin, "kingsPavilion");?>" target="_blank" title="Follow Kings Pavilion on Linkedin">
                        <svg class="icon">
                            <use xlink:href="#Clinkedin"></use>
                        </svg>
                    </a>    
                <?php endif;?>
                <?php if($tiktok):?>
                    <a href="<?php _e($tiktok, "kingsPavilion");?>" target="_blank" title="Follow Kings Pavilion on Tiktok">
                        <svg class="icon">
                            <use xlink:href="#Cticktok"></use>
                        </svg>
                    </a>
                <?php endif;?>
                <?php if($x_account):?>
                    <a href="<?php _e($x_account, "kingsPavilion");?>" target="_blank" title="Follow Kings Pavilion on Twitter">
                        <svg class="icon">
                            <use xlink:href="#Ctwitter"></use>
                        </svg>
                    </a>
                <?php endif;?>
                <?php if($youtube):?>
                    <a href="<?php _e($youtube, "kingsPavilion");?>" target="_blank" title="Follow Kings Pavilion on Youtube">
                        <svg class="icon">
                            <use xlink:href="#Cyoutube"></use>
                        </svg>
                    </a>
                <?php endif;?>
            </div>
        </div>
        <div class="half-div--70 protab-padding-top--50 mobile-padding-top--50">
            <div class="formButolderdiv">
                <?php echo do_shortcode( '[form_builder]' ); ?>
            </div>
        </div>
    </div>
</section>





<?php get_footer();?>