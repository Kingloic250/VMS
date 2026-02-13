<?php

include '../connection/connection.php';

$name = $_REQUEST['fname'];

if ($name != "") {
    $query = mysqli_query($connect,"SELECT * FROM citizen WHERE fname = '$name'");

    $fetch = mysqli_fetch_assoc($query);

    $contact = $fetch['phone'];
    $gender = $fetch['gender'];
    $result = array("$contact");

    $myJSON = json_encode($result);
    echo $myJSON;
}
else {
    echo "ERROR";
}