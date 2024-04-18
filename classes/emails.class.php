<?php
class Membership_emails {

    public function send_email( $template, $fields ) {

        $this->apply_filters();

        $html = $this->process_template( $template, $fields['meta'] );
        
        wp_mail( $fields['email_to'], $fields['title'], $html, $fields['headers'], $fields['attachments']);

        // Don't break other functions
        $this->remove_filters();
        
    }

    private function process_template( $template, $meta ) {

        $html = file_get_contents( MEMBERSHIP_PLUGIN_DIR_ABS."/templates/emails/{$template}.php" );

        // Replace variables
        foreach( $meta as $key=>$value ) {
            $html = str_replace( "{".$key."}", $value, $html );
        }

        return $html;

    }

    private function apply_filters() {

        add_filter( 'wp_mail_content_type', function( $content_type ){
            return "text/html";
        } );

    }

    private function remove_filters() {}

}