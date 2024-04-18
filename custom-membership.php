<?php
/**
 * Plugin name: Custom Membership
 * Author: Stan Matrosov
 * Author URI: 
 * Description: 
 * Version: 1.0
 * License: GPL2
 */

 // defines
define('MEMBERSHIP_PLUGIN_DIR_ABS', WP_PLUGIN_DIR . '/custom-membership');
define('MEMBERSHIP_PLUGIN_DIR', plugin_dir_url( __FILE__ ));

// Init class
require_once('classes/init.php');

// NMI payments
//https://support.nmi.com/hc/en-gb/articles/14525725002385-Recurring-Payments-and-Subscriptions

add_action('init', 'init22');
function init22() {

    if( $_GET['test'] ) {

        $user = new Membership_user( 107 );
        //$user->policy->generate_policy();

        //$policy = $user->policy->get_policy();
        //print_r( $policy );

        $user->policy->send_policy_email();

        exit();

    }

    

}


/*
function register_my_session()
{
  if( !session_id() )
  {
    session_start();
  }
}
add_action('init', 'register_my_session');
*/
