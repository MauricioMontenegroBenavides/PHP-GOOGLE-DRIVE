
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="">

<form action="conexion.php" method="POST" enctype="multipart/form-data">

     <h1>
          Subir Archivos a Google Drive
     </h1>
     <input type="file" name="archivos">
     <div style="margin-top:10px"> <button type="submit">Enviar</button></div>
    

</form>

<form action="conexion.php" method="GET" enctype="multipart/form-data">

  
     <div style="margin-top:10px"> <button  name="listar">listar</button></div>

</form>



    


</body>
</html>

<?php


?>