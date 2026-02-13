<?php
include '../connection/connection.php';




$id = $_POST['id'];
$sql = "SELECT *FROM isibo WHERE v_id = '$id'";
$result = mysqli_query($connect,$sql);


$out = '';
while ($fetch = mysqli_fetch_assoc($result)) {
    $out .= '<option value="'.$fetch['i_id'].'">'.$fetch['i_name'].'</option>';
}
echo $out;
