<?php
$conn = new mysqli("localhost", "root", "", "parking_db");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM reservations WHERE reservation_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

$result = $conn->query("SELECT * FROM reservations");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Parking Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-3">
    <h1>Parking Reservations</h1>
    <a href="reservation_add.php" class="text-decoration-none link-success position-fixed top-0 end-0 m-3">Add Reservation</a>
    <table class="table mb-4" border="1">
        <tr>
            <th>reservation_id</th>
            <th>plate_number</th>
            <th>vehicle_type</th>
            <th>slot_number</th>
            <th>is_paid</th>
            <th>hourly_rate</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['reservation_id']; ?></td>
            <td><?php echo $row['plate_number']; ?></td>
            <td><?php echo $row['vehicle_type']; ?></td>
            <td><?php echo $row['slot_number']; ?></td>
            <td><?php echo $row['is_paid'] ? 'Paid' : 'Unpaid'; ?></td>
            <td><?php echo $row['hourly_rate']; ?></td>
            <td>
                <a href="reservation_edit.php?id=<?php echo $row['reservation_id']; ?>" class="text-decoration-none link-warning" >Edit</a>
                <a href="index.php?delete=<?php echo $row['reservation_id']; ?>" onclick="return confirm('Delete this reservation?');" class="text-decoration-none link-danger">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>