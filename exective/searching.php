<?php
include 'header.php';

error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];

    $error = '';

    $cell_id = $_SESSION['cell_id'];
    $user_id = $_SESSION['user_id'];

    if (empty($search)) {
        $error = '<i class="fas fa-exclamation-circle"></i> No input search detected';
    }
    else {
        $start = 0;

$rows_per_page = 4;

$select = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) JOIN village ON (isibo.v_id=village.v_id) JOIN cell_table ON (village.cell_id=cell_table.cell_id) JOIN exective ON (cell_table.cell_id=exective.cell_id) WHERE fname LIKE '%$search%' AND e_id = '$user_id'");
$record = mysqli_query($connect,"SELECT *FROM mudugudu JOIN village ON (mudugudu.v_id=village.v_id) WHERE fullname LIKE '%$search%' AND cell_id = '$cell_id'");
$select2 = mysqli_query($connect,"SELECT * FROM leave_citizen JOIN isibo ON (leave_citizen.i_id=isibo.i_id) JOIN village ON (isibo.v_id=village.v_id) WHERE fname LIKE '%$search%' AND cell_id = '$cell_id'");
$nbr_rows = mysqli_num_rows($select);

$pages = ceil($nbr_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;

    $start = $page * $rows_per_page;
}

        $select = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) JOIN village ON (isibo.v_id=village.v_id) JOIN cell_table ON (village.cell_id=cell_table.cell_id) JOIN exective ON (cell_table.cell_id=exective.cell_id) WHERE fname LIKE '%$search%' AND e_id = '$user_id'");
        $select1 = mysqli_query($connect,"SELECT *FROM mudugudu JOIN village ON (mudugudu.v_id=village.v_id) WHERE fullname LIKE '%$search%' AND cell_id = '$cell_id'");
        $select2 = mysqli_query($connect,"SELECT * FROM leave_citizen JOIN isibo ON (leave_citizen.i_id=isibo.i_id) JOIN village ON (isibo.v_id=village.v_id) WHERE fname LIKE '%$search%' AND cell_id = '$cell_id'");
        
        if (mysqli_num_rows($select) > 0) {
            include 'data.php';
        }
        elseif (mysqli_num_rows($select1) > 0) {
            include 'search_data.php';
        }
        elseif (mysqli_num_rows($select2) > 0) {
            include 'leave_data.php';
        }
        else {
            $error = '<i class="fas fa-exclamation-circle"></i> No matching result found !';
        }
    }
}

?>
<title>VMS Search </title>
<div class="box">
                     
                        
                     <?php if (!empty($error)): ?>
                         <div class="alert alert-danger text-center" style="margin-top:20px;">
                             <?php echo $error;?>
                         </div>
                     <?php endif ?>
                 </div>

                 <?php
                 include 'footer.php';
                 ?>