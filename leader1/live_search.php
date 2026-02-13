<?php
session_start();
include '../connection/connection.php';

if (isset($_POST['query'])) {

    $m_id = $_SESSION['m_id'];
    $v_id = $_SESSION['v_id'];

    $search = $_POST['query'];

    $retval = "";

    $select = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON(citizen.i_id=isibo.i_id) WHERE fname LIKE '%$search%' AND v_id = '$v_id' LIMIT 3");

    if (mysqli_num_rows($select) > 0) {
        while ($fetch = mysqli_fetch_assoc($select)) {
            $retval .= "<p value='".$fetch['c_id']."'>".$fetch['fname']."</p>";
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