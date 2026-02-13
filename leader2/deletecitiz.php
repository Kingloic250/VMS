<?php
include '../connection/connection.php';

$id = $_GET['id'];

$delete = "DELETE FROM citizen WHERE c_id = '$id'";
$result = $connect -> query($delete);

header('location:register.php');
