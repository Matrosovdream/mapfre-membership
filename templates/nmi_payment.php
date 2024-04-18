<div class="container mt-5 registration-payment-wrapper">

    <div class="text-justify text-center">
        <h1>Resumen Del Pedido</h1>
    </div>

    <div class="registration-payment-cart">

        <table class="cart">
            <thead>
                <tr>
                    <th scope="col">Suscripcion</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $sub['title']; ?></th>
                    <td>$<?php echo $sub['price']; ?></td>
                    <td>1</td>
                    <td>$<?php echo $sub['price']; ?></td>
                    <td><a href="#">Remove</a></td>
                </tr>
            </tbody>
        </table>

    </div>

    <?php if( $_GET['paid'] ) { ?>

        <div class="text-justify text-left">
            <h4>Subscription is paid!</h4>
        </div>

        <br/><br/><br/>

    <?php } else { ?>

        <br/>

        <div class="text-justify text-left">
            <h4>Seleccione metode de page</h4>
        </div>

        <div class="payment-method-selection">
            <div class="row" style="width: 300px;">
                <div class="col">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/Old_Visa_Logo.svg/1090px-Old_Visa_Logo.svg.png" />
                </div>
                <div class="col">
                    <img src="https://violetarchive.fra1.digitaloceanspaces.com/wp-content/uploads/2022/02/05120238/PayPal-Logo.png" />
                </div>
            </div>
        </div>

        <br/>

        <div class="payment-form-wrapper">
            <?php echo do_shortcode('[nmi_paymentform_subscription sub-id="'.$sub_type.'" sub-price="'.$sub['price'].'"]'); ?>
        </div>

        <br/><br/><br/>

    <?php } ?>

</div>










































<style>

.entry-title {
    display: none!important;
}

</style>
