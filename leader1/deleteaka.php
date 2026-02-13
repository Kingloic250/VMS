<?php

include_once '../connection/connection.php';

$id = $_GET['id'];

$delete = mysqli_query($connect,"DELETE FROM akagoroba WHERE a_id = '$id'");
header('location:akagoroba.php');