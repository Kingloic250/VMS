<?php

include '../connection/connection.php';

if (isset($_POST['fetch']) && isset($_POST['id'])) {


    $record = mysqli_query($connect,"SELECT *FROM irondo JOIN village ON (irondo.v_id=village.v_id)  WHERE id = '".$_POST['id']."'");
    $results = mysqli_fetch_assoc($record);
    echo json_encode($results);

}  