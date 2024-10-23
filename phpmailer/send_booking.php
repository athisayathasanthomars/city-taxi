<?php
 $r_no=$_GET['id'];
 $connection=new mysqli('localhost','root','','city_taxi');
 $result=mysqli_query($connection,"SELECT * FROM reservation WHERE reservationno='$r_no'");
 $row=mysqli_fetch_assoc($result);
 $passengerid=$row['passengerid'];
 $driverid=$row['driverid'];
 $pickup_point=$row['startplace'];

 $dri_result=mysqli_query($connection,"SELECT * FROM driver WHERE driverid='$driverid'");
 $dri_row=mysqli_fetch_assoc($dri_result);
 $vehicleregno=$dri_row['drivervehicleregno'];
 $phoneno=$dri_row['driverphoneno'];

 $pas_result=mysqli_query($connection,"SELECT * FROM passenger WHERE passengerid='$passengerid'");
 $pas_row=mysqli_fetch_assoc($pas_result);
 $name=$pas_row['passengername'];
 $email=$pas_row['passengeremail'];
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

//Create an instance; passing `true` enables exceptions
if(!$_GET['id']){
    echo "<script> alert('ID not recieved.Unable to delete!!'); </script>";
}
else{
    $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'thomarsthuvaa@gmail.com';   //SMTP write your email
    $mail->Password   = 'wnvjfjotwnzbnofr';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom("thomarsthuvaa@gmail.com","Admin-thomars"); // Sender Email and name
    $mail->addAddress($email);     //Add a recipient email
    $mail->addReplyTo("thomarsthuvaa@gmail.com","Admin-thomars"); // reply to sender email

    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject ="Booking Confirmed:City-Taxi Web-System";   // email subject headings
    $mail->Body = "Dear ".$name.", your confirmed booking details are given below;"."<br><br>";
    $mail->Body .= "DriverID: " . $driverid . "<br>"; // email message
    $mail->Body .= "VehicleNo: " . $vehicleregno . "<br>";
    $mail->Body .= "Pick-up: " . $pickup_point . "<br>";
    $mail->Body .="<br><br>";
    $mail->Body .= "BE IN PICK-UP POINT FOR JOURNEY!!";
    $mail->Body .="<br><br>";
    $mail->Body .="Thank you!!";
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // Success sent message alert
    $mail->send();
    echo "<script>
    alert('Message was sent with login credentials successfully!');
    document.location = '../Operator/index.php';
    </script>";

}
?>
