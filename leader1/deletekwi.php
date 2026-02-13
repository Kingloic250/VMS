<?php

include '../connection/connection.php';

$id = $_GET['id'];

$delete = mysqli_query($connect,"DELETE FROM kwishyura WHERE k_id = '$id'");
header('location:abishyuye.php');