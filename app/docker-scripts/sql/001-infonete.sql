drop database if exists infonete;
CREATE DATABASE infonete;
use infonete;

CREATE TABLE pago
(
    id     INT PRIMARY KEY AUTO_INCREMENT,
    codigo VARCHAR(50)
);

CREATE TABLE rol
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    codigo      VARCHAR(50),
    descripcion VARCHAR(50)
);

CREATE TABLE localidad
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    codigo      VARCHAR(50),
    descripcion VARCHAR(50)
);

CREATE TABLE persona
(
    id               INT PRIMARY KEY AUTO_INCREMENT,
    apellido         VARCHAR(50),
    nombre           VARCHAR(50),
    fecha_nacimiento VARCHAR(50),
    id_localidad     INT,
    FOREIGN KEY (id_localidad)
        REFERENCES localidad (id)
);

CREATE TABLE usuario
(
    id         INT PRIMARY KEY AUTO_INCREMENT,
    nombre     VARCHAR(50),
    password   VARCHAR(50),
    id_persona INT,
    id_rol     INT,
    FOREIGN KEY (id_persona)
        REFERENCES persona (id),
    FOREIGN KEY (id_rol)
        REFERENCES rol (id)
);

CREATE TABLE suscripcion
(
    id                   INT PRIMARY KEY AUTO_INCREMENT,
    fecha_vigencia_desde DATE,
    fecha_vigencia_hasta DATE,
    id_pago              INT,
    id_usuario           INT,
    FOREIGN KEY (id_pago)
        REFERENCES pago (id),
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id)
);

CREATE TABLE estado
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    codigo      VARCHAR(50),
    descripcion VARCHAR(50)
);

CREATE TABLE tipo_publicacion
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    codigo      VARCHAR(50),
    descripcion VARCHAR(50)
);

CREATE TABLE genero_publicacion
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    codigo      VARCHAR(50),
    descripcion VARCHAR(50)
);

CREATE TABLE publicacion
(
    id                  INT PRIMARY KEY AUTO_INCREMENT,
    contenido_gratuito  BOOLEAN,
    estado_registro     BOOLEAN,
    id_genero           INT,
    id_tipo_publicacion INT,
    id_estado           INT,
    FOREIGN KEY (id_genero)
        REFERENCES genero_publicacion (id),
    FOREIGN KEY (id_tipo_publicacion)
        REFERENCES tipo_publicacion (id),
    FOREIGN KEY (id_estado)
        REFERENCES estado (id)
);

CREATE TABLE seccion
(
    id              INT PRIMARY KEY AUTO_INCREMENT,
    estado_registro BOOLEAN,
    id_publicacion  INT,
    id_estado       INT,
    FOREIGN KEY (id_publicacion)
        REFERENCES publicacion (id),
    FOREIGN KEY (id_estado)
        REFERENCES estado (id),
    FOREIGN KEY (id_publicacion)
        REFERENCES publicacion (id)
);

CREATE TABLE noticia
(
    id              INT PRIMARY KEY AUTO_INCREMENT,
    estado_registro BOOLEAN,
    id_seccion      INT,
    id_contenidista INT,
    id_localidad    INT,
    id_estado       INT,
    FOREIGN KEY (id_seccion)
        REFERENCES seccion (id),
    FOREIGN KEY (id_contenidista)
        REFERENCES usuario (id),
    FOREIGN KEY (id_localidad)
        REFERENCES localidad (id),
    FOREIGN KEY (id_estado)
        REFERENCES estado (id)
);

CREATE TABLE publicacion_usuario
(
    id             INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario     INT,
    id_publicacion INT,
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id),
    FOREIGN KEY (id_publicacion)
        REFERENCES publicacion (id)
);



