<script src="js/attendance.js"></script>

<?php
include_once "header.php";
include_once "nav.php";
?>
<div class="row">
    <div class="col-12">
        <h1 class="text-center">Reporte de Asistencia</h1>
    </div>
    <div class="col-12">

        <form id="attendanceForm" class="form-inline mb-2">
            <label for="start">Inicio:&nbsp;</label>
            <input required id="start" type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control mr-2">
            <label for="end">Fin:&nbsp;</label>
            <input required id="end" type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
            <button type="submit" class="btn btn-success ml-2">Filtrar</button>
        </form>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table id="attendanceTable" class="table">
                <thead>
                    <tr>
                        <th>Alumno</th>
                        <th>Conteo de Asistencia</th>
                        <th>Conteo de Ausencias</th>
                    </tr>
                </thead>
                <tbody id="attendanceBody">
                    <!-- Aquí se generará el cuerpo de la tabla -->
                </tbody>
            </table>
        </div>
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

        const response = await fetch(`./get_attendance_report.php?start=${start}&end=${end}`);
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
    }
</script>

<?php
include_once "footer.php";
?>
