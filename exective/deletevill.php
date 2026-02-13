<?php

include '../connection/connection.php';
$id = $_GET['id'];

$delete = mysqli_query($connect,"DELETE FROM village WHERE v_id = '$id'");

header('location:village.php');