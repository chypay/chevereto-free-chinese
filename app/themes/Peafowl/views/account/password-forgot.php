<?php if (!defined('access') or !access) {
    die('This file cannot be directly accessed.');
} ?>
<?php G\Render\include_theme_file('head'); ?>
<body id="login" class="full--wh">
	<?php G\Render\include_theme_file('custom_hooks/body_open'); ?>
	<div class="display-flex height-min-full">
		<?php G\Render\include_theme_file('snippets/quickty/background_cover'); ?>
		<div class="flex-center">
			<div class="content-box card-box col-8-max text-align-center">
			<div class="fancy-box">
				<h1 class="fancy-box-heading"><?php _se('Forgot password?'); ?></h1>
				<?php
                    if (is_process_done()) {
                        ?>
				<div class="content-section"><?php _se("An email with instructions to reset your password has been sent to the registered email address. If you don't receive the instructions try checking your junk or spam filters."); ?></div>
				<?php
                    } elseif (CHV\Login::isLoggedUser()) {
                        ?>
				<?php if (is_error()) {
                            ?>
				<div class="content-section"><?php echo get_error(); ?></div>
				<?php
                        } else {
                            ?>
				<div class="content-section"><?php _se('A previous email has been sent with instructions to reset your password. If you did not receive the instructions try checking your junk or spam filters.'); ?></div>
				<div class="content-section"><a href="<?php echo G\get_base_url('account/password-forgot'); ?>" class="btn btn-input default"><?php _se('Resend instructions'); ?></a></div>	
				<?php
                        }
                    } else {
                        ?>
				<div class="content-section"><?php _se('Enter your username or email address to continue. You may need to check your spam folder or whitelist %s', CHV\obfuscate(CHV\Settings::get('email_from_email'))); ?></div>
				<form method="post" autocomplete="off" data-action="validate">	
					<fieldset class="fancy-fieldset">
						<div>
							<input type="text" name="user-subject" id="form-user-subject" class="input animate" value="<?php echo get_safe_post()['user-subject']; ?>" placeholder="<?php _se('Username or Email address'); ?>" required>
							<div class="text-align-left red-warning"><?php echo get_input_errors()['user-subject']; ?></div>
						</div>
					</fieldset>
					<?php G\Render\include_theme_file('snippets/quickty/recaptcha_form'); ?>
					<div class="content-section">
						<button class="btn btn-input default" type="submit"><?php _se('Submit'); ?></button>
					</div>
				</form>
				<?php
                    }
                ?>
			</div>
		</div>
	</div>
	<?php G\Render\include_theme_file('snippets/quickty/top_left'); ?>
</div>

<?php if (get_post() && is_error()) {
                    ?>
<script>
$(document).ready(function() {
	PF.fn.growl.expirable("<?php echo get_error(); ?>");
});
</script>
<?php
                }
G\Render\include_theme_footer(); ?>