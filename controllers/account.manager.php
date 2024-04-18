<?php
class Membership_controllers_manager {

    public function __construct() {



        add_action('init', array($this, 'init_controllers_manager'));

    }

    public function init_controllers_manager() {

        if( !$this->check_permissions() ) {
            return false;
        }
        
        // Export members
        if( $_GET['action'] == 'export-members' ) {

            $mmb = new Membership_members();

            // Filter
            if( isset($_GET['membertype']) ) {
                $filter['filter']['subscription_status'] = $_GET['membertype'];
            }
            // Search
            if( isset($_GET['search']) ) {
                $filter['search'] = '*'.$_GET['search'].'*';
            }
            $mmb->get_members_list( $filter, $page=$_GET['pg'], $all=true );
            $members = $mmb->prepare_for_export();

            $report = new Membership_reports( $content=$members );
            $report->get_file();

        }

        // Export transactions
        if( $_GET['action'] == 'export-transactions' ) {

            $trans = new Membership_transactions();
            $list = $trans->get_transactions();

            $report = new Membership_reports( $content=$list );
            $report->get_file();

        }

    }

    private function check_permissions() {

        $user = new WP_User( get_current_user_id() );
        if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
            
            if( 
                in_array( 'manager', $user->roles ) ||
                in_array( 'administrator', $user->roles ) 
                ) {
                    return true;
                }

        }

        return false;

    }


}

new Membership_controllers_manager();