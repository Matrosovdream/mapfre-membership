<?php
class Membership_members {

    private $user_role = 'subscriber';
    public $query_res;
    public $posts_per_page=15;

    public function __construct() {

    }

    public function get_members_list( $filter=array(), $page=1, $all=false ) {

        if( !$page ) { $page=1; }

        if( $all ) { $this->posts_per_page = -1; }

        // Filter
        if( isset($filter['filter']) && is_iterable( $filter['filter'] ) ) {
            $metaquery['relation'] = 'AND';
            foreach( $filter['filter'] as $key=>$value ) {

                $metaquery[] = array(
                    'key'     => $key,
                    'value'   => $value,
                    'compare' => '=' 
                );

            }
        }
    
        // Search
        if( isset($filter['search']) ) {
            $search = "*".$filter['search']."*";
        }
        
        $args = array(
            'role'   => $this->user_role,
            'number' => $this->posts_per_page,
            'paged' => $page,
            'meta_query' => $metaquery,
            'search' => $search,
            //'search' => ''
            //'fields' => ['ID'],
        );
        $args['_meta_or_title'] = $search;

        /*
        echo "<pre>";
        print_r( $args );
        echo "</pre>";
        */

        $res = new WP_User_Query( $args );
        $this->query_res = $res;

        $result = [];
        foreach( $res->get_results() as $item ) {
            $result[] = Membership_user::get_data( $item->ID );
        }

        /*
        echo "<pre>";
        print_r( $result );
        echo "</pre>";
        */

        return $result;

    }

    public function get_active_subscriptions( $filter=array() ) {
        
        $filter['filter']['subscription_status'] = 'active';
        $members = $this->get_members_list( $filter, $page=1, $all=true );

        return count( $members );

    }

    public function get_inactive_subscriptions( $filter=array() ) {
        
        $filter['filter']['subscription_status'] = 'inactive';
        $members = $this->get_members_list( $filter, $page=1, $all=true );

        return count( $members );

    }

    public function get_pagination( $base_url='' ) {

        if( !isset($this->query_res) ) { return false; }

        $res = $this->query_res;

        return array(
            "total" => $res->total_users,
            "items_per_page" => $this->posts_per_page,
            "current_page" => $res->query_vars['paged']
        );

        /*
        $pagination = [];
        $res = $this->query_res;

        $total_items = $res->total_users;
        $current_page = $res->query_vars['paged'];

        if( $base_url == '' ) {
            $current_url = $this->get_current_url();
        }

        $total_pages = ceil($res->total_users / $this->posts_per_page);

        $page=1;
        while( $page <= $total_pages ) {
            $pagination[ $page ] = array(
                "url" => add_query_arg( array("pg" => $page), $current_url ),
                "active" => ($page == $current_page) ? true : false
            );
            $page++;
        }

        return $pagination;
        */

    }

    private function get_current_url() {

        $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return $url;

    }

    public function prepare_for_export() {

        $res = $this->query_res;
        $data = [];
        foreach( $res->get_results() as $item ) {

            $user = Membership_user::get_data( $item->ID );

            $data[] = array(
                "ID" => $user['ID'],
                "Nombre" => $user['meta']['first_name'],
                "Nombre 2" => $user['meta']['last_name'],
                "Email" => $user['email'],
                "Status" => get_user_meta( $user['ID'], 'subscription_status', true ),
                "Policy Number" => get_user_meta( $user['ID'], 'policy_number', true )
            );

        }

        echo "<pre>";
        print_r($data);
        echo "</pre>";

    }

    public function get_user_transactions( $user_id, $filter=array() ) {

        $trans = new Membership_transactions();
        $trans->posts_per_page = 1000;

        $list = $trans->get_transactions( array("user_id" => $user_id) );

        return $list;

        echo "<pre>";
        print_r($list);
        echo "</pre>";

    }

}