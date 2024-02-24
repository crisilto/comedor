<?php
include_once "header.php";
include_once "nav.php";
include_once "functions.php";
?>
<div>
    <h1>Reporte de Asistencia</h1>
    <div>
        <form id="attendanceForm">
            <label for="start">Inicio:</label>
            <input required id="start" type="date" value="<?php echo date('Y-m-d'); ?>">
            <label for="end">Fin:</label>
            <input required id="end" type="date" value="<?php echo date('Y-m-d'); ?>">
            <button type="submit">Filtrar</button>
        </form>
    </div>
    <div>
        <table id="attendanceTable">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Conteo de Asistencia</th>
                    <th>Conteo de Ausencias</th>
                </tr>
            </thead>
            <tbody id="attendanceBody">
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const attendanceForm = document.getElementById('attendanceForm');
        attendanceForm.addEventListener('submit', function(event) {
            event.preventDefault();
            updateAttendanceReport();
        });
        updateAttendanceReport();
    });

    async function updateAttendanceReport() {
        const start = document.getElementById('start').value;
        const end = document.getElementById('end').value;

        try {
            const response = await fetch(`./get_attendance_report.php?start=${start}&end=${end}`);
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            const data = await response.json();

            const attendanceBody = document.getElementById('attendanceBody');
            attendanceBody.innerHTML = ''; 

            data.forEach(alumno => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${alumno.Nombre}</td>
                    <td>${alumno.presence_count}</td>
                    <td>${alumno.absence_count}</td>
                `;
                attendanceBody.appendChild(row);
            });
        } catch (error) {
            console.error('Error al obtener el reporte de asistencia:', error);
        }
    }
</script>

<?php
include_once "footer.php";
?>
