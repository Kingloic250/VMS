<?php
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];

    $error = '';

    $v_id = $_SESSION['v_id'];
    $m_id = $_SESSION['m_id'];

    if (empty($search)) {
        $error = '<i class="fas fa-exclamation-circle"></i> No input search detected';
    }
    else {
        $start = 0;

$rows_per_page = 4;

$records = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) WHERE fname LIKE '%$search%' AND v_id = '$v_id'");
$record = mysqli_query($connect,"SELECT *FROM irondo JOIN village ON (irondo.v_id=village.v_id)  JOIN mudugudu ON (mudugudu.v_id=village.v_id) WHERE fname LIKE '%$search%' AND m_id = '$m_id'");
$select2 = mysqli_query($connect,"SELECT * FROM leave_citizen JOIN isibo ON (leave_citizen.i_id=isibo.i_id) WHERE fname LIKE '%{$_POST['search']}%' AND v_id = '$v_id'");
$nbr_rows = mysqli_num_rows($records);

$pages = ceil($nbr_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;

    $start = $page * $rows_per_page;
}

        $select = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) WHERE fname LIKE '%$search%' AND v_id = '$v_id' LIMIT $start,$rows_per_page");
        $select1 = mysqli_query($connect,"SELECT *FROM irondo JOIN village ON (irondo.v_id=village.v_id)  JOIN mudugudu ON (mudugudu.v_id=village.v_id) WHERE fname LIKE '%$search%' AND m_id = '$m_id' LIMIT $start,$rows_per_page");
        $select2 = mysqli_query($connect,"SELECT * FROM leave_citizen JOIN isibo ON (leave_citizen.i_id=isibo.i_id) WHERE fname LIKE '%{$_POST['search']}%' AND v_id = '$v_id'");
        
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
<title>VMS Search</title>
<div class="box">
                     
                        
                     <?php if (isset($error)): ?>
                         <div class="alert alert-danger text-center" style="margin-top:20px;">
                             <?php echo $error;?>
                         </div>
                     <?php endif ?>
                 </div>

                 <?php
                 include 'footer.php';
                 ?>