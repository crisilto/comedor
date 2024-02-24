-- Creación de la tabla Cursos
CREATE TABLE IF NOT EXISTS Cursos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NombreCurso VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Creación de la tabla Alumnos
CREATE TABLE IF NOT EXISTS Alumnos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    DNI VARCHAR(10) UNIQUE NOT NULL,
    CursoID INT,
    CuentaBancaria VARCHAR(24),
    PosicionComedor VARCHAR(255),
    FOREIGN KEY (CursoID) REFERENCES Cursos(ID) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Creación de la tabla Asistencia
CREATE TABLE IF NOT EXISTS Asistencia (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    AlumnoID INT,
    Fecha DATE NOT NULL,
    Asiste BOOLEAN NOT NULL,
    FOREIGN KEY (AlumnoID) REFERENCES Alumnos(ID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Insertar cursos de ejemplo
INSERT INTO Cursos (NombreCurso) VALUES
('3INF'),
('4INF'),
('5INF');

-- Insertar alumnos de ejemplo
INSERT INTO Alumnos (Nombre, DNI, CursoID, CuentaBancaria, PosicionComedor) VALUES
('Juan Perez', '12345678A', 1, 'ES9901234567891234567891', 'Mesa1'),
('Ana Lopez', '23456789B', 1, 'ES9901234567891234567892', 'Mesa2'),
('Carlos García', '34567890C', 2, 'ES9901234567891234567893', 'Mesa1'),
('Lucía Martín', '45678901D', 2, 'ES9901234567891234567894', 'Mesa2'),
('Marta Sánchez', '56789012E', 3, 'ES9901234567891234567895', 'Mesa1');

-- Insertar datos de asistencia de ejemplo
INSERT INTO Asistencia (AlumnoID, Fecha, Asiste) VALUES
(1, '2024-02-20', 1),
(2, '2024-02-20', 0),
(3, '2024-02-20', 1),
(4, '2024-02-21', 1),
(5, '2024-02-21', 1),
(1, '2024-02-21', 0),
(2, '2024-02-22', 1),
(3, '2024-02-22', 0),
(4, '2024-02-22', 1),
(5, '2024-02-22', 1);