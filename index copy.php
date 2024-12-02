<?php
include 'includes/db.php';

// Consultar todas las reservaciones
$reservations_query = "SELECT reservations.id, customer_name, room_number, check_in, check_out
                       FROM reservations
                       INNER JOIN rooms ON reservations.room_id = rooms.id";
$reservations_result = $conn->query($reservations_query);

// Consultar todas las habitaciones
$rooms_query = "SELECT * FROM rooms";
$rooms_result = $conn->query($rooms_query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas de Hotel</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Sistema de Reservas de Hotel</h1>

        <!-- Tabla de Reservaciones -->
        <div class="glass-container">
            <h2>Reservaciones</h2>
            <a href="add_reservation.php" class="button">Agregar Reserva <i class="fas fa-plus-circle"></i></a>
            <table>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Número de Habitación</th>
                        <th>Fecha de Entrada</th>
                        <th>Fecha de Salida</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($reservation = $reservations_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $reservation['customer_name'] ?></td>
                        <td><?= $reservation['room_number'] ?></td>
                        <td><?= $reservation['check_in'] ?></td>
                        <td><?= $reservation['check_out'] ?></td>
                        <td>
                            <a href="edit_reservation.php?id=<?= $reservation['id'] ?>"><i class="fas fa-edit"></i></a>
                            <a href="delete_reservation.php?id=<?= $reservation['id'] ?>"
                                onclick="return confirm('¿Estás seguro?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Tabla de Habitaciones -->
        <!-- Tabla de Habitaciones -->
        <div class="glass-container">
            <h2>Habitaciones</h2>
            <table>
                <thead>
                    <tr>
                        <th>Número de Habitación</th>
                        <th>Precio</th>
                        <th>Disponibilidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($room = $rooms_result->fetch_assoc()): ?>
                    <tr class="<?= $room['availability'] ? 'available' : 'reserved' ?>">
                        <td><?= $room['room_number'] ?></td>
                        <td>$<?= $room['price'] ?></td>
                        <td><?= $room['availability'] ? 'Disponible' : 'Reservada' ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>