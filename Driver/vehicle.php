<?php
session_start();
$connection=new mysqli('localhost','root','','city_taxi');
//get user profile detail 
$driverid=$_SESSION['driverid'];
$name_result=mysqli_query($connection,"SELECT * FROM driver WHERE driverid='$driverid'");
$name_row=mysqli_fetch_assoc($name_result);
$profile_name=$name_row['drivername'];


$result=mysqli_query($connection,"SELECT * FROM driver WHERE driverid='$driverid'");
$row=mysqli_fetch_assoc($result);
if(mysqli_num_rows($result)>0){
  $drivername = $row["drivername"];
  $driveremail = $row["driveremail"];
  $driverphoneno = $row["driverphoneno"];
  $drivervehicleregno = $row["drivervehicleregno"];
  $drivernic = $row["drivernic"];
  $driveraddress = $row["driveraddress"];		
}
else{
				echo "<script> alert('Username not registered!!'); </script>";
}

if(isset($_POST['update'])){
  if(empty($_POST['drivername']) || empty($_POST['drivername']) || empty($_POST['driveremail']) || empty($_POST['driverphoneno']) || empty($_POST['drivervehicleregno']) || empty($_POST['driveraddress'])){
      echo "<script> alert('Provide all the details!!'); </script>";        
  }
  else{
    $Driverid=$_POST["driverid"];
    $Drivername = $_POST["drivername"];
    $Driveremail = $_POST["driveremail"];
    $Driverphoneno = $_POST["driverphoneno"];
    $Drivervehicleregno = $_POST["drivervehicleregno"];
    $Drivernic = $_POST["drivernic"];
    $Driveraddress = $_POST["driveraddress"];
    //code starts for inserting reservation record 
    $update_query="UPDATE driver SET drivername='$Drivername',driveremail='$Driveremail',driverphoneno='$Driverphoneno',drivervehicleregno='$Drivervehicleregno',drivernic='$Drivernic',driveraddress='$Driveraddress' WHERE driverid='$Driverid'";
    if($connection->query($update_query)){
      echo "<script> alert('Details Updated!!'); </script>";
      echo "<script>window.location='vehicle.php';</script>";
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

  <title>Update driver details</title>
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
              <h6><?php echo $profile_name; ?></h6>
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
        <a class="nav-link collapsed" href="vehicle.php">
          <i class="bi bi-credit-card-fill"></i>
          <span>Driver Details</span>
        </a>
      </li><!-- End Profile Page Nav -->
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
                <h5 class="card-title">Update Details</h5>
  
                <!-- Vertical Form -->
                <form class="row g-3" action="" method="POST">

                  <div class="col-6">
                    <label for="inputNanme1" class="form-label">Your ID</label>
                    <input name="driverid" type="text" class="form-control" id="inputNanme1" value="<?php echo $driverid; ?>" readonly>
                  </div>
                  
                  <div class="col-6">
                    <label for="inputNanme1" class="form-label">Name</label>
                    <input name="drivername" type="text" class="form-control" id="inputNanme1" value="<?php echo $drivername ?>">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme1" class="form-label">Email</label>
                    <input name="driveremail" type="text" class="form-control" id="inputNanme1" value="<?php echo $driveremail ?>">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme1" class="form-label">Phone No</label>
                    <input name="driverphoneno" type="text" class="form-control" id="inputNanme1" value="<?php echo $driverphoneno ?>">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme1" class="form-label">Vehicle.Reg.No</label>
                    <input name="drivervehicleregno" type="text" class="form-control" id="inputNanme1" value="<?php echo $drivervehicleregno ?>">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme1" class="form-label">NIC</label>
                    <input name="drivernic" type="text" class="form-control" id="inputNanme1" value="<?php echo $drivernic ?>">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme1" class="form-label">Address</label>
                    <input name="driveraddress" type="text" class="form-control" id="inputNanme1" value="<?php echo $driveraddress ?>">
                  </div>
                  <div class="text-Left">
                    <button name="update" type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
                </form><!-- Vertical Form -->
  
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Your Details</h5>
  
                <!-- Default Table -->
                <table class="table">
                  <thead>
                    <tr>
                      
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">PhoneNo</th>
                      <th scope="col">Vehicle.Reg.No</th>
                      <th scope="col">NIC</th>
                      <th scope="col">Address</th>
                      <th scope="col">Available</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php                    
                     ?>
                       <tr>
                         <th scope="row"><?php echo $row['drivername']; ?></th>
                         <td><?php echo $row['driveremail']; ?></td>
                         <td><?php echo $row['driverphoneno']; ?></td>
                         <td><?php echo $row['drivervehicleregno']; ?></td>
                         <td><?php echo $row['drivernic']; ?></td> 
                         <td><?php echo $row['driveraddress']; ?></td> 
                         <td><?php echo $row['status']; ?></td>                         
                       </tr>	
                      <?php
                    
                    ?>               
                  </tbody>
                </table>
                <!-- End Default Table Example -->
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

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>