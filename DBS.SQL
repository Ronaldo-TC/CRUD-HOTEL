CREATE DATABASE hotel_booking;

USE hotel_booking;

CREATE TABLE
    rooms (
        id INT AUTO_INCREMENT PRIMARY KEY,
        room_number VARCHAR(10) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        availability BOOLEAN DEFAULT TRUE
    );

INSERT INTO
    rooms (room_number, price, availability)
VALUES
    ('101', 120.00, FALSE),
    ('102', 150.00, FALSE),
    ('103', 80.00, FALSE),
    ('104', 200.00, FALSE),
    ('105', 100.00, FALSE);

CREATE TABLE
    reservations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        customer_name VARCHAR(100) NOT NULL,
        room_id INT NOT NULL,
        check_in DATE NOT NULL,
        check_out DATE NOT NULL,
        FOREIGN KEY (room_id) REFERENCES rooms (id)
    );

INSERT INTO
    reservations (customer_name, room_id, check_in, check_out)
VALUES
    ('Ronaldo TC', 3, '2024-12-05', '2024-12-10'),
    ('Ana García', 5, '2024-12-01', '2024-12-03'),
    ('Ronaldo Tarqui', 4, '2024-12-12', '2024-12-15'),
    ('María López', 2, '2024-12-20', '2024-12-25'),
    ('Luis Ramírez', 1, '2024-12-28', '2024-12-30');