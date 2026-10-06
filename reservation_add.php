<?php
$conn = new mysqli("localhost", "root", "", "parking_db");

if (isset($_POST['save'])) {
    $plate = $_POST['plate_number'];
    $type = $_POST['vehicle_type'];
    $slot = $_POST['slot_number'];
    $paid = isset($_POST['is_paid']) ? 1 : 0;
    $rate = $_POST['hourly_rate'];

    $stmt = $conn->prepare("INSERT INTO reservations (plate_number, vehicle_type, slot_number, is_paid, hourly_rate) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssid", $plate, $type, $slot, $paid, $rate);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container mt-3">
<body>
    <h1>Add Reservation</h1>
    <form method="post">
        <p>Plate Number: <input type="text" name="plate_number" required></p>
        <p>Vehicle Type: <input type="text" name="vehicle_type" required></p>
        <p>Slot Number: <input type="text" name="slot_number" required></p>
        <p>Hourly Rate: <input type="number" step="0.01" name="hourly_rate" required></p>
        <p>Paid: <input type="checkbox" name="is_paid"></p>
        <button type="submit" name="save">Save</button>
        <a href="index.php">Back</a>
    </form>
</div>
</body>
</html>