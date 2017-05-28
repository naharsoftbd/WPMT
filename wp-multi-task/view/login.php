<?php    
if(!is_user_logged_in()){    
?>
    <form id="login-form" name="login-form" action="" method="post">
        <div class="login">
            <h2>Log In</h2>
            <p class="status alert-success"></p>
            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
                <div class="form-group">
                    <label>
                        <?php _e('User Name:','documents'); ?>
                    </label>
                    <input type="text" class="form-control required" name="username" id="username"> </div>
                <div class="form-group">
                    <label>
                        <?php _e('Password:','documents'); ?>
                    </label>
                    <input type="password" class="form-control required" name="password" id="password"> </div>
                <div class="form-group">
                    <input type="submit" value="Submit" name="login-submit" class="login_sub_btn"> </div>
        </div>
    </form>
    <?php     }else{        ?>
        <!-- if login then redirect to home page -->
        <script>
            document.location.href = '<?php echo home_url('/profile'); ?>';
        </script>
        <?php     }   ?>