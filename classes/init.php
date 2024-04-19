<?php
class Membership_init {

    public function __construct() {

        //
        //$this->include_rest_api();

        // Classes
        $this->include_classes();

        // Hooks
        $this->include_hooks();

        // Shortcode
        $this->include_shortcodes();

        // Controllers
        $this->include_controllers();

    }

    private function include_shortcodes() {
    
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/shortcodes/registration.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/shortcodes/payment_form.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/shortcodes/user.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/shortcodes/manager.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/shortcodes/nmi_forms.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/shortcodes/login.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/shortcodes/reset-password.php' );

    }

    private function include_controllers() {

        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/controllers/registration.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/controllers/account.user.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/controllers/account.manager.php' );

    }

    private function include_classes() {

        // Users
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/classes/user.class.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/classes/user.roles.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/classes/user.policy.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/classes/members.class.php' );

        // Transactions
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/classes/transactions.class.php' );

        // Emails
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/classes/emails.class.php' );

        // Integrations
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/classes/nmi.class.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/classes/mapfre.class.php' );

        // Reports
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/classes/reports.class.php' );
        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/classes/export.csv.php' );

    }

    private function include_rest_api() {
        //require_once( PW_PLUGIN_DIR_ABS.'/classes/endpoints.php' );
    }

    private function include_hooks() {

        require_once( MEMBERSHIP_PLUGIN_DIR_ABS.'/hooks/scripts.php' );

    }

}

new Membership_init();