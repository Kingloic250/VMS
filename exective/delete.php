<?php


include '../connection/connection.php';


$l_id = $_GET['id'];

$delete2 = "DELETE FROM leave_citizen WHERE l_id = '$id'";
$result1 = $connect -> query($delete2);

header('location:leave_sub.php');