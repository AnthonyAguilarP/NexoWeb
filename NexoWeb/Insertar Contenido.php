<?php
session_start(); // Inicia la sesión

// Accede al ID del usuario desde la variable de sesión
$id_usuario = $_SESSION['id_usuario'];
include("User.php");
// Conexión a la base de datos
$miconexion = mysqli_connect("localhost", "root", "", "nexoweb");
if (!$miconexion) {
    echo "La conexión falló";
    exit();
}

$nombre_diseno = $_POST["campo_titulo"];
$descripcion_diseno = $_POST["area_comentarios"];
$nombre_imagen = $_FILES["imagen"]["name"];
$tamaño_imagen = $_FILES["imagen"]["size"];
$nombre_archivo = $_FILES["archivo"]["name"];
$tamaño_archivo = $_FILES["archivo"]["size"];

// Verificar el tamaño de la imagen
if ($tamaño_imagen > (2 * 1024 * 1024)) { // 2 MB en bytes
    echo "El tamaño de la imagen excede el límite permitido (2 MB).";
    exit();
}

// Verificar el tamaño del archivo
if ($tamaño_archivo > (25 * 1024 * 1024)) { // 25 MB en bytes
    echo "El tamaño del archivo excede el límite permitido (25 MB).";
    exit();
}

// Directorio de destino para las imágenes y archivos
$destino_ruta_imagen = "imagenes/";
$destino_ruta_archivo = "archivos/";

// Mover la imagen a su destino
$imagen_destino = $destino_ruta_imagen . $nombre_imagen;
if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagen_destino)) {
    echo "La imagen se ha subido correctamente.<br>";
} else {
    echo "No se pudo subir la imagen.<br>";
}

// Mover el archivo a su destino
$archivo_destino = $destino_ruta_archivo . $nombre_archivo;
if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo_destino)) {
    echo "El archivo se ha subido correctamente.<br>";
} else {
    echo "No se pudo subir el archivo.<br>";
}

$fecha_publicacion = date("Y-m-d H:i:s");

// Consulta SQL para insertar los datos en la base de datos
$miconsulta = "INSERT INTO diseno (IdUsuario, NombreDiseno, FechaPublicacion, DescripcionDiseno, NombreImagen, NombreArchivo)
VALUES ('" . $id_usuario . "','" . $nombre_diseno . "','" . $fecha_publicacion . "','" . $descripcion_diseno . "','" . generarCaracteresAlAzar() . $nombre_imagen . "','" . generarCaracteresAlAzar() . $nombre_archivo . "')";

$resultado = mysqli_query($miconexion, $miconsulta);
mysqli_close($miconexion);

echo "<br/>Se ha agregado con éxito<br/><br/>";
?>
