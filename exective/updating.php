<?php

include '../connection/connection.php';

if (isset($_POST['fetch']) && isset($_POST['m_id'])) {

    $records = mysqli_query($connect,"SELECT *FROM mutwarasibo JOIN isibo ON (mutwarasibo.i_id=isibo.i_id) JOIN village ON (isibo.v_id=village.v_id) WHERE mut_id = '".$_POST['m_id']."'");
    $result = mysqli_fetch_assoc($records);
    echo json_encode($result);

}