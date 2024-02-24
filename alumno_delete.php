<?php
// Verifica si se proporcionó el ID del alumno a eliminar
if (!isset($_GET["id"])) {
    exit("No se proporcionaron datos");
}

// Incluye el archivo de funciones para acceder a las funciones de base de datos
include_once "functions.php";

// Obtiene el ID del alumno a eliminar
$id = $_GET["id"];

// Elimina el alumno de la base de datos
deleteAlumno($id);

// Redirige a la página de alumnos después de eliminar el alumno
header("Location: alumnos.php");
?>
