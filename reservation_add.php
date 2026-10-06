<?php
include "db.php";

if (isset($_POST['add'])) {
    $plate = mysqli_real_escape_string($conn, $_POST['plate_number']);
    $type = mysqli_real_escape_string($conn, $_POST['vehicle_type']);
    $slot = mysqli_real_escape_string($conn, $_POST['slot_number']);
    $rate = mysqli_real_escape_string($conn, $_POST['hourly_rate']);

    if (isset($_POST['is_paid'])) {
        $paid = 1;
    } else {
        $paid = 0;
    }

    if ($plate == "" || $type == "" || $slot == "" || $rate == "") {
        echo "<script>alert('Please input on all fields')</script>";
    } else {
        $sql = "INSERT INTO reservations (plate_number, vehicle_type, slot_number, is_paid, hourly_rate)
                VALUES ('$plate', '$type', '$slot', '$paid', '$rate')";
        mysqli_query($conn, $sql);
        header("location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Add Reservation</title>
</head>
<body>

<div class="container mt-5" style="max-width: 500px;">
    <form method="POST">
        <h2>Add Reservation</h2>

        <label>Plate Number</label>
        <input type="text" name="plate_number" class="form-control mb-3">

        <label>Vehicle Type</label>
        <input type="text" name="vehicle_type" class="form-control mb-3">

        <label>Slot Number</label>
        <input type="text" name="slot_number" class="form-control mb-3">

        <label>Hourly Rate</label>
        <input type="number" step="0.01" name="hourly_rate" class="form-control mb-3">

        <input type="checkbox" name="is_paid"> Paid
        <br><br>

        <button type="submit" class="btn btn-primary" name="add">Add</button>
        <a class="btn btn-danger" href="index.php">Cancel</a>
    </form>
</div>

</body>
</html>