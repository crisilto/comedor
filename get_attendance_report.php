<?php
header('Content-Type: application/json');
include_once "functions.php";

$startDate = $_GET['start'] ?? date('Y-m-d');
$endDate = $_GET['end'] ?? date('Y-m-d');

$results = getAlumnosWithAsistenciaCount($startDate, $endDate);

echo json_encode($results);