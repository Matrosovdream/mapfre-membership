<?php
class Membership_user {

    public $user_id;
    public $userdata;
    public $policy;

    public function __construct( $user_id ) {

        $this->user_id = $user_id;

        $this->userdata = $this->get_data( $user_id );

        $this->policy = new Membership_user_policy( $user_id );

    }

    public static function get_data( $user_id ) {

        $data = array();
        $meta = get_user_meta( $user_id );

        $userdata = get_userdata( $user_id );

        $metadata = array();
        $metafields = array("first_name", "last_name", "sub_type", "customer_type", "birthday", "passport", "marital_status", "user_sex", "phone", "occupation", "nationality", "residence", "province", "district", "corregiment", "neighbourhood", "street", "house", "pep", "beneficiary_1", "beneficiary_2", "beneficiary_3", "password", "subscription_status", "policy_number");
        foreach( $metafields as $key ) {
            $metadata[ $key ] = get_user_meta( $user_id, $key, true );
        }

        $data = array(
            "ID" => $user_id,
            "email" => $userdata->data->user_email,
            "login" => $userdata->data->user_login,
            "meta" => $metadata,
            //"policy" => $this->policy->get_policy()
        );

        return $data;

        echo "<pre>";
        print_r( $data );
        echo "</pre>";

    }

    public function cancel_subscription() {

        // Cancel recurring payments
        

        // MAPFRE API requests
        $this->policy->cancel_policy();

        // Update meta value
        update_user_meta( $this->user_id, 'sub_status', 'inactive' );

    }

}