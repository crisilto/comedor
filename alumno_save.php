<?php
// Verifica que se hayan proporcionado todos los datos necesarios
if (!isset($_POST["name"], $_POST["dni"], $_POST["curso"], $_POST["cuentaBancaria"], $_POST["posicionComedor"])) {
    exit("No se proporcionaron todos los datos necesarios.");
}

// Incluye el archivo de funciones para acceder a las funciones de base de datos
include_once "functions.php";

// Obtiene los datos del formulario
$name = $_POST["name"];
$dni = $_POST["dni"];
$curso = $_POST["curso"]; // Asegúrate de que este valor coincida con cómo está almacenado en la base de datos.
$cuentaBancaria = $_POST["cuentaBancaria"];
$posicionComedor = $_POST["posicionComedor"];

// Guarda el alumno en la base de datos
saveAlumno($name, $dni, $curso, $cuentaBancaria, $posicionComedor);

// Redirige a la página de alumnos después de guardar el alumno
header("Location: alumnos.php");
?>
