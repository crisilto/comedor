<?php
include_once "header.php";
include_once "nav.php";
?>

<div>
    <h1>Añadir alumno</h1>
</div>
<div>
    <form id="formAddAlumno" action="alumno_save.php" method="POST">
        <div>
            <label for="name">Nombre</label>
            <input name="name" placeholder="Nombre" type="text" id="name" required>
        </div>
        <div>
            <label for="dni">DNI</label>
            <input name="dni" placeholder="DNI" type="text" id="dni" required>
        </div>
        <div>
            <label for="curso">Curso</label>
            <select name="curso" id="curso" required>
                <option value="3INF">3INF</option>
                <option value="4INF">4INF</option>
                <option value="5INF">5INF</option>
            </select>
        </div>
        <div>
            <label for="cuentaBancaria">Cuenta Bancaria</label>
            <input name="cuentaBancaria" placeholder="Cuenta Bancaria" type="text" id="cuentaBancaria" required>
        </div>
        <div>
            <label for="posicionComedor">Posición en el Comedor</label>
            <input name="posicionComedor" placeholder="Posición en el Comedor" type="text" id="posicionComedor" required>
        </div>
        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
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
