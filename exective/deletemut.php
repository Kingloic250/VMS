<?php 
include '../connection/connection.php';
$id = $_GET['id'];

$delete = mysqli_query($connect,"DELETE FROM mutwarasibo WHERE mut_id = '$id'");
header('location:leader2.php');