<?php
add_action('init', 'register_user_shortcodes');
function register_user_shortcodes() {

    add_shortcode('user_main', 'user_main_func');
    add_shortcode('user_settings', 'user_settings_func');
    add_shortcode('user_subscription', 'user_subscription_func');
    add_shortcode('user_payments', 'user_payments_func');

}



function user_main_func() {
    
    ob_start();
    ?>
    <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/user_main.php' ); ?>
    <?php
    return ob_get_clean();

}

function user_settings_func() {
    
    ob_start();
    ?>
    <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/user-settings.php' ); ?>
    <?php
    return ob_get_clean();

}

function user_subscription_func() {

    $nonce = wp_create_nonce();
    $cancel_url = "?action=cancel_sub&wp_nonce={$nonce}";

    ob_start();
    ?>
    <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/user-subscription.php' ); ?>
    <?php
    return ob_get_clean();

}

function user_payments_func() {

    $trans = new Membership_transactions();

    // Filter data
    $filter['user_id'] = get_current_user_id();
    $result = $trans->get_transactions( $filter, $q );

    // Displayed items
    $list = $result['results'];
    
    ob_start();
    ?>
    <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/user-payments.php' ); ?>
    <?php
    return ob_get_clean();

}


