<?php
if (!isset($_GET["id"])) {
    exit("No se proporcionaron datos");
}
include_once "functions.php";
$id = $_GET["id"];
deleteAlumno($id);
header("Location: alumnos.php");
