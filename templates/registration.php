<?php
global $user_errors;
?>

<div class="container mt-5 registration-form-wrapper">


<div class="text-justify text-center">
    <h1>Join SELUD today!</h1>
</div>

    <br/>
    <div class="registration-errors">
        <?php foreach( $user_errors as $error ) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>    
    </div>

    <form class="registration-form" method="post">

        <input type="hidden" name="action" value="membership-registration" />

        <div class="form-group">
            <label for="fullName">Tipos de Membrecía *</label>

            <?php foreach( $sub_types as $key=>$value ) { ?>

                <div class="form-check">
                    <input 
                        class="form-check-input sub-type" 
                        type="radio" 
                        name="sub-type" 
                        value="<?php echo $key; ?>"
                        id="type-<?php echo $key; ?>"
                        <?php if( $key == 'daily' ) { echo 'checked'; } ?>
                        >
                    <label class="form-check-label" for="type-<?php echo $key; ?>">
                        <?php echo $value; ?>
                    </label>
                </div>

            <?php } ?>

        </div>
        <div class="form-group">
            <label for="emailAddress">Tipo de Cliente *</label>
            
            <select class="form-select" id="customer-type" name="customer-type" aria-label="">
                <option></option>
                <?php foreach( $customer_types as $key=>$value ) { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>    
            </select>

        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Nombre *</label>
                    <input type="text" name="user-name" id="user-name" class="form-control" placeholder="">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Appellidos *</label>
                    <input type="text" name="user-surname" id="user-surname" class="form-control" placeholder="">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="">Fecha de Nacimiento *</label>
            <input type="date" name="user-birthdate" id="user-birthdate" class="" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Tipo de Identificación *</label>
            <select class="form-select" name="user-marital" id="user-marital">
                <option></option>
                <?php foreach( $identity_type as $key=>$value ) { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>    
            </select>
        </div>
        <div class="form-group">
            <label for="">Número Identificación *</label>
            <input type="text" name="user-passport" id="user-passport" placeholder="">
        </div>
        <div class="form-group">
            <label for="emailAddress">Estado Civil *</label>
            
            <select class="form-select" name="user-marital" id="user-marital">
                <option></option>
                <?php foreach( $marital_statuses as $key=>$value ) { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>    
            </select>

        </div>
        <div class="form-group">
            <label for="emailAddress">Sexo *</label>
            
            <select class="form-select" name="user-sexo" id="user-email">
                <option></option>
                <?php foreach( $sex_types as $key=>$value ) { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>    
            </select>

        </div>
        <div class="form-group">
            <label for="">Su Número Celular *</label>
            <input type="text" name="user-cellular" id="user-cellular" />
        </div>
        <div class="form-group">
            <label for="">Email *</label>
            <input type="text"  name="email" id="email" />
        </div>
        <div class="form-group">
            <label for="">Ocupación *</label>
            <input type="text"  name="occupation" id="occupation" />
        </div>
        <div class="form-group">
            <label for="emailAddress">Nacionalidad *</label>
            
            <select class="form-select" name="nationality" id="nationality">
                <option></option>
                <?php foreach( $countries as $key=>$value ) { ?>
                    <option 
                        value="<?php echo $key; ?>"
                        <?php if( $key == 'PA' ) { echo "selected"; } ?>
                        >
                        <?php echo $value; ?>
                    </option>
                <?php } ?>    
            </select>

        </div>
        <div class="form-group">
            <label for="emailAddress">País de Residencia *</label>
            
            <select class="form-select"  name="residence" id="residence">
                <option></option>
                <?php foreach( $countries as $key=>$value ) { ?>
                    <option 
                        value="<?php echo $key; ?>"
                        <?php if( $key == 'PA' ) { echo "selected"; } ?>
                        >
                        <?php echo $value; ?>
                    </option>
                <?php } ?>     
            </select>

        </div>
        <div class="form-group">
            <label for="">Provincia *</label>
            <input type="text" name="provincia" id="provincia" />
        </div>
        <div class="form-group">
            <label for="">Distrito *</label>
            <input type="text" name="district" id="district" />
        </div>
        <div class="form-group">
            <label for="">Corregimiento *</label>
            <input type="text" name="corregimento" id="corregimento" />
        </div>
        <div class="form-group">
            <label for="">Barriada *</label>
            <input type="text" name="neighborhood" id="neighborhood" />
        </div>
        <div class="form-group">
            <label for="">Calle *</label>
            <input type="text" name="street" id="street" />
        </div>
        <div class="form-group">
            <label for="">Casa/Edificio *</label>
            <input type="text" name="house" id="house" />
        </div>

        <div class="form-group">
            <label for="emailAddress">¿Eres una persona políticamente expuesta?</label>
            
            <select class="form-select" name="pep" id="pep" style="width: 200px;" id="pep-person">
                <option></option>
                <?php foreach( $pep_person as $key=>$value ) { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>    
            </select>

        </div>

        <div class="form-group pep-block">
            <label for="">Relación/Cargo *</label>
            <input type="text" name="pep[position]" id="pep-position" />
        </div>

        <div class="form-group pep-block">
            <label for="">Desde *</label>
            <input type="date" name="pep[from]" id="pep-from" />
        </div>

        <div class="form-group pep-block">
            <label for="">Hasda *</label>
            <input type="date" name="pep[to]" id="pep-to" />
        </div>

        <div class="form-group pep-block">
            <label for="">Nombre *</label>
            <input type="text" name="pep[fullname]" id="pep-fullname" />
        </div>

        <div class="form-group pep-block">
            <label for="">Tipo de Identificación *</label>
            <input type="text" name="pep[passport]" id="pep-passport" />
        </div>



        <br/><br/>

        <h4>Primer Beneficiario</h4>
        <div class="form-group">
            <label for="">Nombre Completo *</label>
            <input type="text"  name="ben1[name]" id="ben1-name" />
        </div>
        <div class="form-group">
            <label for="">Cédula *</label>
            <input type="text" name="ben1[card]" id="ben1-card" />
        </div>
        <div class="form-group">
            <label for="">Porcentaje *</label>
            <input type="number" name="ben1[percentage]" id="ben1-percentage" />
        </div>

        <br/><br/>

        <h4>Segundo Beneficiario</h4>
        <div class="form-group">
            <label for="">Nombre Completo</label>
            <input type="text"  name="ben2[name]" id="ben2-name" />
        </div>
        <div class="form-group">
            <label for="">Cédula</label>
            <input type="text" name="ben2[card]" id="ben2-card" />
        </div>
        <div class="form-group">
            <label for="">Porcentaje</label>
            <input type="number" name="ben2[percentage]" id="ben2-percentage" />
        </div>

        <br/><br/>

        <h4>Tercer Beneficiario</h4>
        <div class="form-group">
            <label for="">Nombre Completo</label>
            <input type="text"  name="ben3[name]" id="ben3-name" />
        </div>
        <div class="form-group">
            <label for="">Cédula</label>
            <input type="text" name="ben3[card]" id="ben3-card" />
        </div>
        <div class="form-group">
            <label for="">Porcentaje</label>
            <input type="number" name="ben3[percentage]" id="ben3-percentage" />
        </div>

        <br/>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="check_terms" id="checkTerms" />
            <label class="form-check-label" for="checkTerms">
                Al hacer click en esta casilla certifico que he leído, comprendo y apruebo la <b>Autorización</b> y <b>Certificación</b> que se indican aquí en esta página después del Boton <b>Guardar</b>:
            </label>
        </div>

        <br/><br/>


        <div class="text-justify text-center">
            <input type="submit" name="send" value="Register" class="btn btn-primary btn-lg btn-block" />
            <!-- <button type="button" class="btn btn-primary btn-lg btn-block">Register</button> -->
        </div>

        <br/><br/>

            </form>
        </div>
<br/><br/>

        <div class="text-justify">

        <b>BENEFICIARIOS:</b> Serán los herederos legales del Asegurado, reconocidos mediante resolución en firme y ejecutoriada dictada por el Tribunal de Justicia competente, a través de un proceso judicial de sucesión. 
<br><br>
<b>AUTORIZACIÓN:</b>
Autorizo al CONTRATANTE y AL CORREDOR a que reciba y acepte en mi nombre cualquier información, solicitud de información o notificación por parte de La Aseguradora al igual que la póliza efectiva. Cualquier solicitud o instrucción que haga el corredor a MAPFRE PANAMÁ, S.A. con relación a esta póliza se entenderá que la hace en mi nombre y representación para todos los efectos legales. Así también, autorizo a cualquier médico, médico practicante, Hospital, Clínica, Institución Gubernamental o cualquier otro proveedor de servicios médicos, o asegurador o empleador y tenedores de la póliza de grupo que tengan datos o información sobre mi o mis dependientes con referencia a cualquier tratamiento , examen, dictamen, u hospitalización, a dar a MAPFRE PANAMÁ, S.A. o a sus representantes autorizado esta información, la cual debe incluir información sobre tratamiento psiquiátrico, tratamiento contra el uso de drogas narcóticas o de alcohol. También autorizo a cualquier organización o persona que tenga cualquier información importante, no médica, sobre mi o mis dependientes a dar información a MAPFRE PANAMÁ, S.A. o a sus representantes autorizados. Una fotocopia de esta autorización será tan válida como su original. 
Por este medio, quedo informado, consiento y autorizo a MAPFRE PANAMÁ, S.A. el tratamiento y almacenamiento de los datos de carácter personal que he suministrado voluntariamente, los recogidos a través de los formularios, tarificadores de seguro, correo electrónico, vía telefónica, mensaje de texto, la página web y los que se generen como consecuencia de la utilización de la misma, así como, las comunicaciones o las transferencias internacionales de datos que pudieran realizarse, incluyendo a terceros, así como el uso de comercio electrónico, con la finalidad de la gestión de la actividad aseguradora, relacionadas a la atención, mantenimiento, gestión integral, el cumplimiento de coberturas y/o del contrato, elaboración de perfiles, y control de calidad de mi relación con la aseguradora, respetando en todo caso la legislación aplicable sobre protección de datos de carácter personal, sin necesidad de que me sea comunicada cada primera comunicación que se efectúe.
Con mi firma en esta solicitud de seguro, y dando cumplimiento a lo establecido por la Ley 24 de 2002 y demás normativa aplicable, por este medio consentimos y autorizamos expresamente a que MAPFRE PANAMÁ, S.A. recopile datos que reflejen las transacciones económicas, mercantiles, financieras o crediticias (Historial de Crédito) que mantenga con dicha empresa; que dichos datos sean transmitidos o suministrados por MAPFRE PANAMÁ, S.A. a las agencias de información de datos autorizadas para operar de acuerdo con dicha Ley y que dichas agencias de información de datos suministren dichos datos a los agentes económicos a que se refiere la misma. De igual manera, consentimos y autorizamos expresamente a que MAPFRE PANAMÁ, S.A. tenga acceso a los datos que reflejen las transacciones económicas, mercantiles, financieras o bancarias (Historial de Crédito) que he mantenido en el pasado, mantengo en el presente o en el futuro con otros agentes económicos, existente en las bases de datos de las agencias de información de datos autorizadas para operar de acuerdo con dicha Ley o de cualquier otro agente económico como lo define la misma.
<br><br>
<b>CERTIFICACIÓN:</b>
Certifico que las respuestas y declaraciones en toda esta solicitud son verdaderas, están completas y no existe ninguna omisión de información, error, inexactitud o reticencia de mi parte y de ser así, y de emitirse la póliza, acepto las penalidades que se establezcan en esta materia, en la póliza, como, lo es la negación del reclamo y la cancelación de la póliza emitida sin perjuicios para La Aseguradora.
<br><br>

        </div>


        <!--
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="checkTerms">
            <label class="form-check-label" for="checkTerms">
            I certify that the answers and statements in this entire application are true, complete and there is no omission of information, error, inaccuracy or reticence on my part and if so, and if the policy is issued, I accept the penalties established in this matter, in the policy, such as, the denial of the claim and the cancellation of the policy issued without prejudice to The Insurer.
            </label>
        </div>
        -->

<br/>




<style>

.entry-title {
    display: none!important;
}

</style>

<script>
jQuery(document).ready(function() {
    // Add validation rules and messages for each field
    jQuery(".registration-form").validate({
        rules: {
            "sub-type": "required",
            "customer-type": "required",
            "user-name": "required",
            "user-surname": "required",
            "user-birthdate": "required",
            "user-passport": "required",
            "user-marital": "required",
            "user-email": "required",
            /*"user-cellular": {
                required: true,
                phoneUS: true // Validate phone number format
            },*/
            "email": {
                required: true,
                email: true // Validate email format
            },
            "occupation": "required",
            "nationality": "required",
            "residence": "required",
            "province": "required",
            "district": "required",
            "corregimento": "required",
            "neighborhood": "required",
            "street": "required",
            "house": "required",
            "ben1[name]": "required",
            "ben1[card]": "required",
            "ben1[percentage]": "required",
            /*"ben2[name]": "required",
            "ben2[card]": "required",
            "ben2[percentage]": "required",
            "ben3[name]": "required",
            "ben3[card]": "required",
            "ben3[percentage]": "required",*/
            "check-terms": "required"
        },
        messages: {
            // Add custom error messages if needed
        }
    });

    jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, ""); 
        return this.optional(element) || phone_number.match(/^\+?\d{8,}$/);
    }, "Please specify a valid phone number");


    // Hide validation for "Are you a politically exposed person?" field
    $("#pep").rules("remove");

    // Add or remove validation for "Relación/Cargo" field based on "pep" field value
    $("#pep").change(function() {
        if ($(this).val() === "yes") {
            $("#pep-position").rules("add", {
                required: true,
                messages: {
                    required: "Please enter your relationship/position"
                }
            });
        } else {
            $("#pep-position").rules("remove");
        }
    });

});
</script>

