<?php
  session_start(); 
  $username=$_SESSION['admin_username']; 
  $connection=new mysqli('localhost','root','','city_taxi');
  
  //fetch all the details relavent to reservation no received.
  if(!$_GET['id']){
    echo "<script> alert('ID not recieved.Unable to delete!!'); </script>";
  }
  else{
    $rno=$_GET['id'];
    $name_result=mysqli_query($connection,"SELECT * FROM reservation WHERE reservationno='$rno'");
	$name_row=mysqli_fetch_assoc($name_result);
    $reservation_no=$name_row['reservationno'];
    $passenger_id=$name_row['passengerid'];
    $driver_id=$name_row['driverid'];
    $start_place=$name_row['startplace'];
    $end_place=$name_row['endplace'];
    $status=$name_row['status'];
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Reservation</title>
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
              <h6><?php echo $username; ?></h6>
              <span>Admin</span>
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
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Passenger</span>
        </a>
      </li><li class="nav-item">
        <a class="nav-link collapsed" href="driver.php">
          <i class="bi bi-person-circle"></i>
             

        <span>Driver/Vehicle Owner</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="operator.php">
          <i class="bi bi-person-standing"></i>
          <span>Operator</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="reservation.php">
          <i class="bi bi-card-list"></i>
          <span>Reservation</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="payment.php">
          <i class="bi bi-credit-card-fill"></i>
          <span>Payment</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="user.php">
          <i class="bi bi-person-circle"></i>
          <span>User</span>
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
                <h5 class="card-title">Update Reservation</h5>
  
                <!-- Vertical Form -->
                <form class="row g-3" action="" method="POST">
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Reservation No</label>
                    <input type="text" name="reservationno" class="form-control" value="<?php echo $rno; ?>" id="inputNanme">
                  </div>

                  <div class="col-6">
                    <label for="inputState" class="form-label">PassengerID</label>
                    <input type="text" name="passengerid" class="form-control" id="addressInput1" autocomplete="off" value="<?php echo $passenger_id; ?>">
                  </div>
                  <div class="col-6">
                    <label for="inputState" class="form-label">Driver ID</label>
                    <input type="text" name="driverid" class="form-control" id="" autocomplete="off" value="<?php echo $driver_id; ?>" readonly>
                  </div>
                  
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Start Place</label>
                    <input type="text" name="startplace" class="form-control" id="" autocomplete="off" value="<?php echo $start_place; ?>" readonly>
                  </div>

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">End Place</label>
                    <input type="text" name="endplace" class="form-control" id="addressInput2" autocomplete="off" value="<?php echo $end_place; ?>" readonly>
                  </div> 

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Status(process/done)</label>
                    <input type="text" name="status" class="form-control" id="addressInput2" autocomplete="off" value="<?php echo $status; ?>">
                  </div> 
                  
                  <div class="text-Left">
                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                    <button class="btn btn-secondary"><a href="reservation.php">Cancel</a></button>
                  </div>
                </form><!-- Vertical Form -->  
              </div>
            </div>
            </div><!-- End Reports -->
        </div><!-- End Right side columns -->
      </div>
    </section>
  </main><!-- End #main -->
  <?php
  //code for update operator details
  if(isset($_POST['update'])){
    if(empty($_POST['status'])){
        echo "<script> alert('Provide all the details!!'); </script>";        
    }
    else{
        $reservationno=$_POST['reservationno'];
        $status=$_POST['status'];
      
      $update_query="UPDATE reservation SET status='$status' WHERE reservationno='$reservationno'";
      if($connection->query($update_query)){
        echo "<script> alert('Update successful.'); </script>";
        echo "<script>window.location='reservation.php';</script>";
      }
      else{
        echo "<script> alert('Update fail.'); </script>";
      }      
    }
  }
  ?>
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
  
     
  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>