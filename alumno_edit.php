<?php
// Verifica si se proporcionó el ID del alumno a editar
if (!isset($_GET["id"])) {
    exit("No se proporcionó el ID del alumno");
}

// Incluye el archivo de funciones para acceder a las funciones de base de datos
include_once "functions.php";

// Obtiene el ID del alumno a editar
$id = $_GET["id"];

// Obtiene los datos del alumno a partir de su ID
$alumno = getAlumnoById($id);

// Incluye el encabezado y la navegación
include_once "header.php";
include_once "nav.php";
?>

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Editar alumno</h1>
    </div>
    <div class="col-12">
        <form action="alumno_update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $alumno->ID; ?>">

            <div class="form-group">
                <label for="name">Nombre</label>
                <input value="<?php echo $alumno->Nombre; ?>" name="name" placeholder="Nombre" type="text" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="dni">DNI</label>
                <input value="<?php echo $alumno->DNI; ?>" name="dni" placeholder="DNI" type="text" id="dni" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="curso">Curso</label>
                <select name="curso" id="curso" class="form-control" required>
                    <option value="3INF" <?php echo $alumno->CursoID == '3INF' ? 'selected' : ''; ?>>3INF</option>
                    <option value="4INF" <?php echo $alumno->CursoID == '4INF' ? 'selected' : ''; ?>>4INF</option>
                    <option value="5INF" <?php echo $alumno->CursoID == '5INF' ? 'selected' : ''; ?>>5INF</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cuentaBancaria">Cuenta Bancaria</label>
                <input value="<?php echo $alumno->CuentaBancaria; ?>" name="cuentaBancaria" placeholder="Cuenta Bancaria" type="text" id="cuentaBancaria" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="posicionComedor">Posición en el Comedor</label>
                <input value="<?php echo $alumno->PosicionComedor; ?>" name="posicionComedor" placeholder="Posición en el Comedor" type="text" id="posicionComedor" class="form-control" required>
            </div>

            <div class="form-group">
                <button class="btn btn-success">
                    Guardar <i class="fa fa-check"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<?php
// Incluye el pie de página
include_once "footer.php";
?>
