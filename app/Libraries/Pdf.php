<?php 
namespace App\Libraries;

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

class Pdf
{
    function createPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='landscape')
    {
        $dompdf = new \Dompdf\DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        if($download)
          $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
           $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }


    function createSalePointPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='landscape')
    {
        $dompdf = new \Dompdf\DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();

        file_put_contents(WRITEPATH . '/uploads/sale_point/sale_point.pdf', $dompdf->output());
    }
    

    function createPDF2($html, $filename='', $download=TRUE, $paper='A4', $orientation='portrait')
    {
        $dompdf = new \Dompdf\DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }
}
?>