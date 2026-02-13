<?php
session_start();
include '../connection/connection.php';

if (isset($_POST['search'])) {

    
$i_id = $_SESSION['i_id'];
    

    $select = mysqli_query($connect,"SELECT * FROM citizen WHERE fname LIKE '%{$_POST['search']}%' AND i_id = '$i_id' LIMIT 3");
    $select1 = mysqli_query($connect,"SELECT * FROM leave_citizen WHERE fname LIKE '%{$_POST['search']}%' AND i_id = '$i_id' LIMIT 3");
    

    if (mysqli_num_rows($select) > 0) {
        while ($fetch = mysqli_fetch_assoc($select)) {
            echo "<label><button><p>".$fetch['fname']."</p></button> <span disable>Citizen</span></label>";
        }
    }
    elseif (mysqli_num_rows($select1) > 0) {
        while ($fetch1 = mysqli_fetch_assoc($select1)) {
            echo "<label><button><p>".$fetch1['fname']."</p></button> <span disable>Leaved</span></label>";
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
    button {
        padding: 5px;
        padding-left: 14px;
        border: none;
        background: transparent;
        display: block;
    }
    button:hover{
        background: #353b48;
    }
    span{
        color: #ccc;
        margin-top: 6px;
        cursor: pointer;
    }
    label{
        display: flex;
        gap: 1rem;
    }
</style>