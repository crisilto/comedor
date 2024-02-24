<?php
// Verifica si se proporcionaron todos los datos necesarios
if (!isset($_POST["name"], $_POST["id"], $_POST["dni"], $_POST["curso"], $_POST["cuentaBancaria"], $_POST["posicionComedor"])) {
    exit("No se proporcionaron todos los datos necesarios.");
}

// Incluye el archivo de funciones para acceder a las funciones de base de datos
include_once "functions.php";

// Obtiene los datos del formulario
$id = $_POST["id"];
$name = $_POST["name"];
$dni = $_POST["dni"];
$curso = $_POST["curso"]; // Asegúrate de que este valor coincida con cómo está almacenado en tu base de datos.
$cuentaBancaria = $_POST["cuentaBancaria"];
$posicionComedor = $_POST["posicionComedor"];

// Actualiza los datos del alumno en la base de datos
updateAlumno($name, $dni, $curso, $cuentaBancaria, $posicionComedor, $id);

// Redirige a la página de alumnos después de actualizar los datos
header("Location: alumnos.php");
?>
