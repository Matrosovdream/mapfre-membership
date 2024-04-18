<?php
class Membership_user_policy {

    private $user_id;
    public $mail;

    public function __construct( $user_id ) {

        $this->api = new Mampfre_api();
        $this->mail = new Membership_emails();

        $this->user_id = $user_id;

    }

    public function send_policy_email() {

        $userdata = Membership_user::get_data( $this->user_id );
        $policy = $this->get_policy();

        $meta = array(
            "name" => $userdata['meta']['first_name'],
            "login" => $userdata['login'],
            "password" => $userdata['meta']['password'],
            "policy_url" => $policy['policy_url']
        );

        // Save file to the server
        $policy_server_path = $this->save_policy_to_server( $policy );

        $headers = array(
            'From: Me Myself <me@example.net>',
            'bcc: matrosovdream@gmail.com',
        );

        //$userdata['email'] = 'matrosovdream@gmail.com';

        $fields = array(
            "email_to" => $userdata['email'],
            "title" => "Thanks for subscription!",
            "meta" => $meta,
            "attachments" => array( $policy_server_path ),
            "headers" => $headers
        );

        /*
        echo "<pre>";
        print_r($userdata);
        echo "</pre>";

        echo "<pre>";
        print_r($fields);
        echo "</pre>";
        */

        $this->mail->send_email( $template="policy", $fields );

    }

    private function save_policy_to_server( $policy ) {

        $path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/policies/'.$policy['policy_number'].'.pdf';
        file_put_contents( $path, $policy['policy_base64'] );

        return $path;

    }

    private function remove_policy_server( $policy_number ) {



    }

    private function save_policy( $fields ) {

        $map = array(
            "NumeroPoliza" => "policy_number",
            "CertificadoUrl" => "policy_url",
            "CarnetBase64" => "policy_base64",
        );

        foreach( $fields as $key=>$value ) {
            update_user_meta( $this->user_id, $map[ $key ], $value );
        }

    }

    private function save_policy_server() {



    }

    public function get_policy() {

        $fields = array( "policy_number", "policy_url", "policy_base64" );
        
        $data = array();
        foreach( $fields as $key ) {
            $data[ $key ] = get_user_meta( $this->user_id, $key, true );
        }

        return $data;

    }

    public function generate_policy() {

        $userdata = Membership_user::get_data( $this->user_id );

        /*
        echo "<pre>";
        print_r( $userdata );
        echo "</pre>";

        echo 123;
        die();
        */

        $userdata = Membership_user::get_data( $this->user_id );
        $meta = $userdata['meta'];

        $fields = array(
            "tipoCliente" => $meta['customer_type'], 
            "nombre" => $meta['first_name'], 
            "apellido" => $meta['last_name'], 
            "fechaNacimiento" => null, 
            "tipoIdentificacion" => $meta['customer_type'], 
            "identificacion" => $meta['passport'], 
            "estadoCivil" => $meta['marital_status'], 
            "sexo" => $meta['user_sex'], 
            "telefono" => $meta['phone'], 
            "correoElectronico" => null, 
            "nacionalidad" => $meta['nationality'], 
            "paisResidencia" => $meta['residence'], 
            "provincia" => $meta['province'], 
            "distrito" => $meta['district'], 
            "corregimiento" => $meta['corregiment'], 
            "direccion" => null, 
            "pep" => null, 
            "relacionCargo" => null, 
            "pepInicio" => null, 
            "pepFin" => null, 
            "fechaInicio" => null, 
            "fechaFin" => null, 
            "Ocupacion" => null, 
            "pepFamiliares" => array(
                array(
                    "Nombre" => "Martin", 
                    "Apellido" => "Tor", 
                    "TipoIdentificacion" => null, 
                    "Identificacion" => "85412" 
                ),
            ),
            "benefSalud" => array(
                array(
                    "Nombre" => "Jose", 
                    "Apellido" => "Linares", 
                    "TipoIdentificacion" => null, 
                    "Identificacion" => "85334", 
                    "Porcentaje" => null 
                ),
                array(
                    "Nombre" => "Martin", 
                    "Apellido" => "Linares", 
                    "TipoIdentificacion" => null, 
                    "Identificacion" => "82254", 
                    "Porcentaje" => null 
                ),
                array(
                    "Nombre" => "Ricardo", 
                    "Apellido" => "Linares", 
                    "TipoIdentificacion" => null, 
                    "Identificacion" => "8544", 
                    "Porcentaje" => null 
                ),
            ),

        ); 

        $policy = $this->api->generate_policy( $fields );

        // Save response to user 
        $this->save_policy( $policy );

        return $policy;

    }

    public function cancel_policy() {

        $policy = $this->get_policy();

        // API request
        $this->api->cancel_policy( $policy['policy_number'] );

        // Clear meta fields
        $this->reset_policy();

    }

    private function reset_policy() {

        /*
        $fields = array("policy_number", "policy_url", "policy_base64");

        foreach( $fields as $key ) {
            update_user_meta( $this->user_id, $key, '' );
        }
        */

    }

}