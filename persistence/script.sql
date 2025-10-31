CREATE DATABASE IF NOT EXISTS futpersistencia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE futpersistencia;

CREATE TABLE equipos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    estadio VARCHAR(100) NOT NULL
);

CREATE TABLE partidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipo_local INT NOT NULL,
    equipo_visitante INT NOT NULL,
    resultado ENUM('1', 'X', '2') NOT NULL,
    jornada INT NOT NULL,
    estadio VARCHAR(100) NOT NULL,
    FOREIGN KEY (equipo_local) REFERENCES equipos(id) ON DELETE CASCADE,
    FOREIGN KEY (equipo_visitante) REFERENCES equipos(id) ON DELETE CASCADE,
    CONSTRAINT no_repetido UNIQUE (equipo_local, equipo_visitante)
);
