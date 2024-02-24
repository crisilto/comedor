<?php
if (!isset($_GET["id"])) {
    exit("No se proporcionó el ID del alumno");
}

include_once "functions.php";

$id = $_GET["id"];
$alumno = getAlumnoById($id);

include_once "header.php";
include_once "nav.php";
?>

<div>
    <h1>Editar alumno</h1>
</div>
<div>
    <form action="alumno_update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $alumno->ID; ?>">

        <div>
            <label for="name">Nombre</label>
            <input value="<?php echo $alumno->Nombre; ?>" name="name" placeholder="Nombre" type="text" id="name" required>
        </div>

        <div>
            <label for="dni">DNI</label>
            <input value="<?php echo $alumno->DNI; ?>" name="dni" placeholder="DNI" type="text" id="dni" required>
        </div>

        <div>
            <label for="curso">Curso</label>
            <select name="curso" id="curso" required>
                <option value="3INF" <?php echo $alumno->CursoID == '3INF' ? 'selected' : ''; ?>>3INF</option>
                <option value="4INF" <?php echo $alumno->CursoID == '4INF' ? 'selected' : ''; ?>>4INF</option>
                <option value="5INF" <?php echo $alumno->CursoID == '5INF' ? 'selected' : ''; ?>>5INF</option>
            </select>
        </div>

        <div>
            <label for="cuentaBancaria">Cuenta Bancaria</label>
            <input value="<?php echo $alumno->CuentaBancaria; ?>" name="cuentaBancaria" placeholder="Cuenta Bancaria" type="text" id="cuentaBancaria" required>
        </div>

        <div>
            <label for="posicionComedor">Posición en el Comedor</label>
            <input value="<?php echo $alumno->PosicionComedor; ?>" name="posicionComedor" placeholder="Posición en el Comedor" type="text" id="posicionComedor" required>
        </div>

        <div>
            <button>Guardar</button>
        </div>
    </form>
</div>

<?php
include_once "footer.php";
