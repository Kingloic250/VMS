<?php

include '../connection/connection.php';

if (isset($_POST['ret']) && isset($_POST['l_id'])) {
    $record = mysqli_query($connect,"SELECT *FROM leave_citizen JOIN isibo ON (leave_citizen.i_id=isibo.i_id) 
        WHERE l_id = '".$_POST['l_id']."'");
    $results = mysqli_fetch_assoc($record);

    echo json_encode($results);
}