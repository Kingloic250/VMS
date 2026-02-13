<?php

include '../connection/connection.php';
$id = $_GET['id'];

$delete = mysqli_query($connect,"DELETE FROM isibo WHERE i_id = '$id'");

header('location:isibo.php');