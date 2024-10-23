<?php
session_start();
$connection=new mysqli('localhost','root','','city_taxi');
//get user profile detail 
$id_value=$_SESSION['passengerid'];
$name_result=mysqli_query($connection,"SELECT * FROM passenger WHERE passengerid='$id_value'");
$name_row=mysqli_fetch_assoc($name_result);
$profile_name=$name_row['passengername'];

$reservationno=mysqli_query($connection,"SELECT reservationno FROM reservation WHERE passengerid='$id_value'");
$driverid=mysqli_query($connection,"SELECT driverid FROM reservation WHERE passengerid='$id_value'");

//code for genarate id for rating
$sql = "SELECT ratingid FROM experiencerating ORDER BY ratingid DESC LIMIT 1";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row["ratingid"];
    $last_id_number = substr($last_id, 1); // Extract the numeric part of the last ID
    $new_id_number = str_pad($last_id_number + 1, strlen($last_id_number), '0', STR_PAD_LEFT); // Increment the numeric part and pad with zeros
    $new_rateid = 'R' . $new_id_number; // Concatenate 'P' with the new numeric part
} else {
    // If no records exist, start from P01
    $new_rateid = 'R01';
}

//code for insert rating details of the passenger
if(isset($_POST['submit'])){
  if(empty($_POST['ratingid']) || empty($_POST['reservationno']) || empty($_POST['driverid']) || empty($_POST['rate'])){
      echo "<script> alert('Provide all the details!!'); </script>";        
  }
  else{
    $ratingid=$_POST['ratingid'];
    $reservationno=$_POST['reservationno'];
    $driverid=$_POST['driverid'];
    $rate=$_POST['rate'];
    
    //code starts for inserting rating record 
    $rating_query="INSERT INTO experiencerating(ratingid,reservationid,driverid,rate) VALUES('$ratingid','$reservationno','$driverid','$rate')";
    mysqli_query($connection,$rating_query);
    echo "<script> alert('Rating successful!'); </script>";      
    
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Rate Driver</title>
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
              <span>Passenger</span>
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
          <i class="bi bi-card-list"></i>
          <span>Reservation</span>
        </a>
      </li><!-- End Register Page Nav -->

           <li class="nav-item">
        <a class="nav-link collapsed" href="payment.php">
          <i class="bi bi-credit-card-fill"></i>
          <span>Payment</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="driver.php">
          <i class="bi bi-person-circle"></i>
          <span>Driver</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link" href="ratedriver.php">
          <i class="bi bi-person"></i>
          <span>Rate Driver</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pickuplocation.php">
          <i class="bi bi-map"></i>
          <span>Pickup Location</span>
        </a>
      </li><!-- End Register Page Nav -->

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
                <h5 class="card-title">Rate Driver</h5>
  
                <!-- Vertical Form -->
                <form class="row g-3" action="" method="POST">

                  <div class="col-6">
                    <label for="inputNanme1" class="form-label">RatingID</label>
                    <input name="ratingid" type="text" class="form-control" id="inputNanme1" value="<?php echo $new_rateid; ?>" readonly>
                  </div>

                  <div class="col-6">
                    <label for="inputState" class="form-label">Reservation No</label>
                    <select class="form-control" name="reservationno" id="doc-type">
                      <option value="">-Select Relavent ID-</option>
                      <?php
                        while($row=mysqli_fetch_array($reservationno))
                        {
                         ?>                                         
                            <option value="<?php echo $row['reservationno']; ?>"><?php echo $row['reservationno']; ?></option>
                         <?php
                        }
                      ?>
                    </select>
                  </div>

                  <div class="col-6">
                    <label for="inputState" class="form-label">Driver ID</label>
                    <select class="form-control" name="driverid" id="doc-type">
                      <option value="">-Select Relavent ID-</option>
                      <?php
                        while($row=mysqli_fetch_array($driverid))
                        {
                         ?>                                         
                            <option value="<?php echo $row['driverid']; ?>"><?php echo $row['driverid']; ?></option>
                         <?php
                        }
                      ?>
                    </select>
                  </div>

                  <div class="col-6">
                    <label for="inputState" class="form-label">Rate</label>
                    <select name="rate" id="inputState" class="form-select">
                      <option selected>- Select Your Rate -</option>
                      <option>Excellent</option>
                      <option>Good</option>
                      <option>Average</option>
                      <option>Bad</option>
                    </select>
                  </div>
                  
                  <div class="text-Left">
                    <button name="submit" type="submit" class="btn btn-primary">Rate</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
                </form><!-- Vertical Form -->
  
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Rate Driver Details</h5>
  
                <!-- Default Table -->
                <table class="table">
                  <thead>
                    <tr>
                      
                      <th scope="col">Driver ID</th>
                      <th scope="col">Rate</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $table_result=mysqli_query($connection,"SELECT * FROM experiencerating");  //input table name and id of passenger to retrive respective passenger booking details
                    while($row=mysqli_fetch_array($table_result))
                    {
                     ?>
                       <tr>
                         <th scope="row"><?php echo $row['driverid']; ?></th>
                         <td><?php echo $row['rate']; ?></td>                                                  
                       </tr>	
                      <?php
                    }
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