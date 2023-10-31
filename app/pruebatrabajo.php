<?php
 /*header("Content-Type: application/force-download");
 header("Content-Disposition: attachment; filename=\"$filename\"");
 $file = 'prueba.pdf';
 if (is_file($file)) {
   $filename = "cv0descargado.pdf"; // el nombre con el que se descargará, puede ser diferente al original
   /*header("Content-Type: application/octet-stream");*/
/*
   readfile($file);
 } else {
   die("Error: no se encontró el archivo '$file'");
 }*/
 require_once 'conexion.php';
if (isset($_POST["insertar"])) {
   

$insert = $conn->prepare('INSERT INTO partitura (comentario,documento) VALUES (?,?)');
$insert->bindParam(1, $_POST['comentario']);

$fp = fopen($_FILES['documento']['tmp_name'], 'r');
$fileContent = fread($fp, filesize($_FILES['documento']['tmp_name']));
$fileContent = addslashes($fileContent);

$insert->bindParam(2, $fileContent);


if ($insert->execute()) {
    echo "1 record added";
}else{
    echo "error";
}

}
?>

<form action="" method="POST" enctype="multipart/form-data">


<label for="comentario" class="form-label">Comentario</label>
<input type="text" name="comentario" required>
<label for="documento" class="form-label">Documento</label>
<input type="file" name="documento" required>
<br>
<button name="insertar" type="submit" style="margin: 10px;">Enviar</button>
<p>¡WELCOME!</p> 
</form>

