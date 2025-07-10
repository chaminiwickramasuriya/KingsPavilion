<?php

$facebook = get_field('sm_facebook','option');
$instagram = get_field('sm_instagram','option');
$x_account = get_field('sm_twitter','option');
$linkedin = get_field('sm_linkedin','option');
$youtube = get_field('sm_youtube','option');
$tiktok = get_field('sm_tiktok','option');

$phone_number = get_field('contact_phone','option');
$whatsapp_number = get_field('contact_watsapp','option');
$whatsapp_number_nospace = str_replace(' ', '', get_field('contact_watsapp', 'option'));
$email_address = get_field('contact_email','option');
$com_name = get_field('contact_name','option');
$main_address1 = get_field('address_line1','option');
$main_address2 = get_field('address_line2','option');
$main_address3 = get_field('address_line3','option');
$main_address4 = get_field('address_line4','option');

$footer_text = get_field('footer_text', 'option');
$footer_description = get_field('footer_description', 'option');

$address = $com_name . ' ' . $main_address1 . ' ' . $main_address2 . ' ' . $main_address3 . ' ' . $main_address4;
?>
<footer class="footer position-relative padding-top--70 bg-color--bg-green mobile-padding-bottom--90 tab-padding-bottom--90">
   <div class="wrapper--80 d-flex justify-content-between align-items-start position-relative z-index--8 padding-bottom--70 mobile-flex-wrap tab-flex-wrap protab-flex-wrap">
        <div class="menufottermain protab-width--33 tab-width--33 mobile-width--48">
            <?php  
                $args =  array(
                    "theme_location"    => "footer-menu", 
                    "menu_id"           => "", 
                    "menu_class"        => "",
                    "container"         => false
                    ); 
                wp_nav_menu( $args );
            ?>
        </div>
        <div class="menufooterscond protab-width--33 tab-width--33 mobile-width--48">
            <?php  
                $args =  array(
                    "theme_location"    => "footer-second-menu", 
                    "menu_id"           => "", 
                    "menu_class"        => "",
                    "container"         => false
                    ); 
                wp_nav_menu( $args );
            ?>
        </div>
        <div class="addressfields protab-width--33 tab-width--33 mobile-width--100 mobile-padding-top--50">
            <?php if($address):?>
            <div class="d-flex addsvgfoter padding-bottom--30">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="25" viewBox="0 0 19 25" fill="none">
                    <path d="M9.05405 0C4.06162 0 0 4.06162 0 9.054C0 15.2497 8.10249 24.3454 8.44746 24.7295C8.77148 25.0904 9.33721 25.0898 9.66064 24.7295C10.0056 24.3454 18.1081 15.2497 18.1081 9.054C18.108 4.06162 14.0464 0 9.05405 0ZM9.05405 13.6093C6.54224 13.6093 4.49878 11.5658 4.49878 9.054C4.49878 6.54219 6.54228 4.49873 9.05405 4.49873C11.5658 4.49873 13.6093 6.54224 13.6093 9.05405C13.6093 11.5659 11.5658 13.6093 9.05405 13.6093Z" fill="white"/>
                </svg>
                <p class="address">
                    <?php _e($com_name, "KingsPavilion");?><br/>
                    <?php _e($main_address1, "KingsPavilion");?><br/>
                    <?php _e($main_address2, "KingsPavilion");?><br/>
                    <?php _e($main_address3, "KingsPavilion");?><br/>
                    <?php _e($main_address4, "KingsPavilion");?>
                </p>
            </div>
            <!-- <hr> -->
            <?php endif;?>
            <div class="contactNumbers">
                <div class="d-flex svgfoter padding-bottom--30">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                        <path d="M19.5973 15.4119L16.7829 12.4813C15.7777 11.4346 14.069 11.8533 13.6669 13.2139C13.3654 14.1559 12.3602 14.6793 11.4556 14.4699C9.44528 13.9466 6.73138 11.2253 6.22881 9.02732C5.92726 8.0853 6.53035 7.03865 7.43498 6.7247C8.74168 6.30604 9.14373 4.52674 8.13859 3.4801L5.32417 0.549489C4.52006 -0.183163 3.31388 -0.183163 2.61028 0.549489L0.700494 2.53812C-1.20929 4.63141 0.901524 10.1786 5.62572 15.0979C10.3499 20.0171 15.6772 22.3198 17.6875 20.2264L19.5973 18.2378C20.3009 17.4005 20.3009 16.1445 19.5973 15.4119Z" fill="white"/>
                    </svg>
                    <div class="contactnumbers-a">
                        <?php if(!empty($phone_number)):
                            foreach($phone_number as $phone):
                                $ph_num_lbl = $phone['ph_num_lbl'];
                                $ph_num = $phone['ph_num'];
                        ?>
                            <a class="ft-size-0-9" href="tel:<?php echo $ph_num;?>" title="Contact to Kings Pavilion"><?php echo $ph_num_lbl;?></a>
                        <?php endforeach;
                        endif;?>
                    </div>
                </div>
                <div class="d-flex svgfoter align-items-center padding-bottom--30">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24" viewBox="0 0 23 24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5782 3.34644C17.4238 1.1896 14.5588 0.00126493 11.5065 0C5.21699 0 0.0982429 5.11861 0.095713 11.4098C0.0948697 13.4209 0.620237 15.3841 1.61883 17.1145L0 23.0273L6.04903 21.4406C7.71579 22.3498 9.59224 22.8289 11.5019 22.8295H11.5066C17.7955 22.8295 22.9148 17.7104 22.9172 11.4189C22.9184 8.3699 21.7326 5.50315 19.5782 3.34644ZM11.5065 20.9024H11.5026C9.80082 20.9017 8.13181 20.4444 6.67546 19.5804L6.32929 19.3748L2.7397 20.3165L3.69781 16.8167L3.47223 16.4579C2.52283 14.9478 2.0215 13.2025 2.02234 11.4105C2.02431 6.18143 6.27897 1.92719 11.5103 1.92719C14.0435 1.92803 16.4248 2.9158 18.2154 4.70849C20.006 6.50118 20.9915 8.88402 20.9907 11.4182C20.9884 16.6477 16.734 20.9024 11.5065 20.9024ZM16.7087 13.7993C16.4237 13.6565 15.0219 12.9669 14.7605 12.8716C14.4993 12.7765 14.309 12.7291 14.1191 13.0144C13.929 13.2998 13.3827 13.9421 13.2163 14.1322C13.0499 14.3225 12.8837 14.3464 12.5986 14.2036C12.3134 14.061 11.3948 13.7598 10.3057 12.7884C9.45816 12.0324 8.88599 11.0988 8.71958 10.8135C8.55346 10.5279 8.71818 10.3884 8.84467 10.2316C9.15331 9.84832 9.46238 9.4465 9.55739 9.25633C9.65254 9.06603 9.60489 8.89948 9.53349 8.75683C9.46238 8.61417 8.89218 7.2108 8.65465 6.63976C8.42303 6.08403 8.18817 6.15908 8.01305 6.15037C7.84692 6.14208 7.65676 6.14039 7.4666 6.14039C7.27658 6.14039 6.96765 6.21165 6.70624 6.49724C6.44496 6.78269 5.70849 7.47236 5.70849 8.87573C5.70849 10.2791 6.73013 11.6348 6.87264 11.8251C7.01516 12.0154 8.88318 14.8953 11.7432 16.1301C12.4234 16.4241 12.9544 16.5994 13.3686 16.7308C14.0517 16.9478 14.673 16.9172 15.1644 16.8438C15.7123 16.7619 16.8511 16.154 17.0889 15.4881C17.3264 14.822 17.3264 14.2513 17.255 14.1322C17.1839 14.0133 16.9938 13.9421 16.7087 13.7993Z" fill="white"/>
                    </svg>
                    <a class="watsapp font-color--text-color font-family--opensans paragraph--16 letter-space--32 line-height--32" href="https://api.whatsapp.com/send?phone=<?php _e($whatsapp_number_nospace, "KingsPavilion");?>&text=Hi" title="Message to Kings Pavilion" target="_blank">
                        <?php _e($whatsapp_number, "KingsPavilion");?>
                    </a> 
                </div>
            </div>
            <!-- <hr> -->
            <?php 
            if($email_address):?>
            <div class="d-flex svgfoter align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="16" viewBox="0 0 21 16" fill="none">
                    <path d="M11.7516 10.2812C11.2506 10.6435 10.6687 10.835 10.0687 10.835C9.46872 10.835 8.88678 10.6435 8.38579 10.2812L0.134079 4.31361C0.0882975 4.2805 0.0436965 4.24599 0 4.21049V13.989C0 15.1102 0.838728 15.9999 1.85378 15.9999H18.2835C19.3171 15.9999 20.1373 15.0901 20.1373 13.989V4.21045C20.0935 4.24603 20.0488 4.28063 20.0029 4.31378L11.7516 10.2812Z" fill="white"/>
                    <path d="M0.78858 3.67812L9.04027 9.75994C9.35264 9.99017 9.71062 10.1053 10.0686 10.1053C10.4266 10.1053 10.7847 9.99013 11.097 9.75994L19.3487 3.67812C19.8425 3.3144 20.1373 2.70567 20.1373 2.04868C20.1373 0.919008 19.306 0 18.2842 0H1.85314C0.831332 4.34807e-05 0 0.919052 0 2.04977C0 2.70567 0.294823 3.3144 0.78858 3.67812Z" fill="white"/>
                </svg>
                <a class="emiladdress" href="mailto:<?php echo $email_address;?>" title="Email to Kings Pavilion"><?php echo $email_address;?></a>
            </div>            
            <!-- <hr> -->
            <?php endif;?>
        </div>
        <div class="newsletterterms protab-width--100 tab-width--100 mobile-width--100">
            <!-- <p class="newsletterTxt">newsletter subscription</p>    
            <div class="newsletter padding-bottom--70">
                <?/*php  
                    switch_to_blog(1);
                    $newsletter_pg_id  = _getTplPageID( 'newsletter' );
                    $newsletter_pg_url = get_permalink( $newsletter_pg_id );
                    restore_current_blog();
                */?>
                <form method="post" action="<?//php echo $newsletter_pg_url; ?>">
                    <input type="email" id="param_email" required="" name="param_news_email" placeholder="Your email address">
                    <button class="blue-btn" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                            <path d="M8.23633 15.6152V19.497C8.23633 19.7682 8.41041 20.0084 8.66819 20.0937C8.73264 20.1147 8.79876 20.1247 8.86404 20.1247C9.05988 20.1247 9.24903 20.0326 9.36955 19.8686L11.6402 16.7786L8.23633 15.6152Z" fill="white"/>
                            <path d="M20.7372 0.99141C20.5447 0.854987 20.2919 0.836575 20.0827 0.946215L1.25139 10.7803C1.02876 10.8967 0.897361 11.1344 0.915774 11.3846C0.935023 11.6357 1.10158 11.8499 1.33843 11.9311L6.57353 13.7205L17.7225 4.18771L9.09525 14.5817L17.8689 17.5805C17.9342 17.6023 18.0029 17.614 18.0715 17.614C18.1853 17.614 18.2983 17.583 18.3979 17.5228C18.5569 17.4257 18.6649 17.2625 18.6925 17.0792L20.9941 1.59568C21.0284 1.36134 20.9297 1.12867 20.7372 0.99141Z" fill="white"/>
                        </svg>
                    </button>
                </form>
            </div> -->
            <?php if($footer_text):?>
            <p class="newsletterTxt"><?php _e($footer_text , "KingsPavilion");?></p>
            <?php endif; 
            if($footer_description):
            ?>
            <div class="newsDescription font-color--white font-family--opensans paragraph--18 padding-bottom--30"><?php _e($footer_description, "KingsPavilion");?></div>
            <?php endif; ?>
            <div class="socialicons">
                <?php if($facebook):?>
                    <a href="<?php _e($facebook, "kingsPavilion");?>" target="_blank" title="Follow Kings Pavilion on Facebook">
                        <svg class="icon">
                            <use xlink:href="#kingspavilion-fb"></use>
                        </svg>
                    </a>
                <?php endif;?>
                <?php if($instagram):?>
                    <a href="<?php _e($instagram, "kingsPavilion");?>" target="_blank" title="Follow Kings Pavilion on Instagram">
                        <svg class="icon">
                            <use xlink:href="#kingspavilion-instagram"></use>
                        </svg>
                    </a>    
                <?php endif;?>
                <?php if($linkedin):?>
                    <a href="<?php _e($linkedin, "kingsPavilion");?>" target="_blank" title="Follow Kings Pavilion on Linkedin">
                        <svg class="icon">
                            <use xlink:href="#kingspavilion-linkedin"></use>
                        </svg>
                    </a>    
                <?php endif;?>
                <?php if($tiktok):?>
                    <a href="<?php _e($tiktok, "kingsPavilion");?>" target="_blank" title="Follow Kings Pavilion on Tiktok">
                        <svg class="icon">
                            <use xlink:href="#kingspavilion-tiktok"></use>
                        </svg>
                    </a>
                <?php endif;?>
                <?php if($x_account):?>
                    <a href="<?php _e($x_account, "kingsPavilion");?>" target="_blank" title="Follow Kings Pavilion on Twitter">
                        <svg class="icon">
                            <use xlink:href="#kingspavilion-twitter"></use>
                        </svg>
                    </a>
                <?php endif;?>
                <?php if($youtube):?>
                    <a href="<?php _e($youtube, "kingsPavilion");?>" target="_blank" title="Follow Kings Pavilion on Youtube">
                        <svg class="icon">
                            <use xlink:href="#kingspavilion-youtube"></use>
                        </svg>
                    </a>
                <?php endif;?>
            </div>            
        </div>
   </div>
   <div class="wrapper--80">
    <hr>
   </div>
   <div class="wrapper--80 bottomfooter d-flex justify-content-between align-items-center protab-flex-column tab-flex-column mobile-flex-column">
        <div class="bootom-menutags protab-padding-top--20 tab-padding-top--20 mobile-padding-top--20 tab-padding-bottom--20 protab-padding-bottom--20 mobile-padding-bottom--10">
            <?php  
                $args =  array(
                    "theme_location"    => "bottom-menu", 
                    "menu_id"           => "", 
                    "menu_class"        => "",
                    "container"         => false
                    ); 
                wp_nav_menu( $args );
            ?>
        </div>
        <div class="copywriteTxt tab-padding-bottom--20 protab-padding-bottom--20 mobile-padding-bottom--10">
            © <?php $year = date("Y"); echo $year;?> Kings Pavilion. All rights reserved.  
        </div>
        <div class="copywriteTxt">
            Website Designed and Developed by <a href="https://www.emarketingeye.com/" target="_blank" title="Emarketingeye">eMarketingEye</a>
        </div>
   </div>
</footer>



<!-- jquery calender -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" media="print" onload="if(media!='all')media='all'">
<noscript>
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</noscript>
 