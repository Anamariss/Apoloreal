<?php
include "conexion.php";

// Obtener el nombre del archivo desde la URL
$id = $_GET['id'];

//buscar el archivo en la bd
$sql = "SELECT * FROM partitura WHERE id = '$id'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 1){
    $fila = mysqli_fetch_assoc($resultado);
    $archivo = $fila['documento'];
    $ruta_archivo = "partitura/" . $archivo;

    //Verificar que el archivo está en el servidor
    if (file_exists($ruta_archivo)) {
        //Enviar archivo al navegador
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' .$archivo . '"');
    } else {
        echo "El archivo no existe.";
    }
} else {
    echo "El archivo no se encontró en la base de datos";
}




?>