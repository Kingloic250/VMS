<?php
include '../connection/connection.php';
$cell_id = $_SESSION['cell_id'];
$delete = "DELETE FROM village WHERE cell_id = '$cell_id'";
$delete = "DELETE FROM mudugudu WHERE cell_id = '$cell_id'";
header('location:village.php');