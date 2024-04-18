<script 
    src="https://secure.nmi.com/token/Collect.js"
    data-tokenization-key="<?php echo (new NMI_gateway)->public_key; ?>"
    data-variant="inline"
    data-style-sniffer="true"
    data-payment-selector="#payButton"
    data-field-ccnumber-selector = '#ccnumber'
    data-validation-callback="(
    function(fieldName, valid, message) {
            if (valid) {
                jQuery('#'+fieldName+'-note').html('');
                console.log(fieldName);
            } else {
                jQuery('#'+fieldName+'-note').html( message );
                console.log(fieldName);
            }
        }
    )"
></script>

<!--
<form action="pay.php" type="POST">
    <div id="ccnumber"></div>
    <div id="ccexp"></div>
    <div id="cvv"></div>
    <input id="payButton" type="submit" value="Submit Payment">
</form>
-->


<form action="" type="POST" class="payment-form">

    <input type="hidden" name="sub-id" value="<?php echo $atts['sub-id']; ?>" />
    <input type="hidden" name="sub-price" value="<?php echo $atts['sub-price']; ?>" />

    <div class="row">
        <div class="col-12">
            <div class="form__div">
                <label for="" class="form__label">Card Number</label>
                <div id="ccnumber"></div>
                <span id="ccnumber-note" class="payment-error"></span>
            </div>
        </div>

        <div class="col-6">
            <div class="form__div">
                <label for="" class="form__label">MM/yy</label>
                <div id="ccexp"></div>
                <span id="ccexp-note" class="payment-error"></span>
            </div>
        </div>

        <div class="col-6">
            <div class="form__div">
                <label for="" class="form__label">CVV code</label>
                <div id="cvv"></div>  
                <span id="cvv-note" class="payment-error"></span>
            </div>
        </div>
        <!--
        <div class="col-12">
            <div class="form__div">
                <label for="" class="form__label">Name on the card</label>
                <input type="text" class="form-control" placeholder=" ">   
            </div>
        </div>
        -->

        <div class="col-12 text-center">
            <br/>
            <input id="payButton" type="submit" value="Pay" placeholder="Pay" class="form-control1" style="width: 250px;" />
            <!--<input type="submit" value="Submit" class="btn btn-primary w-100" />-->
        </div>
    </div>
</form>