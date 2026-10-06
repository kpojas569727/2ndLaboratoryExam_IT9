<?php
$conn = new mysqli("localhost", "root", "", "parking_db");

if (isset($_POST['update'])) {
    $id = $_POST['reservation_id'];
    $plate = $_POST['plate_number'];
    $type = $_POST['vehicle_type'];
    $slot = $_POST['slot_number'];
    $paid = isset($_POST['is_paid']) ? 1 : 0;
    $rate = $_POST['hourly_rate'];

    $stmt = $conn->prepare("UPDATE reservations SET plate_number=?, vehicle_type=?, slot_number=?, is_paid=?, hourly_rate=? WHERE reservation_id=?");
    $stmt->bind_param("sssidi", $plate, $type, $slot, $paid, $rate, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM reservations WHERE reservation_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-3">
    <h1>Edit Reservation</h1>
    <form method="post">
        <input type="hidden" name="reservation_id" value="<?php echo $row['reservation_id']; ?>">
        <p>Plate Number: <input type="text" name="plate_number" value="<?php echo $row['plate_number']; ?>" required></p>
        <p>Vehicle Type: <input type="text" name="vehicle_type" value="<?php echo $row['vehicle_type']; ?>" required></p>
        <p>Slot Number: <input type="text" name="slot_number" value="<?php echo $row['slot_number']; ?>" required></p>
        <p>Hourly Rate: <input type="number" step="0.01" name="hourly_rate" value="<?php echo $row['hourly_rate']; ?>" required></p>
        <p>Paid: <input type="checkbox" name="is_paid" <?php if ($row['is_paid']) echo 'checked'; ?>></p>
        <button type="submit" name="update">Update</button>
        <a href="index.php">Back</a>
    </form>
</div>
</body>
</html>