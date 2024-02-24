-- Obtener la asistencia de todos los alumnos ordenados por ID de alumno
SELECT a.Fecha, al.Nombre, al.CursoID, CASE WHEN a.Asiste = 1 THEN 'Asiste' ELSE 'No asiste' END AS Asistencia
FROM Asistencia a
INNER JOIN Alumnos al ON a.AlumnoID = al.ID
ORDER BY al.ID, a.Fecha;

-- Obtener alumnos con conteo de asistencia y ausencia en un rango de fechas
SELECT al.Nombre, 
c.NombreCurso,
SUM(CASE WHEN a.Asiste = 1 THEN 1 ELSE 0 END) AS ConteoAsistencia,
SUM(CASE WHEN a.Asiste = 0 THEN 1 ELSE 0 END) AS ConteoAusencia
FROM Asistencia a
INNER JOIN Alumnos al ON al.ID = a.AlumnoID
INNER JOIN Cursos c ON al.CursoID = c.ID
WHERE a.Fecha >= '2024-02-20' AND a.Fecha <= '2024-02-22'
GROUP BY al.ID, c.NombreCurso
ORDER BY c.NombreCurso, al.Nombre;