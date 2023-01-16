<?php

include('loadDrive.php');
$fileId = $_GET['fileId'];

//use VuploadPhp\loadDrive;
// Instanciamos la clase loadDrive
$driveHelper = new loadDrive();
$driveHelper->delete($fileId);


?>