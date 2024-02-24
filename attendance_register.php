<script src="js/attendance.js"></script>

<?php
include_once "header.php";
include_once "nav.php";
?>
<div class="row">
    <div class="col-12">
        <h1 class="text-center">Registro de Asistencia</h1>
    </div>
    <div class="col-12">
        <div class="form-inline mb-2">
            <label for="date">Fecha: &nbsp;</label>
            <input onchange="refreshAlumnosList()" id="date" type="date" class="form-control">
            <button onclick="save()" class="btn btn-success ml-2">Guardar</button>
        </div>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table id="alumnos-table" class="table">
                <thead>
                    <tr>
                        <th>Alumno</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="alumnos-list">
                    <!-- Aquí se generará la lista de alumnos -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const UNSET_STATUS = "unset";

    document.addEventListener('DOMContentLoaded', function() {
        // Al cargar la página, se establece la fecha actual
        const todayDate = getTodaysDate();
        document.getElementById('date').value = todayDate;
        refreshAlumnosList();
    });

    function getTodaysDate() {
        const date = new Date();
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        return `${date.getFullYear()}-${month}-${day}`;
    }

    async function save() {
        const date = document.getElementById('date').value;
        const alumnos = Array.from(document.querySelectorAll('#alumnos-table tbody tr')).map(row => {
            return {
                id: row.dataset.id,
                status: row.querySelector('select').value
            };
        });

        const payload = {
            date: date,
            alumnos: alumnos.filter(alumno => alumno.status !== UNSET_STATUS)
        };

        const response = await fetch("./save_asistencia_data.php", {
            method: "POST",
            body: JSON.stringify(payload)
        });

        if (response.ok) {
            alert('Saved');
        } else {
            alert('Failed to save data');
        }
    }

    async function refreshAlumnosList() {
        const date = document.getElementById('date').value;
        const alumnosResponse = await fetch("./get_alumnos_ajax.php");
        const alumnosData = await alumnosResponse.json();

        const asistenciaResponse = await fetch(`./get_asistencia_data_ajax.php?date=${date}`);
        const asistenciaData = await asistenciaResponse.json();

        const alumnosList = document.getElementById('alumnos-list');
        alumnosList.innerHTML = ''; // Limpiar la lista de alumnos antes de actualizar

        const alumnoDictionary = {};
        alumnosData.forEach(alumno => {
            alumnoDictionary[alumno.id] = alumno;
        });

        alumnosData.forEach(alumno => {
            const asistencia = asistenciaData.find(item => item.alumno_id === alumno.id);
            const status = asistencia ? asistencia.asiste.toString() : UNSET_STATUS;
            
            const row = document.createElement('tr');
            row.dataset.id = alumno.id;
            row.innerHTML = `
                <td>${alumno.name}</td>
                <td>
                    <select class="form-control">
                        <option disabled value="unset">--Seleccionar--</option>
                        <option value="1" ${status === "1" ? "selected" : ""}>Presente</option>
                        <option value="0" ${status === "0" ? "selected" : ""}>Ausente</option>
                    </select>
                </td>`;
            alumnosList.appendChild(row);
        });
    }
</script>

<?php
include_once "footer.php";
?>
