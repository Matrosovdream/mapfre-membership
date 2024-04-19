<?php
add_shortcode( 'cxc_login_form', 'cxc_login_form_callback' );
function cxc_login_form_callback() {
	ob_start();

	if ( !is_user_logged_in() ) {

		global $errors_login;

		if (!empty( $errors_login ) ) {
			?>
			<div class="alert alert-danger">
				<?php echo $errors_login; ?>
			</div>
		<?php } ?>

		<form method="post" class="wc-login-form">
			<div class="login_form">
				<div class="log_user">
					<label for="user_name">Username</label>
					<input name="log" type="text" id="user_name" value="<?php echo isset($_POST['log']) ? $_POST['log'] : ''; ?>">
				</div>
				<div class="log_pass">
					<label for="user_password">Password</label>
					<input name="pwd" id="user_password" type="password">
				</div>
				<?php
				ob_start();
				do_action( 'login_form' );
				echo ob_get_clean();
				?>
				<?php wp_nonce_field( 'userLogin', 'formType' ); ?>
			</div>
			<button type="submit">LOG IN</button>
			<a href="/lost-password/">Forgot password?</a>
		</form>
        
		<?php
	} else {
		echo '<p class="error-logged">You are already logged in.</p>';
	}

	$login_form = ob_get_clean();
	return $login_form;
}

add_action( 'wp', 'cxc_user_login_callback' );

function cxc_user_login_callback() {

	if ( isset( $_POST['formType'] ) && wp_verify_nonce( $_POST['formType'], 'userLogin' ) ) {
		global $errors_login;
		$uName = $_POST['log'];
		$uPassword = $_POST['pwd'];		

		if ($uName == '' && $uPassword != '') {
			$errors_login = '<strong>Error! </strong> Username is required.';
		} elseif ($uName != '' && $uPassword == '') {
			$errors_login = '<strong>Error! </strong> Password is required.';
		} elseif ($uName == '' && $uPassword == '') {
			$errors_login = '<strong>Error! </strong> Username & Password are required.';
		} elseif ($uName != '' && $uPassword != '') {
			$creds = array();
			$creds['user_login'] = $uName;
			$creds['user_password'] = $uPassword;
			$creds['remember'] = false;
			$user = wp_signon( $creds, false );
			if ( is_wp_error($user) ) {
				$errors_login = $user->get_error_message();
			} else {				
				wp_set_current_user( $user->ID );
				wp_set_auth_cookie( $user->ID );
				do_action( 'wp_login', $user->user_login, $user );
				wp_redirect( '/user/' );
				exit;
			}
		}
	}
}