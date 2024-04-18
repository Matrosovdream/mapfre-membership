<?php
function custom_registration_form() {
    
    ob_start();
    
    $sub_types = array(
        "daily" => "Membrecia Diaria $0,50 x 1 Día",
        "weekly" => "Membrecia Semanal $3,50 x 1 Semana",
        "fortnightly" => "Membrecia Quincenal $7,50 x 1 Quincena",
        "monthly" => "Membrecía Mensual $15 x 1 Mes",
        "annually" => "Membrecía Anual $180 x 1 Año",
    );

    $customer_types = array(
        "contractor" => "Contractor",
        "policyholder" => "Policyholder",
        "responsible_for_payment" => "Responsible for Payment"
    );
    $marital_statuses = array(
        "single" => "Soltero",
        "married" => "Casado",
        "united" => "Unido"
    );
    $sex_types = array(
        "female" => "Femenino",
        "male" => "Masculino",
    );

    $pep_person = array(
        "yes" => "Sí",
        "no" => "No"
    );

    $identity_type = array(
        "cedula" => "Cédula Nacional",
        "extranera" => "Extranjero Residente",
        "passport" => "Pasaporte"
    );

    $countries = WC()->countries->countries;

    /*
    echo "<pre>";
    print_r($countries);
    echo "</pre>";
    */
    ?>

    <?php
    include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/registration.php' );
    ?>

    <?php
    return ob_get_clean();

}

// Step 3: Wrapping into a Shortcode
function register_custom_registration_shortcode() {
    add_shortcode('custom_registration_form', 'custom_registration_form');
}

add_action('init', 'register_custom_registration_shortcode');
