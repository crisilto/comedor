<?php
include_once "header.php";
include_once "nav.php";
include_once "functions.php";
$alumnos = getAlumnos();
?>
<div class="row">
    <div class="col-12">
        <h1 class="text-center">Alumnos</h1>
    </div>
    <div class="col-12">
        <a href="alumno_add.php" class="btn btn-info mb-2">Añadir nuevo alumno <i class="fa fa-plus"></i></a>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table class="table" id="alumnos-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>CursoID</th>
                        <th>Cuenta Bancaria</th>
                        <th>Posición Comedor</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $alumno) { ?>
                        <tr data-id="<?php echo $alumno->id; ?>">
                            <td><?php echo $alumno->id; ?></td>
                            <td><?php echo $alumno->name; ?></td>
                            <td><?php echo $alumno->dni; ?></td>
                            <td><?php echo $alumno->curso; ?></td>
                            <td><?php echo $alumno->cuentaBancaria; ?></td>
                            <td><?php echo $alumno->posicionComedor; ?></td>
                            <td>
                                <button class="btn btn-warning edit-btn">
                                    Editar <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger delete-btn">
                                    Eliminar <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once "footer.php";
?>
<script>
    // Script para manejar la edición y eliminación de alumnos
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.getElementById('alumnos-table');
        table.addEventListener('click', function(event) {
            const target = event.target;
            const row = target.closest('tr');
            const id = row.getAttribute('data-id');
            if (target.classList.contains('edit-btn')) {
                // Redirigir a la página de edición del alumno con el ID correspondiente
                window.location.href = `alumno_edit.php?id=${id}`;
            } else if (target.classList.contains('delete-btn')) {
                // Confirmar la eliminación del alumno
                if (confirm('¿Estás seguro de querer eliminar este alumno?')) {
                    // Realizar una solicitud AJAX para eliminar el alumno
                    fetch(`alumno_delete.php?id=${id}`, {
                        method: 'GET'
                    }).then(response => {
                        // Actualizar la tabla de alumnos después de eliminar
                        row.remove();
                    }).catch(error => {
                        console.error('Error al eliminar el alumno:', error);
                    });
                }
            }
        });
    });
</script>
