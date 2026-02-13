<?php

include '../connection/connection.php';

if (isset($_POST['get']) && isset($_POST['a_id'])) {


    $record = mysqli_query($connect,"SELECT *FROM akagoroba JOIN village ON (akagoroba.v_id=village.v_id)  WHERE a_id = '".$_POST['a_id']."'");
    $results = mysqli_fetch_assoc($record);
    echo json_encode($results);

}  