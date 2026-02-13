<?php

include '../connection/connection.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $procence = $_POST['provence'];
    $district = $_POST['district'];

    if (is_numeric($procence) && !empty($district)) {
            $select1 = mysqli_query($connect,"SELECT *FROM district WHERE district = '$district'");
            if (mysqli_num_rows($select1) == 0) {
                    $insert = mysqli_query($connect,"INSERT INTO district VALUES ('','$procence','$district')");
                    if ($insert == true) {
                        echo "<script>alert('New district registered successfully')</script>";
                    }
                    else {
                        $errors[] = '<h4>Unknown Error</h4>';
                    }
            }
            else {
                $errors[] = '<h4>This district exist</h4>';
            }
    }
    else {
        $errors[] = '<h4>Empty Fields</h4>';
    }
}

?>
<html>
<head>
    <title>Create Account in VMS</title>
</head>
<link rel="stylesheet" href="/VMS/css/index.css">
<link rel="shortcut icon" href="/VMS/img/vms.png" type="image/x-icon">
<link rel="stylesheet" href="/VMS/css/all.min.css">
<link rel="stylesheet" href="/VMS/css/fontawesome.min.css">
<body>
<div class="img">
    <img src="/VMS/img/vms.png" alt="">
</div>
    <div class="box">
        <?php if (!empty($errors)): ?>
            <div class="danger">
                <?php foreach ($errors as $error):
                    echo $error;
                endforeach ?>
            </div>
        <?php endif ?>
    </div>
    <div class="row">
        <div class="col-75">
            <div class="container">
                <form method="post">
                    <div class="row">
                        <div class="col-50">
                            <h2>INSERT PROVINCE</h2>
                            <label for="pin">Province</label>
                            <select name="provence" id="">
                                <?php
                                $select = mysqli_query($connect,"SELECT *FROM province");
                                while ($fetch = mysqli_fetch_assoc($select)) {
                                    echo "<option value='".$fetch['p_id']."'>".$fetch['province']."</option>";
                                }
                                ?>
                            </select>
                            <label for="pin">District</label>
                            <input type="text" name="district" placeholder="District">
                            <button type="submit" name="btn" class="button">Insert</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>