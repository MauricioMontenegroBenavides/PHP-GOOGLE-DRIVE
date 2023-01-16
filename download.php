<?php


include('loadDrive.php');
$fileId = $_GET['fileId'];
$name = $_GET['nombre'];

//use VuploadPhp\loadDrive;
// Instanciamos la clase loadDrive
$driveHelper = new loadDrive();
$driveHelper->download($fileId,$name);

?>