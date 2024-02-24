<?php
include_once 'config.php';

function getDatabase() {
    //Usamos las constantes definidas en config.php
    $user = MYSQL_USER;
    $password = MYSQL_PASSWORD;
    $dbName = MYSQL_DATABASE_NAME;
    
    //Creamos una nueva conexión PDO
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}

function getAlumnos() {
    $db = getDatabase();
    $statement = $db->query("SELECT ID, Nombre, DNI, CursoID, CuentaBancaria, PosicionComedor FROM alumnos");
    return $statement->fetchAll();
}

function getAlumnoById($id) {
    $db = getDatabase();
    $statement = $db->prepare("SELECT ID, Nombre, DNI, CursoID, CuentaBancaria, PosicionComedor FROM alumnos WHERE ID = ?");
    $statement->execute([$id]);
    return $statement->fetchObject();
}

function saveAlumno($nombre, $dni, $cursoID, $cuentaBancaria, $posicionComedor) {
    $db = getDatabase();
    $statement = $db->prepare("INSERT INTO alumnos (Nombre, DNI, CursoID, CuentaBancaria, PosicionComedor) VALUES (?, ?, ?, ?, ?)");
    return $statement->execute([$nombre, $dni, $cursoID, $cuentaBancaria, $posicionComedor]);
}

function updateAlumno($name, $dni, $cursoID, $cuentaBancaria, $posicionComedor, $id) {
    $db = getDatabase();
    $statement = $db->prepare("UPDATE alumnos SET Nombre = ?, DNI = ?, CursoID = ?, CuentaBancaria = ?, PosicionComedor = ? WHERE ID = ?");
    return $statement->execute([$name, $dni, $cursoID, $cuentaBancaria, $posicionComedor, $id]);
}

function deleteAlumno($id) {
    $db = getDatabase();
    
    //Primero, eliminamos todos los registros de asistencia del alumno
    $stmt = $db->prepare("DELETE FROM asistencia WHERE AlumnoID = ?");
    $stmt->execute([$id]);
    
    //Luego, eliminamos al alumno
    $stmt = $db->prepare("DELETE FROM alumnos WHERE ID = ?");
    return $stmt->execute([$id]);
}


function getAlumnosWithAsistenciaCount($start, $end) {
    $db = getDatabase();
    $query = "SELECT al.Nombre, 
    sum(CASE WHEN a.Asiste = 1 THEN 1 ELSE 0 END) as presence_count,
    sum(CASE WHEN a.Asiste = 0 THEN 1 ELSE 0 END) as absence_count 
    FROM asistencia a
    INNER JOIN alumnos al ON al.ID = a.AlumnoID
    WHERE a.Fecha >= ? AND a.Fecha <= ?
    GROUP BY AlumnoID;";
    $statement = $db->prepare($query);
    $statement->execute([$start, $end]);
    return $statement->fetchAll();
}

function saveAsistenciaData($date, $alumnos) {
    $db = getDatabase();
    deleteAsistenciaDataByDate($date);
    $statement = $db->prepare("INSERT INTO asistencia(AlumnoID, Fecha, Asiste) VALUES (?, ?, ?)");
    $db->beginTransaction();
    try {
        foreach ($alumnos as $alumno) {
            $statement->execute([$alumno['ID'], $date, $alumno['status'] ? 1 : 0]);
        }
        $db->commit();
        return true;
    } catch (Exception $e) {
        //Si algo sale mal, hacemos rollback y lanzamos la excepción
        $db->rollback();
        throw $e;
    }
}

function deleteAsistenciaDataByDate($date) {
    $db = getDatabase();
    $statement = $db->prepare("DELETE FROM asistencia WHERE Fecha = ?");
    return $statement->execute([$date]);
}

function getAsistenciaDataByDate($date) {
    $db = getDatabase();
    $statement = $db->prepare("SELECT AlumnoID, Asiste FROM asistencia WHERE Fecha = ?");
    $statement->execute([$date]);
    return $statement->fetchAll();
}
?>
