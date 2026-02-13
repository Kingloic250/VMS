<?php

include '../connection/connection.php';

$l_id = $_GET['id'];

$delete2 = "DELETE FROM leave_citizen WHERE l_id = '$l_id'";
$result1 = $connect -> query($delete2);

header('location:leave.php');