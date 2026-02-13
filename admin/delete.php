<?php

include '../connection/connection.php';

$id = $_GET['id'];

$delete = mysqli_query($connect,"DELETE FROM exective WHERE e_id = '$id'");
header('location:exective.php');