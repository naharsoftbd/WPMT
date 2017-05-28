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
 }