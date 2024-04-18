<?php
add_action('init', 'register_manager_shortcodes');
function register_manager_shortcodes() {

    add_shortcode('manager_main', 'manager_main_func');
    add_shortcode('manager_members', 'manager_members_func');
    add_shortcode('manager_transactions', 'manager_transactions_func');

}



function manager_main_func() {
    
    ob_start();
    ?>
    <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/manager-main.php' ); ?>
    <?php
    return ob_get_clean();

}

function manager_members_func() {

    if( isset($_GET['id']) ) {

        /*
        $user = new Membership_user( $_GET['id'] );
        $userdata = $user->get_data();
        $policy = $user->get_policy();
        */

        $user_id = $_GET['id'];
        $userdata = Membership_user::get_data( $user_id );

        $udata = get_userdata( $user_id );
        $registered = $udata->user_registered;  

        // Transactions
        $mmb = new Membership_members();
        $transactions = $mmb->get_user_transactions( $user_id, $filter=array() );

        /*
        echo "<pre>";
        print_r($transactions['results']);
        echo "</pre>";
        */

        //print_r($policy);

    } else {

        $mmb = new Membership_members();

        // Filter
        if( isset($_GET['membertype']) ) {
            $filter['filter']['subscription_status'] = $_GET['membertype'];
        }
        // Search
        if( isset($_GET['search']) ) {
            $filter['search'] = '*'.$_GET['search'].'*';
        }

        $active_count = $mmb->get_active_subscriptions( $filter );
        $inactive_count = $mmb->get_inactive_subscriptions( $filter );

        //if( isset($_GET['page']) ) { $page=$_GET['page']; } else { $page=1; }
        $members = $mmb->get_members_list( $filter, $page=$_GET['pg'] );
        $pagination = $mmb->get_pagination();

        foreach( $members as $key=>$item ) {

            $transactions = $mmb->get_user_transactions( $item['ID'] );
            $members[$key]['transactions_sum'] = array_sum( array_column( $transactions['results'], "amount" ) );

        }

    }

    /*
    echo "<pre>";
    print_r($members);
    echo "</pre>";
    */

    /*
    echo "<pre>";
    print_r($pagination);
    echo "</pre>";
    */
    
    ob_start();
    ?>

    <?php if( isset($_GET['id']) ) { ?> 
        <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/manager-members-single.php' ); ?>
    <?php } else { ?>
        <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/manager-members.php' ); ?>
    <?php } ?>

    <?php
    return ob_get_clean();

}

function manager_transactions_func() {
    
    ob_start();

    $trans = new Membership_transactions();

    // Filter data
    if( isset($_GET['status']) ) {
        $filter['status'] = $_GET['status'];
    }
    if( isset($_GET['q']) ) { $q = $_GET['q']; }

    $result = $trans->get_transactions( $filter, $q );

    // Displayed items
    $list = $result['results'];

    // Statuses acount
    $success_count = $trans->get_status_count("success", $q);
    $failed_count = $trans->get_status_count("failed", $q); 
    ?>
    <?php include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/manager-transactions.php' ); ?>
    <?php
    return ob_get_clean();

}



