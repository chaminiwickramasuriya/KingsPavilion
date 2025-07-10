<?php
/**
 * Template Name: Newsletter Confirm
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Kings Pavilion
 * @since Kings Pavilion 1.0
 */
global $post, $blog_id;
get_header();
global $wpdb; 
// Get token and find email
$_tok           =   $_REQUEST["token"];
$newsletter     =   _getTplPageIDs('newsletter' )[0];     
$pageurl        =   get_the_permalink($newsletter);
// $_sql   = "SELECT email_add FROM ".$wpdb->prefix."newsletter_subscribers WHERE reg_code = '6MAkx7mnCC'";

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active( 'dynamic-form-builder/dynamic_form_builder.php' ) ) {

   include_once( ABSPATH. 'wp-content/plugins/dynamic-form-builder/dynamic_form_builder.php' );

    $form_builder = new Form_Builder();

    $dbresult = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."newsletter_subscribers WHERE reg_code = '".$_tok."'" );

    if ($dbresult) {
        foreach ( $dbresult as $subscriber )   {
            $nl_title       = $subscriber->title;
            $nl_fname       = $subscriber->fname;
            $nl_email       = $subscriber->email_add;
            $nl_lname       = $subscriber->lname;
            $nl_subscribed  = $subscriber->subscribed;
            // var_dump($subscriber);
        }
        $err_msg = '';
        if($nl_subscribed == 0){
            $full_name  = $nl_title." ".$nl_fname." ".$nl_lname;
            $sitename   = get_bloginfo("name");

            $recipient_arr      = array();

            //Prepair Primary Array
            $recip_primary_array      = array();
            $recip_primary_array[0]['name']   = $full_name;
            $recip_primary_array[0]['email']  = $nl_email;
            $recip_primary_array[0]['active'] = true;

            //Combine primary,cc,bcc arrays into one single array
            $recipient_arr['primary'] = $recip_primary_array;

            $subject = $sitename.' :: Your Email Subscription is Successful';
            $form_title = 'Your Email Subscription is Successful';

            $tpl = '<div style="font-size:14px; padding: 18px 0 20px 0;margin: 20px 0;">Thank you. Your email address ('.$nl_email.') has been confirmed successfully.</div>';
            $attachment_arr = array();

            //Sending Email
            $mail_result = $form_builder->func_mail_send( $recipient_arr , $subject, $form_builder->func_email_template( $form_title, $tpl ), $attachment_arr);

           if ( $mail_result=='true' ){
                $_res   = $wpdb->update($wpdb->prefix."newsletter_subscribers",array("subscribed" => 1), array("reg_code" => $_tok));
                if ($_res) {
                    $err_msg = '<div role="alert" class="alert alert-success"><strong>Thank you!</strong> Your newsletter registration is successful.</div>';
                }else{
                    $err_msg = '<div role="alert" class="alert alert-danger"><strong>Oh snap!</strong> We are unable to find your email address, in our records. <a href="'.$pageurl.'">Click here to register</a>.</div>';
                }
           }
        }else{
            $err_msg = '<div role="alert" class="alert alert-danger"><strong>Oh snap!</strong> We are unable to find your email address, in our records. <a href="'.$pageurl.'">Click here to register</a>.</div>';
        }
    }
} 
?>



<section id="introduction" class="padding-top--130 padding-bottom--70">
    <?php get_template_part('inc/inc', 'introduction');?>
</section>

<?php get_footer();