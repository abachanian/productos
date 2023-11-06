<?php

//En caso de error puedo ejecutar esto para ver el error
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Conexión a la base de datos
$mysqli = new mysqli("localhost", "usuario", "cambiar", "sistema_productos");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Traigo los valores de los productos
$sql = "SELECT nombre, codigo, descripcion, precio FROM productos";

//cuento la cantidad de resultados obtenid🕉 

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result ->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["codigo"] . "</td>";
        echo "<td>" . $row["descripcion"] . "</td>";
        echo "<td>" . $row["precio"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No se encontraron usuarios registrados.</td></tr>";
}

// Cerrar el resultado
$result->close();

// Cerrar la conexión a la base de datos
$mysqli->close();
?>
