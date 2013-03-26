<?php
/**
 * Part of the Sideways8 Custom Login and Registration plugin
 */

if(!function_exists('s8_clr_get_form')):
    /**
     * Echos out the requested form
     * @since 0.8.1
     */
    function s8_clr_get_form($form = 'login', $args = array(), $errors = false) {
        global $s8_login_errors;
        if($errors === false)
            $errors = $s8_login_errors;
        switch($form) {
            case 'register': // Register user
                $redirect_url = ($_GET['redirect'] != '')?$_GET['redirect']:home_url();
                ?><form method="post" action="<?php echo s8_get_register_url($redirect_url); ?>" name="register" class="s8_form register_form">
                    <?php
                    if(is_wp_error($errors)) {
                        echo '<p class="error">'.$errors->get_error_message().'</p>';
                    }
                    elseif($errors !== false && !empty($errors) && !is_array($errors))
                        echo '<p class="notice">'.$errors.'</p>';
                    ?>
                    <p>
                        <input type="hidden" name="s8-register-nonce" value="<?php echo wp_create_nonce('s8-register-new-user') ?>" />
                        <label for="username"><?php _e('Username'); ?></label>
                        <?php if($args['split_lines']) echo '<br/>'; ?>
                        <input type="text" name="username" id="username" value="<?php echo $_POST['username']; ?>" required="required" /><br/>
                        <label for="email"><?php _e('Email Address'); ?></label>
                        <?php if($args['split_lines']) echo '<br/>'; ?>
                        <input type="email" name="email" id="email" value="<?php echo $_POST['email']; ?>" required="required" /><br/>
                        A password will be e-mailed to you.<br/>
                        <input type="hidden" name="redirect" value="<?php echo $redirect_url?$redirect_url:''; ?>" />
                        <input type="submit" name="s8-register" value="Register" />
                        <?php if($args['login'])
                            echo '<br/>'.s8_get_login_link(false);
                        if($args['forgot'])
                            echo '<br/>'.s8_get_forgot_password_link(s8_get_current_url()); ?>
                    </p>
                </form><?php
                break;
            case 'reset': // Password reset
                ?><form name="pass-reset" action="<?php echo home_url('/'.s8_login_registration::ep_login.'/?action=rp&key='.$_GET['key']); ?>" method="post" class="s8_form reset_form">
                    <?php
                    if(is_wp_error($errors)) {
                        echo '<p class="error">'.$errors->get_error_message().'</p>';
                    }
                    elseif($errors !== false && !empty($errors) && !is_array($errors))
                        echo '<p class="notice">'.$errors.'</p>';
                    ?>
                    <p>
                        <input type="hidden" name="s8-login-nonce" value="<?php echo wp_create_nonce('s8_wp_custom_login-nonce-reset'); ?>" />
                        <label for="new-pass"><?php _e('New Password'); ?></label>
                        <?php if($args['split_lines']) echo '<br/>'; ?>
                        <input type="password" name="new-pass" id="new-pass" /><br/>
                        <label for="new-pass-confirm"><?php _e('Confirm New Password'); ?></label>
                        <?php if($args['split_lines']) echo '<br/>'; ?>
                        <input type="password" name="new-pass-confirm" id="new-pass-confirm" /><br/>
                        <input type="submit" name="s8-login-reset" value="Change Password" />
                    </p>
                </form><?php
                break;
            case 'forgot': // Forgot password
                ?><form name="forgot" action="<?php echo s8_get_forgot_password_url(); ?>" method="post" class="s8_form forgot_form">
                    <?php
                    if(is_wp_error($errors)) {
                        echo '<p class="error">'.$errors->get_error_message().'</p>';
                    }
                    elseif($errors !== false && !empty($errors) && !is_array($errors))
                        echo '<p class="notice">'.$errors.'</p>';
                    ?>
                    <p>
                        <input type="hidden" name="s8-login-nonce" value="<?php echo wp_create_nonce('s8_wp_custom_login-nonce-forgot'); ?>" />
                        <label for="user_login"><?php _e('Username or Email'); ?></label>
                        <?php if($args['split_lines']) echo '<br/>'; ?>
                        <input type="text" name="user_login" id="user_login" value="<?php echo $_POST['user_login']; ?>" /><br/>
                        <input type="submit" name="s8-login-forgot" value="Get New Password" />
                        <?php if($args['login'])
                            echo '<br/>'.s8_get_login_link();
                        if($args['register'] && get_option('users_can_register'))
                            echo '<br/>'.s8_get_register_link(s8_get_current_url()); ?>
                    </p>
                </form><?php
                break;
            default: // Login form
                $redirect_url = ($_GET['redirect'] != '')?$_GET['redirect']:s8_get_current_url();
                global $wp_query;
                if(isset($wp_query->query_vars[s8_login_registration::ep_login]) && s8_get_current_url() == $redirect_url)
                    $redirect_url = home_url();
                ?><form action="<?php echo s8_get_login_url($redirect_url); ?>" name="login" method="post" class="s8_form login_form">
                    <?php
                    if(is_wp_error($errors)) {
                        echo '<p class="error">'.$errors->get_error_message().'</p>';
                    }
                    elseif($errors !== false && !empty($errors) && !is_array($errors))
                        echo '<p class="notice">'.$errors.'</p>';
                    ?>
                    <p>
                        <input type="hidden" name="s8-login-nonce" value="<?php echo wp_create_nonce('s8_CLR-login-nonce'); ?>" />
                        <input type="hidden" name="redirect" value="<?php echo $redirect_url; ?>" />
                        <label for="username"><?php _e('Username'); ?></label>
                        <?php if($args['split_lines']) echo '<br/>'; ?>
                        <input type="text" name="username" id="username" /><br/>
                        <label for="pwd"><?php _e('Password'); ?></label>
                        <?php if($args['split_lines']) echo '<br/>'; ?>
                        <input type="password" name="pwd" id="pwd" /><br/>
                        <?php //do_action('login_form'); ?>
                        <input type="checkbox" id="remember-me" name="remember" value="forever" />
                        <label for="remember-me"><? _e('Remember me'); ?></label><br />
                        <input type="submit" name="s8-login" value="<?php _e('Login'); ?>" class="login-button" />
                        <?php if($args['forgot'])
                            echo '<br/>'.s8_get_forgot_password_link();
                        if($args['register'] && get_option('users_can_register'))
                            echo '<br/>'.s8_get_register_link(s8_get_current_url()); ?>
                    </p>
                </form>
                <?php
        }
    }
endif;
