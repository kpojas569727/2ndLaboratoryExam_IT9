<?php
include "db.php";

$id = (int)$_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM reservations WHERE reservation_id = $id");
$get = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
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
        $sql = "UPDATE reservations
                SET plate_number='$plate', vehicle_type='$type', slot_number='$slot', is_paid='$paid', hourly_rate='$rate'
                WHERE reservation_id='$id'";
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
<title>Edit Reservation</title>
</head>
<body>

<div class="container mt-5" style="max-width: 500px;">
    <form method="POST">
        <h2>Edit Reservation (#<?php echo $id ?>)</h2>

        <label>Plate Number</label>
        <input type="text" name="plate_number" class="form-control mb-3" value="<?php echo $get['plate_number'] ?>">

        <label>Vehicle Type</label>
        <input type="text" name="vehicle_type" class="form-control mb-3" value="<?php echo $get['vehicle_type'] ?>">

        <label>Slot Number</label>
        <input type="text" name="slot_number" class="form-control mb-3" value="<?php echo $get['slot_number'] ?>">

        <label>Hourly Rate</label>
        <input type="number" step="0.01" name="hourly_rate" class="form-control mb-3" value="<?php echo $get['hourly_rate'] ?>">

        <input type="checkbox" name="is_paid" <?php if ($get['is_paid'] == 1) { echo "checked"; } ?>> Paid
        <br><br>

        <button type="submit" class="btn btn-primary" name="update">Update</button>
        <a class="btn btn-danger" href="index.php">Cancel</a>
    </form>
</div>

</body>
</html>