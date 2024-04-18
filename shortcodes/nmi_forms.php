<?php
add_action('init', 'register_nmi_shortcodes');
function register_nmi_shortcodes() {

    add_shortcode('nmi_paymentform_subscription', 'nmi_paymentform_subscription_func');
    //add_shortcode('user_settings', 'user_settings_func');

}



function nmi_paymentform_subscription_func( $atts, $content ) {

    ob_start();
    ?>
    <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/nmi-paymentform-subscription.php' ); ?>
    <?php
    return ob_get_clean();

}

/*
function user_settings_func() {
    
    ob_start();
    ?>
    <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/user-settings.php' ); ?>
    <?php
    return ob_get_clean();

}
*/


