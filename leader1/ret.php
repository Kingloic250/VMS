<?php

include '../connection/connection.php';

if (isset($_POST['fetch']) && isset($_POST['id'])) {


    $record = mysqli_query($connect,"SELECT *FROM kwishyura JOIN village ON (kwishyura.v_id=village.v_id)  WHERE k_id = '".$_POST['id']."'");
    $results = mysqli_fetch_assoc($record);
    echo json_encode($results);

}  