<?php

include '../connection/connection.php';

$delete = mysqli_query($connect,"DELETE FROM citizen");
header('location:register.php');