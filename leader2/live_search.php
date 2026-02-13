<?php
session_start();
include '../connection/connection.php';

if (isset($_POST['query'])) {

    $i_id = $_SESSION['i_id'];

    $search = $_POST['query'];

    $retval = "";

    $select = mysqli_query($connect,"SELECT *FROM citizen WHERE fname LIKE '%$search%' AND i_id = '$i_id' LIMIT 3");

    if (mysqli_num_rows($select) > 0) {
        while ($fetch = mysqli_fetch_assoc($select)) {
            $retval .= " <p>".$fetch['fname']."</p>";
        }
    }
    else {
        $retval .= "
        <div class='alert alert-danger' role='alert'>
            No citizen names found !
        </div>    
        ";
    }
    echo $retval;
}
?>
