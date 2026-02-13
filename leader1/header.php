<?php
session_start();
include '../connection/connection.php';
include '../connection/function.php';


$inactive_time = 15 * 60;

if (!empty($_SESSION['m_id'])) {
	if (isset($_SESSION['last_timestamp']) && (time() - $_SESSION['last_timestamp']) > $inactive_time) {
		session_unset();
		session_destroy();
		echo "<script>alert('You have been signed out due to inactive session for 15 minutes.');location.href='../';</script>";
	 }
	 else {
		session_regenerate_id(true);
		$_SESSION['last_timestamp'] = time();
	 }
}
else {
	echo "<script>alert('No session id found, Sign In again.');location.href='../';</script>";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	  <meta http-equiv="refresh" content="900">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="/vms/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	    <!----css3---->
        <!--  fontawesome icons    -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../css/custom.css">
		<link rel="stylesheet" href="/vms/css/all.min.css"> 
		<link rel="stylesheet" href="../css/loader.css">
		<link rel="stylesheet" href="/vms/css/fontawesome.min.css">
		<link rel="shortcut icon" href="../img/vms.png" type="image/x-icon">

		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

       <!--   js libraries   -->

               <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  </head>

  <?php
	if (isset($_GET['page-nr'])) {
		$id = $_GET['page-nr'];
	}
	else {
		$id = 1;
	}
  ?>

  
<div class="wrapper">
     
	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 
	 <div id="sidebar">
	    <div class="sidebar-header">
		   <h3><img src="../img/vms.png" class="img-fluid"/><span>VMS Dashboard</span></h3>
		</div>
		<ul class="list-unstyled component m-0">
		  <li id="dash">
		  <a href="home.php" class="dashboard">
			<i class="fas fa-home"></i>dashboard </a>
		  </li>

		  <li class="dropdown" id="dropdown">
		  <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" 
		  class="dropdown-toggle">
		  <i class="fas fa-users"></i>Citizens / Abaturage
		  </a>
		  <ul class="collapse list-unstyled menu" id="homeSubmenu2">
			 <li><a href="umudugudu.php">Umudugudu</a></li>
			 <li><a href="sub_village.php">Isibo</a></li>
			 <li><a href="leave.php">Abagiye</a></li>
		  </ul>
		  </li>
		  
		  <li class="dropdown" id="dropdown">
		  <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" 
		  class="dropdown-toggle">
		  <i class="fas fa-file"></i>Activities / Imirimo
		  </a>
		  <ul class="collapse list-unstyled menu" id="homeSubmenu1">
		     <li><a href="umuganda.php">Umuganda</a></li>
			 <li><a href="akagoroba.php">Akagoroba K'ababyeyi</a></li>
			 <li><a href="irondo.php">Abanyerondo</a></li>
			 <li><a href="abishyuye.php">Abishyuye irondo</a></li>
		  </ul>
		  </li>
		
		</ul>
	 </div>
	 
   <!-------sidebar--design- close----------->
   
   
   
      <!-------page-content start----------->
   
      <div id="content">
	     
		  <!------top-navbar-start-----------> 
		     
		  <div class="top-navbar">
		     <div class="xd-topbar">
			     <div class="row">
				     <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
					    <div class="xp-menubar">
						    <i class="fas fa-bars"></i>
						</div>
					 </div>
					 
					 <div class="col-md-3 col-lg-4 order-3 order-md-2">
					     <div class="xp-searchbar">
						     <form action="search.php" method="post">
							    <div class="input-group">
								  <input type="search" class="search-results" name="search" id="search"
								  placeholder="Search here..." autocomplete="off">
								  <i class="fas fa-search"></i>
								</div>
								<div id="result" name='search' class="results"></div>
							 </form>
						 </div>
					 </div>
					 
					 
					 <div class="col-10 col-md-7 col-lg-7 order-1 order-md-3">
					     <div class="xp-profilebar text-right">
						    <nav class="navbar p-0">
							   <ul class="nav navbar-nav flex-row ml-auto">
							   <!-- <li class="dropdown nav-item active">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								 <i class='fas fa-earth'></i>
								 </a>
								  <ul class="dropdown-menu">
								     <li><a href="#">Kinyarwanda</a></li>
									 <li><a href="#">French</a></li>
									 <li><a href="#">English</a></li>
								  </ul>
							   </li> -->
							   
							   <li class="nav-item">
							     <a class="nav-link" href="#">
								 </a>
							   </li>
							   
							   <li class="dropdown nav-item">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								  <img src="../img/vms.png" class="img" style="width:40px; border-radius:50%;"/>
								  <span class="xp-user-live"></span>
								 </a>
								  <ul class="dropdown-menu small-menu">
								     <li><a href="#editProfileModal" data-toggle="modal">
										<i class="fas fa-user"></i>
									 Profile
									 </a></li>
									 <li><a href="#signEmployeeModal" data-toggle="modal">
										<i class="fas fa-sign-out"></i>
									 Sign Out
									 </a></li>
									 
								  </ul>
							   </li>
							   
							   
							   </ul>
							</nav>
						 </div>
					 </div>
					 
				 </div>
				 
				 <div class="xp-breadcrumbbar text-center">
				    <h4 class="page-title">Leader 1 (Mudugudu) Dashboard</h4>
					<ol class="breadcrumb">
					  <li class="breadcrumb-item"><a href="#">VMS</a></li>
					  <li class="breadcrumb-item active" aria-curent="page">Dashboard</li>
					</ol>
				 </div>
				 
				 
			 </div>
		  </div>
		  <!------top-navbar-end-----------> 
		 

		  <style>
			.img {
				width: 40px;
				border-radius: 50%;
				font-size: 60px;
			}
			.h5{
				margin-left: 20px;
			}
			.profiles {
				margin-top: 2px;
				font-size: 27px;
			}
			.info{
				font-size: 19px;
				text-align: center;
			}
		  </style>


 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="/vms/js/jquery-3.3.1.slim.min.js"></script>
   <script src="/vms/js/popper.min.js"></script>
   <script src="/vms/js/bootstrap.min.js"></script>
   <script src="/vms/js/nice-select/jquery.nice-select.js"></script>
   <script src="/vms/js/bootstrap-select.min.js"></script>
   <script src="/vms/js/jquery-3.3.1.min.js"></script>
   <script src="/vms/js/script.js"></script>
  <script src="../js/select2.js"></script>
  
  <script type="text/javascript">
       $(document).ready(function(){
	      $(".xp-menubar").on('click',function(){
		    $("#sidebar").toggleClass('active');
			$("#content").toggleClass('active');
		  });
		  
		  $('.xp-menubar,.body-overlay').on('click',function(){
		     $("#sidebar,.body-overlay").toggleClass('show-nav');
		  });
		  
	   });
  </script>


<div class="modal fade" tabindex="-1" id="signEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Signing Out Mudugudu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to sign out ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="logout.php?user_id=<?php echo  md5($_SESSION['m_id']); ?>"><button type="button" class="btn btn-danger">Sign Out</button></a>
      </div>
    </div>
  </div>
</div>

<?php
$m_id = $_SESSION['m_id'];
$select = mysqli_query($connect,"SELECT *FROM mudugudu JOIN village ON(mudugudu.v_id=village.v_id) WHERE m_id = '$m_id'");
$fetch = mysqli_fetch_assoc($select);
?>



<div class="modal fade" tabindex="-1" id="editProfileModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  <i class="fas fa-user profiles model-title"></i> <h5 class="modal-title h5">Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" method="post">
      <div class="modal-body">
		<h1><?php echo $fetch['fullname'] ?></h1>
		<p class="title">Title: Chief, of <?php echo $fetch['village'] ?> Village</p> 
		<p>Phone Number: <?php echo '0'.strtolower($fetch['phones']) ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>
  </div>
</div>

					   <!----edit-modal end--------->	   
					   


<style>
	.results {
		background: #4a5263;
		box-shadow: 0 1px 7px 1px rgba(0,0,0,0.1);
		width: 100%;
		border-radius: 30px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
	}
	.results button p{
		display: block;
		word-wrap: break-word;
		opacity: .8;
		margin: 0;
		text-decoration: none;
		color: #eee;
		font-size: 15px;
		font-weight: bold;
		cursor: pointer;
	}
	.results button p:hover{
		background: #353b48;
	}
</style>






<script>

	// loader 
	var myVar;

        function myFunction() {
            myVar = setTimeout(showPage, 3000);
        }

        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("myDiv").style.display = "block";
        }

        $(document).ready(function () {
        	$('#search').keyup(function () {
        let searching = $(this).val();
        if (searching != '') {
            $.ajax({
                url: 'searching.php',
                method: 'POST',
                data: {search: searching},
                success: function (data) {
                    $('#result').html(data);
                    $('#result').css('display','block');
                    $('#result p').click(function () {
                        let value = $(this).html();
                        $('#search').val(value);
                        $('#result').css('display','none');
                    });
                }
            });
        }
        else{
            $('#result').css('display','none');
        }
    });
        })
</script>
