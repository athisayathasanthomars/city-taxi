<?php
session_start();
$connection=new mysqli('localhost','root','','city_taxi');
//get user profile detail 
$driverid=$_SESSION['driverid'];
$name_result=mysqli_query($connection,"SELECT * FROM driver WHERE driverid='$driverid'");
$name_row=mysqli_fetch_assoc($name_result);
$profile_name=$name_row['drivername'];
$session_profile_name=$_SESSION['drivername'];

if(isset($_POST['submit'])){
  if(empty($_POST['driverid']) || empty($_POST['status'])){
    echo "<script> alert('Provide the ID and Status!!'); </script>";        
  }
  else{
   $Driverid=$_POST["driverid"];
   $Driverstatus = $_POST["status"];  
   //code starts update driver status 
   $update_query="UPDATE driver SET status='$Driverstatus' WHERE driverid='$Driverid'";
   if($connection->query($update_query)){
     echo "<script> alert('Status Updated!!'); </script>";
   }else{
     echo "<script> alert('Updating failed!!'); </script>";
   }   
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Status</title>
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
        <img src="assets/img/" alt="">
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
              <h6><?php echo $session_profile_name; ?></h6>
              <span>Driver</span>
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
          <i class="bi bi-card-list"></i>
          <span>Status</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link  collapsed" href="vehicle.php">
          <i class="bi bi-list"></i>
          <span>Vehicle</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->      
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
                <h5 class="card-title">Status Update</h5>
  
                <!-- Vertical Form -->
                <form class="row g-3" method="POST" action="">
                  
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Your ID</label>
                    <input name="driverid" type="text" class="form-control" id="inputNanme4" value="<?php echo $driverid; ?>" readonly>
                  </div>

                  <div class="col-6">
                    <label for="inputState" class="form-label">Status</label>
                    <select name="status" id="inputState" class="form-select">
                      <option selected>Choose...</option>
                      <option value="Available" style="color: white; background-color: green;">Available</option>
                      <option value="Busy" style="color: white; background-color: red;">Busy</option>
                    </select>
                  </div>

                  
                  <div class="text-Left">
                    <button name="submit" type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-secondary">Clear</button>
                  </div>
                </form><!-- Vertical Form -->
  
              </div>
            </div> 
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Your Drive Reservations</h5>
  
                <!-- Default Table -->
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">PassengerID</th>                     
                      <th scope="col">Driver_ID</th>
                      <th scope="col">Start Place</th>
                      <th scope="col">End Place</th>
                      <th scope="col">Status</th>                    
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    
                    $table_result=mysqli_query($connection,"SELECT * FROM reservation WHERE driverid='$driverid'");  //input table name and id of passenger to retrive respective passenger booking details
                    while($row=mysqli_fetch_array($table_result))
                    {
                     ?>
                       <tr>
                         <td><?php echo $row['passengerid']; ?></td>
                         <td><?php echo $row['driverid']; ?></td>
                         <td><?php echo $row['startplace']; ?></td>
                         <td><?php echo $row['endplace']; ?></td>
                         <td><?php echo $row['status']; ?></td>
                       </tr>	
                      <?php
                    }
                    ?>                   
                  </tbody>
                </table>
                <!-- End Default Table Example -->
              </div>
            </div>                      
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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>