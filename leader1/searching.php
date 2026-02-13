<?php
session_start();

include '../connection/connection.php';

if (isset($_POST['search'])) {

    
$v_id = $_SESSION['v_id'];
    

    $select = mysqli_query($connect,"SELECT * FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) WHERE fname LIKE '%{$_POST['search']}%' AND v_id = '$v_id' LIMIT 3");
    $select1 = mysqli_query($connect,"SELECT * FROM leave_citizen JOIN isibo ON (leave_citizen.i_id=isibo.i_id) WHERE fname LIKE '%{$_POST['search']}%' AND v_id = '$v_id' LIMIT 3");
    $select2 = mysqli_query($connect,"SELECT * FROM irondo WHERE fname LIKE '%{$_POST['search']}%' AND v_id = '$v_id' LIMIT 3");

    if (mysqli_num_rows($select) > 0) {
        while ($fetch = mysqli_fetch_assoc($select)) {
            echo "<label><button class='search'><p>".$fetch['fname']."</p></button> <span disabled>Citizen</span></label>";
        }
    }
    elseif (mysqli_num_rows($select1) > 0) {
        while ($fetch1 = mysqli_fetch_assoc($select1)) {
            echo "<label><button class='search'><p>".$fetch1['fname']."</p></button> <span disabled>Leaved</span></label>";
        }
    }
    elseif (mysqli_num_rows($select2) > 0) {
        while ($fetch2 = mysqli_fetch_assoc($select2)) {
            echo "<label><button class='search'><p>".$fetch2['fname']."</p></button> <span disabled>Irondo</span></label>";
        }
    }
    else {
        echo "
        <div class='alert alert-danger' role='alert'>
            <i class='fas fa-exclamation-circle'></i> No matching results found !
        </div>    
        ";
    }
}
?>
<style>
    .search {
        padding: 5px;
        padding-left: 10px;
        border: none;
        background: transparent;
        display: block;
    }
    .search:hover{
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