<?php
 $username=$_GET['id'];
 $connection=new mysqli('localhost','root','','city_taxi');
 $result=mysqli_query($connection,"SELECT * FROM user WHERE username='$username'");
 $row=mysqli_fetch_assoc($result);
 $password=$row['password'];
 $usertype=$row['usertype'];
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
    $mail->addAddress($username);     //Add a recipient email
    $mail->addReplyTo("thomarsthuvaa@gmail.com","Admin-thomars"); // reply to sender email

    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject ="Login Details:City-Taxi Web-System";   // email subject headings
    $mail->Body = "Dear ".$usertype.", your login credentials are given below;"."<br><br>";
    $mail->Body .= "Username: " . $username . "<br>"; // email message
    $mail->Body .= "Password: " . $password . "<br>";
    $mail->Body .="<br><br>";
    $mail->Body .= "PLEASE USE THESE LOGIN CREDENTIALS IN http://localhost/city-taxi/"."<br><br>";
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
    document.location = '../Admin/user.php';
    </script>";

}
?>
