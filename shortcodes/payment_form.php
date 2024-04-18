<?php
function nmi_payment_func() {

    $sub_types = array(
        "daily" => array("title" => "Membrecia Diaria $0,50 x 1 Día", "price" => "0.50"),
        "weekly" => array("title" => "Membrecia Semanal $3,50 x 1 Semana", "price" => "3.50"),
        "fortnightly" => array("title" => "Membrecia Quincenal $7,50 x 1 Quincena", "price" => "7.50"),
        "monthly" => array("title" => "Membrecía Mensual $15 x 1 Mes", "price" => "15.00"),
        "annually" => array("title" => "Membrecía Anual $180 x 1 Año", "price" => "180.00"),
    );


    $floating_user_id = $_SESSION['floating_user_id'];
    $sub_type = get_user_meta( $floating_user_id, "sub_type", true);
    $sub = $sub_types[ $sub_type ];

    ob_start();
    ?>

    <?php
    include( MEMBERSHIP_PLUGIN_DIR_ABS.'/templates/nmi_payment.php' );
    ?>

    <?php
    return ob_get_clean();

}

// Step 3: Wrapping into a Shortcode
function register_custom_registration_shortcode2() {
    add_shortcode('nmi_payment', 'nmi_payment_func');
}

add_action('init', 'register_custom_registration_shortcode2');
