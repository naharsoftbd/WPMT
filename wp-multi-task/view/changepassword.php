<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
/* 
 * post list page
 */

    if (!is_user_logged_in()) {
      $url = home_url('/login');
        echo '<script>window.location.href = "'.$url.'"; </script>';
    }
    if(isset($_GET['password']) && is_user_logged_in()){
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