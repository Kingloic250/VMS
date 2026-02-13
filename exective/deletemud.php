<?php
include '../connection/connection.php';
$id = $_GET['id'];
$delete = mysqli_query($connect,"DELETE FROM mudugudu WHERE m_id = '$id'");
header('location:leader1.php');