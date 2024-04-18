<?php
class Membership_reports {

    public $content;
    public $format;
    private $lib;

    public function __construct( $content, $format="csv" ) {

        $this->content = $content;
        $this->format = $format;

        if( $this->format == 'csv' ) {
            $this->lib = new Reports_CSV( $this->content );
        }

    }

    public function get_file() {

        $this->lib->process();

    }

}