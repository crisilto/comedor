<?php
if (!isset($_POST["name"], $_POST["id"], $_POST["dni"], $_POST["curso"], $_POST["cuentaBancaria"], $_POST["posicionComedor"])) {
    exit("No se proporcionaron todos los datos necesarios.");
}

include_once "functions.php";

$id = $_POST["id"];
$name = $_POST["name"];
$dni = $_POST["dni"];
$curso = $_POST["curso"];
$cuentaBancaria = $_POST["cuentaBancaria"];
$posicionComedor = $_POST["posicionComedor"];

updateAlumno($name, $dni, $curso, $cuentaBancaria, $posicionComedor, $id);

header("Location: alumnos.php");
