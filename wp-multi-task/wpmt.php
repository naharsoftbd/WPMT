<?php
/*
Plugin Name: Wp Multi Task 
Plugin URI: http://www.nsbd.net/plugins/wp-mutli-task
Description: Create, edit, delete, manages your post, pages or custom post types from frontend. Create registration forms, frontend profile and more...
Version:  0.1
Author: Abu Jafar Md. Salah
Author URI: http://www.jafar.nsbd.net
Text Domain: wpmt
Domain Path: /languages
License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ) exit;
 define( 'WPMT_ROOT', dirname( __FILE__ ) );
 define('WPMT_ROOT_DIR', dirname(plugin_basename(__FILE__)));
 define('WPMT_URI', plugins_url('',__FILE__));
 define( 'WPMT_ASSET_URI', WPMT_URI . '/assets' );

 
require_once(ABSPATH . 'wp-load.php' );

include(plugin_dir_path( __FILE__ ).'include/core/Classes.functions.php'); 
include WPMT_ROOT.'/include/core/Class.login.php';
include WPMT_ROOT.'/include/core/Class.registration.php';
include WPMT_ROOT.'/include/core/Class.profile.php';
include WPMT_ROOT.'/include/admin/installer.php';


/**
 * Main class for WP Multi Task
 *
 * @package WP Multi Task
 */
 Class WP_Multi_Task {
	       
		       private static $_instance=null;
			   private $version = '0.1';

        function __construct() {
			    
				$this->wpmt_initiat();
				register_activation_hook( __FILE__, array($this, 'wpmt_install') );
				register_deactivation_hook( __FILE__, array($this, 'wpmt_uninstall') );
				add_action( 'init', array($this, 'wpmt_load_textdomain') );
				add_action( 'wp_enqueue_scripts', array($this, 'wpmt_enqueue_scripts') );

		}
		
// Single Design Pattern
			public static function init() {
				// Check if instance is already exists 
				if(self::$_instance==null){
					self::$_instance = new WP_Multi_Task();
				}
				return self::$_instance;
			}
	 
	/**
	 * Load plugin textdomain.
	 *
	 * @since 1.0.0
	 */
	function wpmt_load_textdomain() {
		  load_plugin_textdomain( 'wpmt', false, WP_LANG_DIR .'/'. dirname( plugin_basename( __FILE__ ) ) ); 
	}
	/* initiat the class  
	*/
	function wpmt_initiat(){
		WPMT_Login::init();
		WPMT_Registration::init();
		WPMT_Profile::init();
		
		if(is_admin){
			new WPMT_Admin_Installer();
			wpmt_Admin_Settings::init();
		}else{
		}
	}
	
	/**
     * Create tables on plugin activation
     *
     * @global object $wpdb
     */
	function wpmt_install() {
        global $wpdb;

        flush_rewrite_rules( false );

        $sqlwpmt11 = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}wpmt_transaction (
            `id` mediumint(9) NOT NULL AUTO_INCREMENT,
            `user_id` bigint(20) DEFAULT NULL,
            `status` varchar(255) NOT NULL DEFAULT 'pending_payment',
            `cost` varchar(255) DEFAULT '',
            `post_id` varchar(20) DEFAULT NULL,
            `pack_id` bigint(20) DEFAULT NULL,
            `payer_first_name` longtext,
            `payer_last_name` longtext,
            `payer_email` longtext,
            `payment_type` longtext,
            `payer_address` longtext,
            `transaction_id` longtext,
            `created` datetime NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
				
		   // Create post object
			$wpmt_login = array(
			  'post_title'    => 'Login',
			  'post_content'  => '[wpmt-login]',
			  'post_status'   => 'publish',
			  'post_author'   => get_current_user_id(),
			  'post_type'     => 'page',			
			);
			$wpmt_profile = array(
			  'post_title'    => 'Profile',
			  'post_content'  => '[wpmt-profile]',
			  'post_status'   => 'publish',
			  'post_author'   => get_current_user_id(),
			  'post_type'     => 'page'
			  );
			  $wpmt_registration = array(
			  'post_title'    => 'Registration',
			  'post_content'  => '[wpmt-registration]',
			  'post_status'   => 'publish',
			  'post_author'   => get_current_user_id(),
			  'post_type'     => 'page'
			  );
			  $wpmtpages = array('login' =>$wpmt_login, 'profile' => $wpmt_profile,'registration' => $wpmt_registration);
			  $pageid = array();
			  foreach($wpmtpages as $wpmtpage):
					// Insert the post into the database
				$pageid[] =	wp_insert_post($wpmtpage, $wp_error );				
			  endforeach;
	         update_option('wpmtpages',$pageid);
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        dbDelta( $sqlwpmt11 );

        update_option( 'wpmt_version', $this->version );
    }
   
	/**
     * Manage task on plugin deactivation
     *
     * @return void
     */
    function wpmt_uninstall() {
         
		  foreach(get_option('wpmtpages') as $pageid):
		     wp_delete_post ($pageid, true);
		  endforeach;
		  wp_reset_postdata ();
    }
	
// Plugin Init Function
function wpmt_enqueue_scripts(){     
    
    wp_register_style('bootstrap-min-css', plugin_dir_url( __FILE__ ).'assets/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-min-css');
    wp_register_style('jquery-ui-css', plugin_dir_url( __FILE__ ).'assets/css/jquery-ui.css');
    wp_enqueue_style('jquery-ui-css');
	wp_register_style('jquery.steps', plugin_dir_url( __FILE__ ).'assets/css/jquery.steps.css');
    wp_enqueue_style('jquery.steps');
	wp_register_style('font-awesome-min', plugin_dir_url( __FILE__ ).'assets/css/font-awesome.min.css');
    wp_enqueue_style('font-awesome-min');
	wp_register_style('wpmt-style', plugin_dir_url( __FILE__ ).'assets/css/style.css');
    wp_enqueue_style('wpmt-style');
	wp_register_style('wpmt-responsive', plugin_dir_url( __FILE__ ).'assets/css/responsive.css');
    wp_enqueue_style('wpmt-responsive');
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'jquery-ui-autocomplete' );
    wp_enqueue_script( 'suggest' );
    wp_enqueue_script( 'jquery-ui-slider' );
    wp_register_script('validate-script', plugin_dir_url( __FILE__ ).'assets/js/jquery.validate.js', array('jquery'));
    wp_enqueue_script('validate-script');
	wp_register_script('bootstrap-min-js', plugin_dir_url( __FILE__ ).'assets/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script('bootstrap-min-js');
	wp_register_script('jquery.steps-js', plugin_dir_url( __FILE__ ).'assets/js/jquery.steps.min.js', array('jquery'));
    wp_enqueue_script('jquery.steps-js');
	wp_register_script('wpmt-script', plugin_dir_url( __FILE__ ).'assets/js/wpmt-script.js', array('jquery'));
    wp_enqueue_script('wpmt-script');
    
    
    wp_localize_script( 'wpmt-script', 'ajax_auth_object', array(
	        'ajaxurl'			=> admin_url( 'admin-ajax.php' ),
			'redirecturl'		=> isset($options['login_redirect_URL']) ? $options['login_redirect_URL'] : home_url('/profile/'),
                        'redirecturl_login'		=> home_url('/login/'),
			'register_redirect'	=> isset($options['register_redirect_URL']) ? $options['register_redirect_URL'] : home_url('/login/'),
        	'loadingmessage'	=> __('Sending user info, please wait...')
    	));
        
    
}
 }
 
 # create new  object.
 $wpmt = WP_Multi_Task::init();
 

