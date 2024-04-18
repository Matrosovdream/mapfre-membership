<?php
class NMI_gateway {

    private $url_transact = 'https://secure.nmi.com/api/transact.php'; 

    private $private_key;
    public $public_key; 

    public function __construct() {

        $this->private_key = 'k9WdU6XZ5hpV393tkACb9529hmFZa8Cd';
        $this->public_key = '9taA2K-9j3rWD-38w55v-aQwahB';

    }

    public function add_subscription( $data ) {

        $fields = array(
            'security_key' => $this->private_key,
            "recurring" => "add_subscription"
        );

        $response = $this->query( array_merge( $fields, $data ) );

        if( $response['response'] == 3 ) {
            $data = array(
                "error" => true,
                "message" => $response['responsetext']
            );
        } else {
            $data = array(
                "success" => true,
                "data" => $response
            );
        }

        return $data;

    }

    public function query( $data ) {

        $fields = http_build_query( $data );

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $this->url_transact);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json'
        ));

        // Execute cURL session and get the response
        $response = $this->parse_response( curl_exec($ch) );

        // Close cURL session
        curl_close($ch);

        /*
        echo "<pre>";
        print_r( $response );
        echo "</pre>";
        */

        return $response;
        
        // Check for errors
        if (curl_errno($ch)) {
            $response['error'] = true;
            $response['message'] = curl_error($ch);
        } else {
            return $response;
        }

    }

    private function parse_response( $response ) {

        parse_str($response, $array);
        return $array;

    }

}