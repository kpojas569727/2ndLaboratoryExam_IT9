<?php
include "db.php";

$id = (int)$_GET['id'];

mysqli_query($conn, "DELETE FROM reservations WHERE reservation_id = $id");

header("location: index.php");
exit();
?>