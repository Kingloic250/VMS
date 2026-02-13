<?php

include '../connection/connection.php';

$id = $_GET['id'];

$delete = mysqli_query($connect,"DELETE FROM leave_citizen WHERE l_id = '$id'");
header('location:leaving_citizen.php');