<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $room_id = $_POST['room_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    $query = "INSERT INTO reservations (customer_name, room_id, check_in, check_out)
              VALUES ('$customer_name', $room_id, '$check_in', '$check_out')";

    if ($conn->query($query)) {
        $conn->query("UPDATE rooms SET availability = FALSE WHERE id = $room_id");
        header('Location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
}

$rooms = $conn->query("SELECT * FROM rooms WHERE availability = TRUE");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reserva</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1 style="text-align: center; margin-top: 20px;">Agregar Reserva</h1>
    <form method="POST">
        <label for="customer_name">Nombre del Cliente</label>
        <input type="text" name="customer_name" placeholder="Ingrese el nombre del cliente" required>

        <label for="room_id">Habitación</label>
        <select name="room_id" required>
            <?php while ($room = $rooms->fetch_assoc()): ?>
                <option value="<?= $room['id'] ?>">Habitación <?= $room['room_number'] ?> - $<?= $room['price'] ?></option>
            <?php endwhile; ?>
        </select>

        <label for="check_in">Fecha de Entrada</label>
        <input type="date" name="check_in" required>

        <label for="check_out">Fecha de Salida</label>
        <input type="date" name="check_out" required>

        <button type="submit">Agregar Reserva</button>
    </form>
</body>

</html>