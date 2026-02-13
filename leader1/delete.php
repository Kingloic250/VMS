<?php
include '../connection/connection.php';

$id = $_GET['id'];

$delete = "DELETE FROM citizen WHERE c_id = '$id'";
$result = $connect -> query($delete);

header('location:register.php');


$l_id = $_GET['l_d'];

$delete2 = "DELETE FROM leave_citizen WHERE l_id = '$l_id'";
$result1 = $connect -> query($delete2);

header('location:register.php');