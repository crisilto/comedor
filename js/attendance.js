function getAlumnos() {
    return fetch('get_alumnos_ajax.php')
        .then(response => response.json())
        .catch(error => console.error('Error fetching alumnos:', error));
}

function getAttendanceDataByDate(date) {
    return fetch(`get_attendance_data_ajax.php?date=${date}`)
        .then(response => response.json())
        .catch(error => console.error('Error fetching attendance data:', error));
}

function saveAttendanceData(payload) {
    return fetch('./save_attendance_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .catch(error => console.error('Error saving attendance data:', error));
}
