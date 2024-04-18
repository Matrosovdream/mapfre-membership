

jQuery(document).ready(function() {

    jQuery('#pep').change(function() {
    
        var val = jQuery(this).val();
        
        if( val == 'yes' ) {
            jQuery('.pep-block').show();
        } else {
            jQuery('.pep-block').hide();
        }
        
    });

});

