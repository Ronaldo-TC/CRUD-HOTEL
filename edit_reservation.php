<?php
include 'includes/db.php';

$id = $_GET['id'];
$reservation = $conn->query("SELECT * FROM reservations WHERE id = $id")->fetch_assoc();
$rooms = $conn->query("SELECT * FROM rooms");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $room_id = $_POST['room_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    $query = "UPDATE reservations 
              SET customer_name = '$customer_name', room_id = $room_id, check_in = '$check_in', check_out = '$check_out' 
              WHERE id = $id";

    if ($conn->query($query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1 style="text-align: center; margin-top: 20px;">Editar Reserva</h1>
    <form method="POST">
        <label for="customer_name">Nombre del Cliente</label>
        <input type="text" name="customer_name" value="<?= $reservation['customer_name'] ?>" required>

        <label for="room_id">Habitación</label>
        <select name="room_id" required>
            <?php while ($room = $rooms->fetch_assoc()): ?>
                <option value="<?= $room['id'] ?>" <?= $room['id'] == $reservation['room_id'] ? 'selected' : '' ?>>
                    Habitación <?= $room['room_number'] ?> - $<?= $room['price'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="check_in">Fecha de Entrada</label>
        <input type="date" name="check_in" value="<?= $reservation['check_in'] ?>" required>

        <label for="check_out">Fecha de Salida</label>
        <input type="date" name="check_out" value="<?= $reservation['check_out'] ?>" required>

        <button type="submit">Actualizar Reserva</button>
    </form>
</body>

</html>