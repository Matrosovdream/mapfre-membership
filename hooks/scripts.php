
<?php
function add_stylesheet_to_head() {

    // CSS
    echo '<link rel="stylesheet" href="'.MEMBERSHIP_PLUGIN_DIR.'inc/membership.css?time='.time().'" crossorigin="anonymous">';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" crossorigin="anonymous">';

    // JS scripts
    echo '<script src="'.MEMBERSHIP_PLUGIN_DIR.'inc/membership.js?time='.time().'" crossorigin="anonymous"></script>';
    echo '<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>';
	
}
add_action( 'wp_head', 'add_stylesheet_to_head' );








