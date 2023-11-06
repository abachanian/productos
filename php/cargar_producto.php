<?php

//En caso de error puedo ejecutar esto para ver el error
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

// Conexión a la base de datos
$mysqli = new mysqli("localhost", "usuario", "cambiar", "sistema_productos");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Procesar los datos del formulario. Los mismos están marcados como "name" en el html. Ej: name='Producto'

//con strtoupper la paso todo a mayúscula, y con trim corto si hay espacios adelante o al final.
$nombre = isset($_POST['Producto']) ? trim(strtoupper($_POST['Producto'])) : '';
$id = isset($_POST['ID']) ? $_POST['ID'] : '';
$descripcion = $_POST['Descripcion'];
$precio = isset($_POST['Precio']) ? $_POST['Precio'] : '';
$imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : '';


//compruebo si los valores obligatorios están completos
if (empty($nombre) || empty($id) || empty($precio) || empty($imagen)) {
    echo "Por favor, complete todos los campos del formulario.";
} else {

    //acá saco la extensión del archivo.
    $extension = pathinfo($imagen, PATHINFO_EXTENSION);
    //aca le agrego el nombre de la imagen + marca de tiempo + extensión
    $nombre_unico = $nombre . "_" . uniqid() . "." . $extension;

    // Mover la imagen al directorio de destino
    $imagen_destino = "../imagenes/" . $nombre_unico;
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_destino)) {
        // Insertar los datos en la base de datos
        $query = "INSERT INTO productos (nombre, codigo, descripcion, precio, imagen) VALUES ('$nombre','$id','$descripcion','$precio', '$imagen_destino')";
        if ($mysqli->query($query) === TRUE) {
            echo "Producto guardado exitosamente.";
        } else {
            echo "Error al guardar el producto: " . $mysqli->error;
        }
    } else {
        echo "Error al guardar la imagen.";
    }
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>
