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
		
	/**
     * Show user info on dashboard
     */
   public function userinfo() {
        global $userdata;

        //if ( wpmt_get_option( 'show_user_bio', 'wpmt_dashboard', 'on' ) == 'on' ) {
            ?>
            <div class="wpmt-author">
                <h3><?php _e( 'Author Info', 'wpmt' ); ?></h3>
                <div class="wpmt-author-inside odd">
                    <div class="wpmt-user-image"><?php echo get_avatar( $userdata->user_email, 80 ); ?></div>
                    <div class="wpmt-author-body">
                        <p class="wpmt-user-name"><a href="<?php echo get_author_posts_url( $userdata->ID ); ?>"><?php printf( esc_attr__( '%s', 'wpmt' ), $userdata->display_name ); ?></a></p>
                        <p class="wpmt-author-info"><?php echo $userdata->description; ?></p>
                    </div>
                </div>
            </div><!-- .author -->
            <?php
      //  }
    }
	
	/**
     * Change user password with current password from user profile
     */
    	
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