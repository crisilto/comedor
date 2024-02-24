<script src="js/attendance.js"></script>

<?php include_once "header.php"; ?>
<?php include_once "nav.php"; ?>

<div>
    <h1>Registro de Asistencia</h1>
    <div>
        <label for="date">Fecha:</label>
        <input onchange="refreshAlumnosList()" id="date" type="date">
        <button onclick="save()">Guardar</button>
    </div>
    <div>
        <table id="alumnos-table">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody id="alumnos-list">
            </tbody>
        </table>
    </div>
</div>

<script src="js/attendance.js"></script>
<?php include_once "footer.php"; ?>


<script>
    const UNSET_STATUS = "unset";

    document.addEventListener('DOMContentLoaded', function() {
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
                ID: row.dataset.id,
                status: row.querySelector('select').value
            };
        });

        const payload = {
            date: date,
            alumnos: alumnos.filter(alumno => alumno.status !== UNSET_STATUS)
        };

        try {
            const response = await fetch("./save_attendance_data.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            if (response.ok) {
                const jsonResponse = await response.json();
                if (jsonResponse.success) {
                    alert('Guardado con éxito');
                } else {
                    alert('Falló al guardar');
                }
            } else {
                throw new Error('No se recibió una respuesta OK del servidor');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al procesar la solicitud');
        }
    }

    async function refreshAlumnosList() {
        const date = document.getElementById('date').value;

        try {
            const alumnosResponse = await fetch("./get_alumnos_ajax.php");
            const alumnosData = await alumnosResponse.json();

            const asistenciaResponse = await fetch(`./get_attendance_data_ajax.php?date=${date}`);
            const asistenciaData = await asistenciaResponse.json();

            const alumnosList = document.getElementById('alumnos-list');
            alumnosList.innerHTML = '';

            alumnosData.forEach(alumno => {
                const asistencia = asistenciaData.find(item => item.AlumnoID === alumno.ID);
                const status = asistencia ? asistencia.Asiste.toString() : UNSET_STATUS;

                const row = document.createElement('tr');
                row.dataset.id = alumno.ID;
                row.innerHTML = `
                <td>${alumno.Nombre}</td> <!-- Asumiendo que el campo en la BD es Nombre -->
                <td>
                    <select>
                        <option disabled value="${UNSET_STATUS}">--Seleccionar--</option>
                        <option value="1" ${status === "1" ? "selected" : ""}>Presente</option>
                        <option value="0" ${status === "0" ? "selected" : ""}>Ausente</option>
                    </select>
                </td>`;
                alumnosList.appendChild(row);
            });
        } catch (error) {
            console.error('Error al obtener los datos:', error);
        }
    }
</script>


<?php
include_once "footer.php";
?>