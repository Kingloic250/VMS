<?php
session_start();
include_once '../connection/connection.php';

$i_id = $_SESSION['i_id'];

$result = array(); 
$select = mysqli_query($connect,"SELECT *FROM citizen WHERE  i_id = '$i_id'");


while ($fetch = mysqli_fetch_assoc($select)) {
	$result[] = $fetch;
}

echo json_encode($result);