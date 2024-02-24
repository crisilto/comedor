<?php
include_once "header.php";
include_once "nav.php";
include_once "functions.php";
$alumnos = getAlumnos();
?>

<div>
    <h1>Alumnos</h1>
    <a href="alumno_add.php">Añadir nuevo alumno</a>
    <table>
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
                <tr>
                    <td><?php echo $alumno->ID; ?></td>
                    <td><?php echo $alumno->Nombre; ?></td>
                    <td><?php echo $alumno->DNI; ?></td>
                    <td><?php echo $alumno->CursoID; ?></td>
                    <td><?php echo $alumno->CuentaBancaria; ?></td>
                    <td><?php echo $alumno->PosicionComedor; ?></td>
                    <td><a href="alumno_edit.php?id=<?php echo $alumno->ID; ?>">Editar</a></td>
                    <td><a href="alumno_delete.php?id=<?php echo $alumno->ID; ?>" onclick="return confirm('¿Está seguro de querer eliminar este alumno?');">Eliminar</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include_once "footer.php"; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.getElementById('alumnos-table');
        table.addEventListener('click', function(event) {
            const target = event.target;
            const row = target.closest('tr');
            const id = row.getAttribute('data-id');
            if (target.classList.contains('edit-btn')) {
                window.location.href = `alumno_edit.php?id=${id}`;
            } else if (target.classList.contains('delete-btn')) {
                if (confirm('¿Estás seguro de querer eliminar este alumno?')) {
                    fetch(`alumno_delete.php?id=${id}`, {
                        method: 'GET'
                    }).then(response => {
                        row.remove();
                    }).catch(error => {
                        console.error('Error al eliminar el alumno:', error);
                    });
                }
            }
        });
    });
</script>