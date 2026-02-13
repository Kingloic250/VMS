<?php
session_start();
include '../connection/connection.php';

if (isset($_POST['search'])) {

    $cell_id = $_SESSION['cell_id'];
    $user_id = $_SESSION['user_id'];

    $search = $_POST['search'];

    //error_reporting(0);

    $select = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) JOIN village ON (isibo.v_id=village.v_id) JOIN cell_table ON (village.cell_id=cell_table.cell_id) JOIN exective ON (cell_table.cell_id=exective.cell_id) WHERE fname LIKE '%$search%' AND e_id = '$user_id'  LIMIT 3");
    $select2 = mysqli_query($connect,"SELECT * FROM leave_citizen JOIN isibo ON (leave_citizen.i_id=isibo.i_id) JOIN village ON (isibo.v_id=village.v_id) WHERE fname LIKE '%$search%' AND cell_id = '$cell_id' LIMIT 3");
    $ret = mysqli_query($connect,"SELECT *FROM mudugudu JOIN village ON (mudugudu.v_id=village.v_id) WHERE fullname LIKE '%$search%' AND cell_id = '$cell_id'  LIMIT 3");
    if (mysqli_num_rows($select) > 0) {
        while ($fetch = mysqli_fetch_assoc($select)) {
            echo "<label><button class='search'><p>".$fetch['fname']."</p></button><span disable>Citizen</span></label>";
        }
    }
    elseif (mysqli_num_rows($ret) > 0) {
        while ($fetch1 = mysqli_fetch_assoc($ret)) {
            echo "<label><button class='search'><p>".$fetch1['fullname']."</p></button> <span disable>Mudugudu</span></label>";
        }
    }
    elseif (mysqli_num_rows($select2) > 0) {
        while ($fetch2 = mysqli_fetch_assoc($select2)) {
            echo "<label><button class='search'><p>".$fetch2['fname']."</p></button><span disable>Leaved</span></label>";
        }
    }
    else {
        echo "
        <div class='alert alert-danger' role='alert'>
            No citizen names found !
        </div>    
        ";
    }
}
?>
<style>
    button {
        padding: 6px;
        padding-left: 15px;
        border: none;
        background: transparent;
        display: block;
    }
    button:hover{
        background: #353b48;
    }
    span{
        color: #ccc;
        margin-top: 7px;
        cursor: pointer;
    }
    label{
        display: flex;
        gap: 1rem;
    }
</style>