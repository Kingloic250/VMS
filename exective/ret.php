<?php

include '../connection/connection.php';


$cell_id = $_POST['cell_id'];
$sql1 = "SELECT *FROM village WHERE cell_id = '$cell_id'";
$result1 = mysqli_query($connect,$sql1);


$get = '';
while ($row = mysqli_fetch_assoc($result1)) {
    $get .= '<option value="'.$fetch['v_id'].'">'.$row['village'].'</option>';
}
echo $get;