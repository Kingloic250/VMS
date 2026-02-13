<?php

include '../connection/connection.php';

if (isset($_POST['fetch']) && isset($_POST['m_id'])) {

    $records = mysqli_query($connect,"SELECT *FROM mudugudu JOIN village ON (mudugudu.v_id=village.v_id) WHERE m_id = '".$_POST['m_id']."'");
    $result = mysqli_fetch_assoc($records);
    echo json_encode($result);

}