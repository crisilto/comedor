<?php
if (!isset($_GET["date"])) {
    exit("[]");
}
include_once "functions.php";
$date = $_GET["date"];
$data = getAsistenciaDataByDate($date);
echo json_encode($data);
?>
