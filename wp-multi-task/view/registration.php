<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
    <section>
        <div class="form billing-info online">
            <div class="sec-title usersuccess text-center">
                <h1><?php _e('Online Registration','wpmt'); ?> </h1>
                <span class="border"></span>
				<p class="status alert-success"></p>

            </div>
            <div class="privideinfo">
                <form name="register" id="register" method="post" action="">
                    <div class="form-group">
                        <label>
                            <?php _e('First Name','wpmt'); ?>
                        </label>
                        <input  class="form-control required" type="text" name="fname">
                    </div>
					<div class="form-group">
                        <label>
                            <?php _e('Last Name','wpmt'); ?>
                        </label>
                        <input  class="form-control required" type="text" name="lname">
                    </div>
                    <div class="form-group">
                        <label>
                            <?php _e('Nickname','wpmt'); ?>
                        </label>
                        <input type="text" name="nickname" class="form-control required" id="nickname">
                    </div>
                    <div class="form-group">
                        <label>
                            <?php _e('Date of birth','wpmt'); ?>
                        </label>
                        <input type="date" class="form-control required" name="dob-date" id="dob-date">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control required" id="email">
                    </div>
                    <div class="form-group">
                        <label>
                            <?php _e('Mobile Number','wpmt'); ?>
                        </label>
                        <input  type="number" class="form-control required" name="mobilenumber" id="mobilenumber">
                    </div>
                    <div class="form-group">
                        <label>
                            <?php _e('Address','wpmt'); ?>
                        </label>
                        <textarea class="form-control" name="address"></textarea>
                    </div>
                   
                    <div class="form-group form-group">
                        <input type="submit" name="sub_btn" value="Submit" class="userregsubmit btn btn-primary">
                    </div>
                    <!--<div id="ajax-loader">
                        <img width="25" src="<?php bloginfo('template_url'); ?>/inc/bookingsys/assets/images/ajax-loader.gif" />
                    </div>-->
                </form>
            </div>
        </div>

    </section>