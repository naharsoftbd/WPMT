<?php 
/**
 * Login and forgot password handler class
 *
 * @since 0.1
 * @author Abu Jafar Md. Salah <jafar@nsbd.net>
 */
	class WPMT_Login {
			
			private $message = array();
			private static $_instance = null;
			
			function __construct(){
				add_shortcode('wpmt-login',array($this,'wpmt_login_view'));
				add_action( 'wp_ajax_process_login', array($this,'wpmt_process_login'));
				add_action( 'wp_ajax_nopriv_process_login', array($this,'wpmt_process_login'));
			}
			
		    public static function init(){
				if(self::$_instance==null){
					self::$_instance = new WPMT_Login();
				}
				return self::$_instance;
			}
		   
		   function wpmt_login_view(){
			   include WPMT_ROOT.'/view/login.php';
		   }
		   
		   function wpmt_process_login(){
			    parse_str($_POST["userreg"], $_POST);
			    $user_login = $_POST['username']; 
				$password = $_POST['password'];
			    $info = array();
				$info['user_login'] = $user_login;
				$info['user_password'] = $password;
				if(!empty($_POST['rememberme'])){
					$info['remember'] = true;
				}
				
				$user_signon = wp_signon( $info, false );
				header("Content-Type: application/json", true);
				if ( is_wp_error($user_signon) ){
					echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
				} else {
					wp_set_current_user($user_signon->ID); 
					echo json_encode(array('loggedin'=>true, 'message'=>__($login.' successful, redirecting...')));
				}
				die();
		   }
		
		
	}

