<?php
class Membership_controllers_registration {

    private $new_user_role = 'subscriber';
    private $payment_url = '/registration-payment/';

    private $metafields = array(
        "sub-type" => "sub_type",
        "customer-type" => "customer_type",
        "user-birthday" => "birthday",
        "user-passport" => "passport",
        "user-marital" => "marital_status",
        "use-sexo" => "user_sex",
        "user-cellular" => "phone",
        "occupation" => "occupation",
        "nationality" => "nationality",
        "residence" => "residence",
        "provincia" => "province",
        "district" => "district",
        "corregimento" => "corregiment",
        "neighborhood" => "neighbourhood",
        "street" => "street",
        "house" => "house",
        "pep" => "pep",
        "ben_1" => "beneficiary_1",
        "ben_2" => "beneficiary_2",
        "ben_3" => "beneficiary_3",
    );

    public function __construct() {

        add_action('init', array($this, 'init_membership_registration'));
        add_action('init', array($this, 'init_nmi_payment'));

    }

    public function init_membership_registration() {

        session_start();

        global $user_errors;

        if( $_POST['action'] == 'membership-registration' ) {

            $userdata = $_POST;

            /*
            echo "<pre>";
            print_r( $_POST );
            echo "</pre>";
            */

            // Check if the user already exists
            if (username_exists($userdata['email']) || email_exists($userdata['email'])) {
                $user_errors[] = __('User already exists');
                return $user_errors;
            }

            $password = wp_generate_password();

            // Insert the new user
            $user_id = wp_insert_user(array(
                'user_login' => $userdata['email'],
                'user_pass'  => $password, 
                'user_email' => $userdata['email'],
                'first_name' => $userdata['user-name'],
                'last_name'  => $userdata['user-surname'],
                'role'       => $this->new_user_role
            ));

            

            if( $user_id ) {

                // Add metafields
                foreach( $this->metafields as $postkey=>$metakey ) {
                    update_user_meta( $user_id, $metakey, $userdata[ $postkey ] );
                }

                // Save password temporarely
                update_user_meta( $user_id, "password", $password );

                update_user_meta( $user_id, "subscription_status", "active" );

                //echo get_user_meta( $user_id, "sub_type", true);

                // For the next steps
                $_SESSION['floating_user_id'] = $user_id;

                wp_redirect( $this->payment_url );
                exit();

            } else {
                $user_errors[] = __('Something went wrong');
            }

            return $user_errors;            

        }

    }

    public function init_nmi_payment() {

        if( isset($_GET['payment_token']) ) {

            $plan_id = $_GET['sub-id'];
            $token = $_GET['payment_token'];

            $user_id = $_SESSION['floating_user_id'];
            $user = new Membership_user( $user_id );
            $userdata = $user->get_data( $user_id );

            // Create NMI subscription
            $fields = array(
                "plan_id" => $plan_id,
                'payment_token' => $token,
                'first_name' => $userdata['meta']['first_name'],
                'last_name' => $userdata['meta']['last_name'],
                'email' => $userdata['email'],
                'orderid' => $user_id
            );
            $nmi = new NMI_gateway();
            $sub = $nmi->add_subscription( $fields );

            if( $sub['success'] ) { 

                /*
                echo "<pre>";
                print_r($sub);
                echo "</pre>";
                exit();
                */

                // Save user subscription
                update_user_meta( $user_id, "nmi_subscription_id", $sub['subscription_id'] );

                // Generate MAPFRE policy
                $user->policy->generate_policy();

                // Send user email with the Policy data and log in credentials
                $user->policy->send_policy_email();

                // Insert transaction
                $trans = new Membership_transactions();
                $fields = array(
                    "user_id" => $user_id,
                    "payment_method" => "nmi",
                    "amount" => $_GET['sub-price'],
                    "transaction_id" => $sub['data']['transactionid'],
                    "status" => "success",
                    "created_at" => date("Y-d-m H:i:s"),
                    "plan_id" => $_GET['sub-id'],
                );
                $trans->insert_transaction( $fields );


                // Redirect after
                $url = '/registration-payment/?paid=1';
                wp_redirect( $url );

            } else {
                $url = '/registration-payment/?error=1';
                wp_redirect( $url );
            }

        }

    }

}

new Membership_controllers_registration();