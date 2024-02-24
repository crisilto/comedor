<?php
include_once "header.php";
include_once "nav.php";
?>

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Añadir alumno</h1>
    </div>
    <div class="col-12">
        <!-- Añadido ID al formulario para poder seleccionarlo fácilmente con JavaScript -->
        <form id="formAddAlumno" action="alumno_save.php" method="POST">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input name="name" placeholder="Nombre" type="text" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="dni">DNI</label>
                <input name="dni" placeholder="DNI" type="text" id="dni" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="curso">Curso</label>
                <select name="curso" id="curso" class="form-control" required>
                    <option value="3INF">3INF</option>
                    <option value="4INF">4INF</option>
                    <option value="5INF">5INF</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cuentaBancaria">Cuenta Bancaria</label>
                <input name="cuentaBancaria" placeholder="Cuenta Bancaria" type="text" id="cuentaBancaria" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="posicionComedor">Posición en el Comedor</label>
                <input name="posicionComedor" placeholder="Posición en el Comedor" type="text" id="posicionComedor" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    Guardar <i class="fa fa-check"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<?php
include_once "footer.php";
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById('formAddAlumno');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(form);

        fetch('alumno_save.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if(data.success) {
                alert('Alumno añadido con éxito');
                form.reset();
                // window.location.href = 'alumnos.php'; // Opcional: Redirigir
            } else {
                alert('Error al añadir alumno');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al procesar la solicitud');
        });
    });
});
</script>
