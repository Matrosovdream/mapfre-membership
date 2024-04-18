<?php
class Membership_transactions {

    private $table;
    public $posts_per_page=15;

    public function __construct() {
        
        global $wpdb;
        $this->table = $wpdb->prefix.'membership_transactions';
        
    }

    public function get_transactions( $filter=array(), $search='' ) {

        global $wpdb;

        // Pagination
        $paged = 1;
        if( isset( $_GET['pg'] ) ) { $paged = $_GET['pg']; }

        // Limit, offset
        $offset = ($paged - 1) * $this->posts_per_page;
        $limit = "LIMIT {$this->posts_per_page} OFFSET {$offset}"; 

        // Filter
        if( is_iterable( $filter ) > 0 ) {
            $where = $this->prepare_where_condition( $filter );
        }

        if( $search != '' ) {
            $search = $this->prepare_search_condition($search);
            if( $where != '' ) {
                $where .= ' AND '.$search;
            } else {
                $where = "WHERE ".$search;
            }
        }

        // Results
        $query = "SELECT * FROM {$this->table} {$where} {$limit}";
        //echo $query; echo "<br/>";

        $results = $wpdb->get_results( $query, ARRAY_A );

        // Total count
        $query = "SELECT COUNT(1) FROM {$this->table} {$where}";
        $total_count = $wpdb->get_var( $query );

        $data = array(
            "results" => $results,
            "total_count" => $total_count,
            "total_pages" => $total_pages,
            "current_page" => $paged,
            "posts_per_page" => $this->posts_per_page,
            "filter" => $filter
        );

        /*
        echo "<pre>";
        print_r( $data );
        echo "</pre>";
        */

        return $data;

    }

    public function get_status_count( $status, $q='' ) {

        $result = $this->get_transactions( ["status" => $status], $q );
        
        /*
        echo "<pre>";
        print_r( $result );
        echo "</pre>";
        */
        
        return $result['total_count'];

    }

    private function prepare_search_condition( $q ) {

        // Search in members
        $mmb = new Membership_members();
        $filter = array("search" => $q);
        $filters['user_id'] = array_column( $mmb->get_members_list( $filter, $page=1, $all=true ), "ID");

        // Other fields
        $filters['transaction_id'] = $q;

        $where = [];
        foreach ($filters as $key => $values) {
            if (is_array($values)) {
                // Multiple values
                $valueList = implode(", ", $values);
                $where[] = "`$key` IN ($valueList)";
            } else {
                if( $key == 'transaction_id' ){
                    $where[] = "`$key` LIKE '%$values%'";
                }
                
            }
        }

        if( count( $where ) > 0 ) {
            return "(".implode(" OR ", $where).")";
        }

        
        print_r($where);

    }

    private function prepare_where_condition( $filters ) {

        $where = [];
        foreach ($filters as $key => $values) {
            if (is_array($values)) {
                // Multiple values
                $valueList = implode(", ", $values);
                $where[] = "`$key` IN ($valueList)";
            } else {
                // Single value
                $where[] = "`$key`='$values'";
            }
        }

        if( count( $where ) > 0 ) {
            return "WHERE " . implode(" AND ", $where);
        }

    }


    public function insert_transaction( $data ) {

        global $wpdb;

        $id = $wpdb->insert(
            $this->table,
            $this->prepare_values( $data )
        );

    }

    private function prepare_values( $data ) {

        $prepared_data = array(
            'user_id' => isset($data['user_id']) ? intval($data['user_id']) : null,
            'payment_method' => isset($data['payment_method']) ? sanitize_text_field($data['payment_method']) : '',
            'amount' => isset($data['amount']) ? floatval($data['amount']) : 0.0,
            'transaction_id' => isset($data['transaction_id']) ? sanitize_text_field($data['transaction_id']) : '',
            'status' => isset($data['status']) ? sanitize_text_field($data['status']) : '',
            'created_at' => date('Y-m-d H:i:s'), // Current time
            'plan_id' => isset($data['plan_id']) ? sanitize_text_field($data['plan_id']) : '',
        );

        return $prepared_data;

    }


    private function create_table() {

        $query = "
        CREATE TABLE `wp9p_membership_transactions` (
            `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `user_id` int NOT NULL,
            `payment_method` varchar(100) NOT NULL,
            `amount` int NOT NULL,
            `created_at` datetime NOT NULL,
            `status` varchar(100) NOT NULL,
            `transaction_id` varchar(100) NOT NULL
          );
          ";

    }

}