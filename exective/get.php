<?php

include '../connection/connection.php';

if (isset($_POST['fetch']) && isset($_POST['c_id'])) {
    $output = '';
    $records = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id)  WHERE c_id = '".$_POST['c_id']."'");
    $result = mysqli_fetch_assoc($records);

    echo json_encode($result);
}
