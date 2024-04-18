<?php
class Membership_controllers_user {

    public function __construct() {

        add_action('init', array($this, 'init_cancel_sub'));

    }

    public function init_cancel_sub() {

        if( $_GET['action'] == 'cancel_sub' ) {

            // Do nothing
            if( !wp_verify_nonce( $_GET['wp_nonce'] ) ) {
                return true;
            }

            $user = new Membership_user( get_current_user_id() );
            $user->cancel_subscription();

        }

    }


}

new Membership_controllers_user();