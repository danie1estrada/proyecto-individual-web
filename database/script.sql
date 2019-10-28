DROP DATABASE IF EXISTS medical_records;
CREATE DATABASE medical_records;
USE medical_records;

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(25) NOT NULL,
    full_name VARCHAR(45) NOT NULL,
    password VARCHAR(25) NOT NULL,
    role ENUM('administrator', 'user')
);

CREATE TABLE medical_records(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(45) NOT NULL,
    gender CHAR(1) NOT NULL,
    age INT(2) NOT NULL,
    date_of_birth DATE NOT NULL,
    occupation VARCHAR(45) NOT NULL,
    location VARCHAR(45) NOT NULL,
    nationality VARCHAR(25) NOT NULL,
    religion VARCHAR(25) NOT NULL,
    phone CHAR(10) NOT NULL,
    address VARCHAR(65) NOT NULL,
    email VARCHAR(45) NOT NULL,
    emergency_phone CHAR(10) NOT NULL,
    emergency_contact VARCHAR(45) NOT NULL
);

INSERT INTO users(username, full_name, password, role) VALUES ('daniel_estrada', 'Daniel Estrada', 'admin123', 'administrator');
INSERT INTO users(username, full_name, password, role) VALUES ('juan_romero', 'Juan Romero', 'user123', 'user');
