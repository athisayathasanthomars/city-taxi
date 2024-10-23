<?php
  session_start();
  $connection=new mysqli('localhost','root','','city_taxi');
  //get user profile detail 
  $id_value=$_SESSION['operatorid'];
  $name_result=mysqli_query($connection,"SELECT * FROM operator WHERE operatorid='$id_value'");
  $name_row=mysqli_fetch_assoc($name_result);
  $profile_id=$name_row['operatorid'];
  $profile_name=$name_row['operatorname'];
  $profile_email=$name_row['operatoremail'];
  $profile_phoneno=$name_row['operatorphoneno'];
  $profile_nic=$name_row['operatornic'];
  $profile_address=$name_row['operatoraddress'];     

  //code for update operator details of the passenger
  if(isset($_POST['update'])){
    if(empty($_POST['operatorid']) || empty($_POST['operatorname']) || empty($_POST['operatoremail']) || empty($_POST['operatorphoneno']) || empty($_POST['operatornic']) || empty($_POST['operatoraddress'])){
        echo "<script> alert('Provide all the details!!'); </script>";        
    }
    else{
      $operatorid=$_POST['operatorid'];
      $operatorname=$_POST['operatorname'];
      $operatoremail=$_POST['operatoremail'];
      $operatorphoneno=$_POST['operatorphoneno'];
      $operatornic=$_POST['operatornic'];
      $operatoraddress=$_POST['operatoraddress'];
      //code starts for updating operator record 
      $update_query="UPDATE operator operatorname='$operatorname',operatoremail='$operatoremail',operatorphoneno='$operatorphoneno',operatornic='$operatornic',operatoraddress='$operatoraddress' WHERE operatorid='$operatorid'";
      mysqli_query($connection,$update_query);
      echo "<script> alert('Update successful.'); </script>";      
      
    }
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Operator Profile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/cab.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/cab.png" alt="">
        <span class="d-none d-lg-block">City Taxi</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">           

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/city-taxi.png" alt="Profile" class="rounded-circle">
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $profile_name; ?></h6>
              <span>Operator</span>
            </li>
                       
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
                <i class="bi bi-person-circle"></i>
                <span>Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
        <a class="nav-link collapsed" href="passenger.php">
          <i class="bi bi-card-list"></i>
          <span>Passenger</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-card-list"></i>
          <span>Booking</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="availability.php">
          <i class="bi bi-card-list"></i>
          <span>Availability</span>
        </a>
      </li> 
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Update Profile Details</h5>
  
                <!-- Vertical Form -->
                <form class="row g-3" action="" method="POST">
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Operator ID</label>
                    <input type="text" name="operatorid" class="form-control" value="<?php $id_value; ?>" id="inputNanme4">
                  </div>

                  <div class="col-6">
                    <label for="inputState" class="form-label">Name</label>
                    <input type="text" name="operatorname" class="form-control" id="inputNanme4" value="<?php $profile_name; ?>">
                  </div>

                  <div class="col-6">
                    <label for="inputState" class="form-label">Email</label>
                    <input type="email" name="operatoremail" class="form-control" id="" autocomplete="off" value="<?php $profile_email; ?>">
                  </div>
                  
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">PhoneNo</label>
                    <input type="text" name="operatorphoneno" class="form-control" id="" autocomplete="off" value="<?php $profile_phoneno; ?>">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">NIC</label>
                    <input type="text" name="operatornic" class="form-control" id="" autocomplete="off" value="<?php $profile_nic; ?>">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Address</label>
                    <input type="text" name="operatoraddress" class="form-control" id="" autocomplete="off" value="<?php $profile_address; ?>">
                  </div>                  
                  
                  <div class="text-Left">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>                    
                    <button class="btn btn-primary"><a href="index.php">Cancel</a></button>
                  </div>
                </form><!-- Vertical Form -->  
              </div>
            </div>
            </div><!-- End Reports -->
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>@ City Taxi</span></strong>
    </div>
    
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  

</body>

</html>