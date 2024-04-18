<?php
class Membership_user_roles {

    public function __construct() {
        add_action( 'init', array( $this, 'add_membership_roles' ) );
    }

    public function add_membership_roles() {

        /*
        add_role( 'custom_subscriber', 'Custom Subscriber', array(
            'read' => true, 
        ) );
        */

        add_role( 'manager', 'Manager', array(
            'read' => true,
            'edit_posts' => true,
            'delete_posts' => true,
            'manage_options' => true, // Example capability to manage site options.
        ) );
    }
}

new Membership_user_roles();
