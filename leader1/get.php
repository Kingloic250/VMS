<?php

include '../connection/connection.php';

if (isset($_POST['fetch']) && isset($_POST['u_id']) || isset($_POST['a_id'])) {
    $output = '';
    $records = mysqli_query($connect,"SELECT *FROM umuganda JOIN village ON (umuganda.v_id=village.v_id)  WHERE u_id = '".$_POST['u_id']."'");
    $result = mysqli_fetch_assoc($records);
    echo json_encode($result);

}



