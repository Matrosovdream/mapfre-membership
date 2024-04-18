<?php
class Reports_CSV {

    public $content;

    public function __construct( $content ) {

        $this->content = $content;

    }

    public function process() {

        $filename = "data_export_" . date('Y-m-d') . ".csv";

        $content = $this->content;

        $output = fopen("php://output",'w') or die("Can't open php://output");
        header("Content-Type:application/csv"); 
        header("Content-Disposition:attachment; filename={$filename}"); 

        // Headers
        $headers = array_keys(reset($content));
        fputcsv($output, $headers, ';');

        // Body
        foreach($content as $product) {
            fputcsv($output, $product, ';');
        }
        fclose($output) or die("Can't close php://output");

        exit();

        echo "<pre>";
        print_r( $content );
        echo "</pre>";
        die();

    } 

}