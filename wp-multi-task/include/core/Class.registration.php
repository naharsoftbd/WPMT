<?php 
/**
 * Create Account or Registration handler class
 *
 * @since 0.1
 * @author Abu Jafar Md. Salah <jafar@nsbd.net>
 */
 Class WPMT_Registration{
	 
	  private static $_instance = null;
	  
	  function __construct(){
		  
		  add_shortcode('wpmt-registration',array($this,'registration_view'));
		  add_action('wp_ajax_userregistration',array($this,'wpmt_userregistration'));
		  add_action('wp_ajax_nopriv_userregistration',array($this,'wpmt_userregistration'));
		  
	  }
	  
	  public static function init(){
		  if(self::$_instance==null){
			  self::$_instance = new WPMT_Registration;
		  }
		 
		 return self::$_instance;
	  }
	  
	  public function registration_view(){
		  include WPMT_ROOT.'/view/registration.php';
	  }
	  
	public function wpmt_userregistration(){
        
      parse_str($_POST["userreg"], $_POST);
      $fname = sanitize_text_field($_POST['fname']);
	  $lname = sanitize_text_field($_POST['lname']);
      $user_name = sanitize_text_field($_POST['nickname']);
      $dobdate = $_POST['dob-date'];
      $user_email = sanitize_email($_POST['email']);
      $mobilenumber = $_POST['mobilenumber'];
      $address = sanitize_textarea_field($_POST['address']);
            
        $user_id = username_exists($user_name);
        if(empty($user_id)){
            $user_id = email_exists($user_email);
        }
        if ( !$user_id and email_exists($user_email) == false ) {
                    $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
					$user_id = wp_create_user( $user_name, $random_password, $user_email );
                    $user = new WP_User($user_id);
 
                    $user_login = stripslashes($user->user_login);
                    $user_email = stripslashes($user->user_email);
                    
                    
                    if (empty($random_password) )
                        return;

                    $message .= __('Hi there,') . "\n";
                    $message .= sprintf(__("Welcome to %s! Here's how to log in:"), get_option('blogname')) . "\n";
                    $message .= home_url('/login') . "\n";
                    $message .= sprintf(__('Username: %s'), $user_login) . "\n";
                    $message .= sprintf(__('Password: %s'), $random_password) . "\n";
                    $message .= sprintf(__('If you have any problems, please contact me at %s.'), get_option('admin_email')) . "\n";
                    
                    $to = $user_email;
					$subject = sprintf(__('[%s] Your username and password'), get_option('blogname'));
					$body = 'The email body content';
					$headers = array('Content-Type: text/html; charset=UTF-8','From: '.get_option('blogname').' <'.get_option('admin_email').'>');
					 
					wp_mail( $to, $subject, $message, $headers );
                   
                echo '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>User '.__($user_name.' created successfully, please check your email inbox or junk or spam for getting password','istcoderbooking').'</div>';
        } else {
                echo $random_password = '<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.__('User already exists.  Password inherited.').'</div>';
        }
      // will return false if the previous value is the same as $new_value
        $prefix = 'user_';
        update_user_meta( $user_id, 'first_name', $fname);
		update_user_meta( $user_id, 'last_name', $lname);
        update_user_meta( $user_id, 'nickname', $user_name);
        update_user_meta( $user_id, 'display_name', $user_name);
        update_user_meta( $user_id, $prefix.'address', $address);
        update_user_meta( $user_id, $prefix.'dobdate', $dobdate);
        update_user_meta( $user_id, $prefix.'mobilenumber', $mobilenumber);
       
        
      die();
  }
 }