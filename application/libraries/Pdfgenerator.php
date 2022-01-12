<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once("./application/third_party/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

/**
 * Description of PdfGenerator
 *
 */
class Pdfgenerator {
    
    public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait"){
        $dompdf = new DOMPDF();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $dompdf->set_option("isPhpEnabled", true);
        if ($stream) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }
}
