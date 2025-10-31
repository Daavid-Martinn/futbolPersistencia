-- Crear base de datos
CREATE DATABASE IF NOT EXISTS futbol CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE futbol;

-- Tabla equipos
CREATE TABLE IF NOT EXISTS equipos (
    id INT(10) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    estadio VARCHAR(50),
    PRIMARY KEY (id)
);

-- Tabla partidos
CREATE TABLE IF NOT EXISTS partidos (
    id INT(10) NOT NULL AUTO_INCREMENT,
    equipo_local_id INT(11) NOT NULL,
    equipo_visitante_id INT(11) NOT NULL,
    jornada INT(11) DEFAULT NULL,
    resultado INT(11) DEFAULT NULL,
    estadio_id INT(11) NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    CONSTRAINT FK_partidos_equipos FOREIGN KEY (equipo_local_id) REFERENCES equipos(id) ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT FK_partidos_equipos_2 FOREIGN KEY (equipo_visitante_id) REFERENCES equipos(id) ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT FK_partidos_equipos_3 FOREIGN KEY (estadio_id) REFERENCES equipos(id) ON UPDATE NO ACTION ON DELETE NO ACTION
);
