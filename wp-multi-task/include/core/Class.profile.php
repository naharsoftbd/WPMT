<?php 
/**
 * Front end Profile or Dashboard handler class
 *
 * @since 0.1
 * @author Abu Jafar Md. Salah <jafar@nsbd.net>
 */
 
 Class WPMT_Profile{
	 
	  private static $_instance = null;
	  
		function __construct(){
			   add_shortcode('wpmt-profile',array($this,'wpmt_getProfileView'));
			   add_action('wp_ajax_wpmt_change_password',array($this,'wpmt_change_password'));
			   add_action('wp_ajax_nopriv_wpmt_change_password',array($this,'wpmt_change_password'));
		  }
	  
		public static function init() {
			if(self::$_instance==null){
				self::$_instance = new WPMT_Profile();
			}
			return self::$_instance;
		}
		
		public function wpmt_getProfileView(){
			include WPMT_ROOT .'/view/dashboard.php';
		}
		
	   public function wpmt_change_password(){
         $old_password = $_POST['old_password'];
         $password = $_POST['password'];
         $confirm_password = $_POST['confirm_password'];
         global $current_user; 
        $x = wp_check_password($old_password, $current_user->user_pass, $current_user->ID );
        if($password==$confirm_password && $x==1){
            wp_set_password($confirm_password, $current_user->ID);
            echo 'Changed Successful';
        }else{
            echo 'Wrong Old Password';
        }
       die();  
     }
 }