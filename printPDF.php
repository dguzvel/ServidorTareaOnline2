<?php

//Cargamos autoload.php, de todos las archivos que la librería descarga con composer, desde su ruta de directorio
require __DIR__."/vendor/autoload.php";

use Spipu\Html2Pdf\Html2Pdf;

    ob_start(); //Iniciamos un buffer que recoja el contenido del archivo printView.php
    require_once "./ejercicios/ejercicio10/printView.php";
    $html = ob_get_clean();//Limpiamos el buffer

    //Creamos un objeto Html2Pdf y seleccionamos que el papel sea A4 con codificación UTF-8 (permite tildes y ñ)
    $html2pdf = new Html2Pdf("P", "A4", "es", "true", "UTF-8");
    $html2pdf->writeHTML($html);//Mostramos por pantalla un pdf con el contenido de $html, es decir, printView.php
    //$html2pdf->WriteHTML('<img src="./ejercicios/ejercicio09/fotos/1637439912-Filemon.jpg" width="100px"/>');
    $html2pdf->output("tabla.pdf");//Con output podemos dar un nombre por defecto al archivo pdf que descarguemos

    /* $html2pdf = new Html2Pdf("P", "A4", "es", "true", "UTF-8");
    $html2pdf->writeHTML("<h1>Hola Mundo desde html2pdf</h1> <h2>Más información</h2>");
    $html2pdf->output("pdf_generated.pdf"); */

?>