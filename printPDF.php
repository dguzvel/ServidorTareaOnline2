<?php

require __DIR__."/vendor/autoload.php";

use Spipu\Html2Pdf\Html2Pdf;

    ob_start();
    require_once "./ejercicios/ejercicio10/printView.php";
    $html = ob_get_clean();

    $html2pdf = new Html2Pdf("P", "A4", "es", "true", "UTF-8");
    $html2pdf->writeHTML($html);
    //$html2pdf->WriteHTML('<img src="./ejercicios/ejercicio09/fotos/1637439912-Filemon.jpg" width="100px"/>');
    $html2pdf->output("tabla.pdf");

    /* $html2pdf = new Html2Pdf("P", "A4", "es", "true", "UTF-8");
    $html2pdf->writeHTML("<h1>Hola Mundo desde html2pdf</h1> <h2>Más información</h2>");
    $html2pdf->output("pdf_generated.pdf"); */

?>