<?php

//namespace VuploadPhp;

include('api-google/vendor/autoload.php');


class loadDrive{  
   
    private $service;
    
    public function __construct(){  
        
        //Identificar las credenciales 
        putenv('GOOGLE_APPLICATION_CREDENTIALS=cargararchivos-373821-f18b3b877d9a.json');
              
        // Instancia de la clase Google client
        $cliente=new Google_Client();
        
        // Tipo de credenciales que estamos utilizando(Para no autorizar con usuario y contraseña )
        $cliente->useApplicationDefaultCredentials();
        
        // Direccion de autenticacion mediante el archivo json de credenciales 
        $cliente->SetScopes(['https://www.googleapis.com/auth/drive.file']);
        
        // Enviamos el objeto cliente que es con el cual nos autenticamos 
        $this->service=new Google_Service_Drive($cliente); 
        
    }
 
    public function uploadFile($file_path) {
            
      
           $file=new Google_Service_Drive_DriveFile();

           // El nombre con el cual se carga el archivo 
           $file->setName( $_FILES['archivos']['name']);
   
           //Reconoce el archivo de forma automatica 
           $finfo=finfo_open(FILEINFO_MIME_TYPE);

           // Obtiene la extension dela archivo
           $mime_type=finfo_file($finfo,$file_path);

            // Se indica el id de la carpeta
            $file->setParents(array("17uYj6zFZt_9d12I44fJvVqf5U8d7fc5A"));

            // Descripcion
            $file->setDescription("Archivo Cargado desde PHP");

           //La extensio del archivo que se carga 
           $file->setMimeType($mime_type);

            // Se envia el archivo 
            $resultado=$this->service->files->create(

                 $file,
                     array(

                     'data'=>file_get_contents($file_path),// Se CARGA EL ARCHIVO
                     'mimeType'=>$mime_type,// tipo de archivo
                      'uploadType' => 'multipart'// que tipo de carga
                     )
              );

       // id que me genera drive se la obtiene desde la variable $resultado
       echo '<a href="https://drive.google.com/open?id=' .$resultado->id . '" target="_blank">' .$resultado->name . '</a>';
 
        
    }                                       
     
    public function listar( $folderId){ 
        
        
        $query = "mimeType != 'application/vnd.google-apps.folder' and trashed = false and parents in '$folderId'";
        $resultado= $this->service->files->listFiles(array('q' => $query));

        //$resultado=$this->service->files->listFiles($folderId);
       
       

         foreach($resultado as $elemento){
        
            //Lista los elementos que tengo en la carpeta de google drive 
            //echo $elemento->id.' '.$elemento->name.'<br/>';// 
        
            $ruta='https://drive.google.com/open?id=' . $elemento->id;

            //echo $elemento->id ." " ."\n";

            $fileId=$elemento->id;
            $name=$elemento->name;
            echo '<a style="margin-left: 10px; margin-right: 10px;" href="'. $ruta . '" target="_blank">' . $elemento->name . '</a>'  ;
            echo "<a href='download.php?fileId=$fileId&nombre=$name'>Descargar</a>";
            echo "<a style='margin-left: 20px;' href='delete.php?fileId=$fileId'>Eliminar</a>. <br>";
   
        } 
         
                 
    
    }

    public function download($fileId,$name){
     
        $file = $this->service->files->get($fileId, array('alt' => 'media'));
        $content = $file->getBody()->getContents();
        
        // Obtener la ruta de descarga
        $downloads_folder = "C:\Users\mau\Documents\BENIBU\\";
        
        // Construir el nombre del archivo
        $file_path = $downloads_folder . $name;
        //echo $file_path; 
        file_put_contents($file_path, $content);
        
    }

    public function delete($fileId){

        $this->service->files->delete($fileId);
        echo "El arachivo ha sido borrado con éxito";

  }



}

?>