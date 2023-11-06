-- Chequeo que la base exista, en caso de que sí, la borro.
DROP DATABASE IF EXISTS sistema_productos;
-- Creo la base de datos
CREATE DATABASE sistema_productos;

-- Si el usuario existe, lo borro
DROP USER IF EXISTS 'usuario'@'localhost';
-- Creo al usuario y le doy acceso a la base de datos del mismo
CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'cambiar';
GRANT ALL PRIVILEGES ON sistema_productos.* TO 'usuario'@'localhost';
FLUSH PRIVILEGES;

USE sistema_productos;

-- Si la tabla existe, la borro
DROP TABLE IF EXISTS productos;
-- Creo la tabla
CREATE TABLE productos (
    codigo VARCHAR(50) NOT NULL,
    nombre VARCHAR(40) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    PRIMARY KEY (codigo)
);
