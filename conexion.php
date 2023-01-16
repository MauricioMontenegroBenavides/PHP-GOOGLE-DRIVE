<?php

// Incluir los archivos de la api
//include('api-google/vendor/autoload.php');

include('loadDrive.php');

//use VuploadPhp\loadDrive;
// Instanciamos la clase loadDrive
$driveHelper = new loadDrive();


if(isset($_FILES['archivos']['tmp_name'])){

    $driveHelper->uploadFile($_FILES['archivos']['tmp_name']);
}
 

//echo $_POST['listar'];

if(isset($_GET['listar'])){

    $folderId="17uYj6zFZt_9d12I44fJvVqf5U8d7fc5A";

    
    $driveHelper->listar( $folderId);
} 

?>