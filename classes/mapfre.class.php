<?php
class Mampfre_api {
    
    private $base_url = "https://app1.mapfre.com.pa/panama/webapi";
    private $token = null;

    private $api_username;
    private $api_password;

    private $error;

    public function __construct() {

        $this->api_username = 'V1NfVTE0NjY5MA==';
        $this->api_password = 'U2VsdWQxMDE=';

        $this->auth();

    }

    public function generate_policy(array $data) {

        $url = $this->base_url . "/api/apiexterno/Selud/GenerarPoliza";
        $res = $this->request($url, $data);

        return $res;

    }

    public function cancel_policy($policy_number) {

        $url = $this->base_url . "/api/apiexterno/Selud/CancelarPoliza";
        $data = ['numpoliza' => $policy_number];
        $this->request($url, $data);

    }

    private function request($url, array $data) {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);

    }

    private function auth() {

        $url = $this->base_url . "/token";
        $postData = http_build_query([
            'username' => $this->api_username,
            'password' => $this->api_password,
            'grant_type' => 'password'
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['TIPO_VALIDACION: PASSWORD']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        if (isset($data['access_token'])) {
            $this->token = $data['access_token'];
        } else {
            $this->error = true;
        }
        
    }

}


