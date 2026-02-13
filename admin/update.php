<?php

include '../connection/connection.php';

if (isset($_POST['fetch']) && isset($_POST['user_id'])) {
    $select = mysqli_query($connect,"SELECT *FROM exective JOIN cell_table ON (exective.cell_id=cell_table.cell_id) WHERE e_id = '".$_POST['user_id']."'");
    $fetch = mysqli_fetch_assoc($select);
    echo json_encode($fetch);
}