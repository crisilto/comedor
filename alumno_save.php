<?php
header('Content-Type: application/json');

if (!isset($_POST["name"], $_POST["dni"], $_POST["curso"], $_POST["cuentaBancaria"], $_POST["posicionComedor"])) {
    echo json_encode(["success" => false, "message" => "No se proporcionaron todos los datos necesarios."]);
    exit;
}

include_once "functions.php";

$name = $_POST["name"];
$dni = $_POST["dni"];
$curso = $_POST["curso"];
$cuentaBancaria = $_POST["cuentaBancaria"];
$posicionComedor = $_POST["posicionComedor"];

$success = saveAlumno($name, $dni, $curso, $cuentaBancaria, $posicionComedor);

if ($success) {
    echo json_encode(["success" => true, "message" => "Alumno añadido con éxito."]);
} else {
    echo json_encode(["success" => false, "message" => "Error al añadir alumno."]);
}
exit;
