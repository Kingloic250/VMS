<?php
include 'header.php';

if (isset($_POST['search'])) {
    $search = $_POST['search'];

    $error = '';

    $i_id = $_SESSION['i_id'];
    $mut_id = $_SESSION['mut_id'];

    if (empty($search)) {
        $error = '<i class="fas fa-exclamation-circle"></i> No input search detected';
    }
    else {
        $start = 0;

$rows_per_page = 4;

$records = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) JOIN mutwarasibo ON (mutwarasibo.i_id=isibo.i_id) WHERE fname LIKE '%$search%' AND mut_id = '$mut_id'");
$record = mysqli_query($connect,"SELECT *FROM leave_citizen JOIN isibo ON (leave_citizen.i_id=isibo.i_id) JOIN mutwarasibo ON (mutwarasibo.i_id=isibo.i_id) WHERE fname LIKE '%$search%' AND mut_id = '$mut_id'");

$nbr_rows = mysqli_num_rows($records);

$pages = ceil($nbr_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;

    $start = $page * $rows_per_page;
}

        $select = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) JOIN mutwarasibo ON (mutwarasibo.i_id=isibo.i_id) WHERE fname LIKE '%$search%' AND mut_id = '$mut_id' LIMIT $start,$rows_per_page");
        $select1 = mysqli_query($connect,"SELECT *FROM leave_citizen JOIN isibo ON (leave_citizen.i_id=isibo.i_id)  JOIN mutwarasibo ON (mutwarasibo.i_id=isibo.i_id) WHERE fname LIKE '%$search%' AND mut_id = '$mut_id' LIMIT $start,$rows_per_page");
        
        if (mysqli_num_rows($select) > 0) {
            include 'data.php';
        }
        elseif (mysqli_num_rows($select1) > 0) {
            include 'search_data.php';
        }
        else {
            $error = '<i class="fas fa-exclamation-circle"></i> No matching result found !';
        }
    }
}

?>
<title>VMS Search</title>
<div class="box">
                     
                        
                     <?php if (!empty($error)): ?>
                         <div class="alert alert-danger text-center" style="margin-top:20px;">
                             <?php echo $error;?>
                         </div>
                     <?php endif ?>
                 </div>

                 