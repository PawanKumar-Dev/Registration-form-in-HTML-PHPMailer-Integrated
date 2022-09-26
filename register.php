<?php
session_start();
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'connection.php';

function sanitize($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['signup'])) {
  
  $name = sanitize($_POST['name']);
  $email = sanitize($_POST['email']);
  $password = sanitize($_POST['password']);

  $name = mysqli_real_escape_string($conn, $name);
  $email = mysqli_real_escape_string($conn, $email);
  $password = mysqli_real_escape_string($conn, $password);

  $hashedPass = md5($password); // Encrypting our password
  $active = 0; // We insert active as zero by default so that we can manage to activate our use later on

  $token = bin2hex(random_bytes(15)); // Generating a token id

  $sql = "insert into users (name, email, password, token, active) values('$name', '$email', '$hashedPass', '$token' ,'$active')";

  if (mysqli_query($conn, $sql)) {
    
    // Don't forget to update url. I am using localhost but you must use your own
    $body = "Hi $name, click on this link to activate account http://localhost/registration-form/activate.php?token=" . $token;

    $mail = new PHPMailer();

    try {
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com;';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'your@gmail.com';   // Enter your gmail-id              
      $mail->Password   = 'your app password';     // Enter your gmail app password that you generated 
      $mail->SMTPSecure = 'tls';
      $mail->Port       = 587;

      $mail->setFrom('your@gmail.com', 'BeProblemSolver'); // This mail-id will be same as your gmail-id
      $mail->addAddress($email, $name);      // Enter your reciever email-id

      $mail->isHTML(true);
      $mail->Subject = 'Activation Email';      // You email subject line
      $mail->Body    = $body;   // Body of email here
      $mail->send();

      $_SESSION['errors'] = "Signup Successful. Plz Check your email id for activation!";
      header('Location: http://localhost/registration-form/index.php');
      exit;
    } catch (Exception $e) {

      $_SESSION['errors'] = "Email sending failed!";
      header('Location: http://localhost/registration-form/signup.php');
      exit;
    }
  }
}