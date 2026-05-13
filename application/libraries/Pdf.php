<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
// Dompdf namespace use Dompdf\Dompdf;
class Pdf
{
    public function __construct()
    {

        require_once dirname(__FILE__) . '/dompdf/autoload.inc.php';
        $pdf = new Dompdf();
        $CI = &get_instance();
        $CI->dompdf = $pdf;
    }
}
