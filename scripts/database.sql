-- Crear base de datos
CREATE DATABASE restaurante_db;
USE restaurante_db;

-- Tabla de usuarios
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('cliente', 'admin') DEFAULT 'cliente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de tarjetas de lealtad
CREATE TABLE loyalty_cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    card_number VARCHAR(20) UNIQUE NOT NULL,
    stamps INT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla de eventos
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    date DATE,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de reservaciones
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_number INT NOT NULL,
    num_people INT NOT NULL,
    reservation_date DATETIME NOT NULL,
    name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    occasion VARCHAR(255),
    special_request TEXT,
    status ENUM('pendiente', 'aceptada', 'rechazada') DEFAULT 'pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de mesas (para el mapa interactivo)
CREATE TABLE tables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_number INT UNIQUE NOT NULL,
    status ENUM('disponible', 'reservada', 'ocupada') DEFAULT 'disponible',
    capacity INT NOT NULL
);

-- Insertar mesas de ejemplo (ajusta según el restaurante)
INSERT INTO tables (table_number, capacity) VALUES
(1, 4), (2, 2), (3, 6), (4, 4), (5, 8);