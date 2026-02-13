<?php

include '../connection/connection.php';

$id = $_GET['id'];

$delete = mysqli_query($connect,"DELETE FROM irondo WHERE id = '$id'");
header('location:irondo.php');