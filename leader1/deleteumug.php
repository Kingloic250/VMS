<?php

include '../connection/connection.php';

$id = $_GET['id'];

$delete = mysqli_query($connect,"DELETE FROM umuganda WHERE u_id = '$id'");
header('location:umuganda.php');