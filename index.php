<?php
include "db.php";

$reservations = mysqli_query($conn, "SELECT * FROM reservations");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Parking Reservations</title>
</head>
<body class="container mt-4">

<h2>Parking Reservations</h2>
<a class="btn btn-primary mb-3" href="reservation_add.php">Add Reservation</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Plate Number</th>
            <th>Vehicle Type</th>
            <th>Slot Number</th>
            <th>Paid</th>
            <th>Hourly Rate</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($reservations)) { ?>
        <tr>
            <td><?php echo $row['reservation_id'] ?></td>
            <td><?php echo $row['plate_number'] ?></td>
            <td><?php echo $row['vehicle_type'] ?></td>
            <td><?php echo $row['slot_number'] ?></td>
            <td><?php if ($row['is_paid'] == 1) { echo "Paid"; } else { echo "Unpaid"; } ?></td>
            <td><?php echo $row['hourly_rate'] ?></td>
            <td>
                <a class="btn btn-warning" href="reservation_edit.php?id=<?php echo $row['reservation_id'] ?>">Edit</a>
                <a class="btn btn-danger" href="reservation_delete.php?id=<?php echo $row['reservation_id'] ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>