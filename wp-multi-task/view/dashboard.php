<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$wpmtprofile  =	WPMT_Profile::init();
$user_id = get_current_user_id();
$prefix = 'user_';
$single = true;
if(is_user_logged_in()){
?>
<div class="row">
    <div class="col-md-12">
        
        <div class="page-header">
            <h2 class="username text-left"><?php echo get_user_meta($user_id, 'first_name', $single );  ?><?php echo ' ' .get_user_meta($user_id, 'last_name', $single );  ?></h2>
        </div>
        <?php 
        
        
       $prefix = 'user_';
                   $author_id = $user_id;
                   $appdob = get_user_meta($author_id,$prefix.'dobdate',true);
                   $mobilenumber = get_user_meta($author_id,$prefix.'mobilenumber',true);
                   $address = get_user_meta($author_id,$prefix.'address',true);
                  
                    $exp_date = str_replace('/', '-', $appdob);
                    $dobdate = date("m/d/Y", strtotime($exp_date));
                    $where = get_posts_by_author_sql( 'booked' );
                    
                   
          
        ?>
        
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><?php _e('My Details','wpmt'); ?></a></li>
            <li><a data-toggle="tab" href="#menu1"><?php _e('Inbox','wpmt'); ?></a></li>
			<li><a data-toggle="tab" href="#changepass"><?php _e('Change Password','wpmt'); ?></a></li>
            <li><a  href="<?php echo wp_logout_url(home_url('/login')); ?>"><?php _e('Logout','wpmt'); ?></a></li>
        </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              <?php $this->userinfo(); ?>
              <ul class="userinfo">
                    <li><h4><?php _e('Date Of Borith (dob) : ','wpmt'); echo $appdob; ?></h4></li>
                    <li><h4><?php _e('Mobile Number : ','wpmt'); echo $mobilenumber; ?></h4></li>
                    <li><h4><?php _e('Address : ','wpmt'); echo $address; ?></h4></li>
                    
                </ul>
            </div>
            <div id="menu1" class="tab-pane fade">
                <ul>
            </ul>
             
            </div>
			<div id="changepass" class="tab-pane fade">
			<?php 
			    if(is_user_logged_in()){
					?>
					<form id="new-password-form" name="new-password-form" action="" method="post">
						 
						 <div class="changepass">
							<h2>Change Password</h2>
							<div class="form-group">
								<label>Old Password</label>
										   
								<input type="text" class="form-control" value="" name="old_password" id="old_password">
							</div>
							<div class="form-group">
								<label>New Password</label>
								<input type="password" class="form-control required" name="password" id="password">
							</div>
							<div class="form-group">
								<label>Confirm Password</label>
								<input type="password" class="form-control required" name="confirm_password" id="confirm_password">
							</div>
							<div class="form-group">
								<input type="button" value="Submit" class="change_passwd">
							</div>
						 
						 </div>

					</form>	
						<?php } ?>
			</div>
            
          </div>
        
    </div>
</div>
<?php }else{ 
    $url = home_url('/login');
        echo '<script>window.location.href = "'.$url.'"; </script>';
 } ?>