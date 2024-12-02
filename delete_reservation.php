<?php
include 'includes/db.php';

$id = $_GET['id'];

// Recuperar la habitación asociada a la reserva
$reservation = $conn->query("SELECT room_id FROM reservations WHERE id = $id")->fetch_assoc();
$room_id = $reservation['room_id'];

// Eliminar la reserva y actualizar la disponibilidad de la habitación
$conn->query("DELETE FROM reservations WHERE id = $id");
$conn->query("UPDATE rooms SET availability = TRUE WHERE id = $room_id");

header('Location: index.php');
