<?php
include 'includes/session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['signup'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$contact_info = $_POST['contact_info'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];

	$_SESSION['firstname'] = $firstname;
	$_SESSION['lastname'] = $lastname;
	$_SESSION['email'] = $email;

	if ($password != $repassword) {
		$_SESSION['error'] = 'Passwords did not match';
		header('location: signup.php');
		exit();
	}

	$conn = $pdo->open();

	try {
		$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
		$stmt->execute(['email' => $email]);
		$row = $stmt->fetch();

		if ($row['numrows'] > 0) {
			$_SESSION['error'] = 'Email already taken';
			header('location: signup.php');
			exit();
		}

		$now = date('Y-m-d');

		$stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, contact_info, created_on) VALUES (:email, :password, :firstname, :lastname, :contact_info, :now)");
		$stmt->execute(['email' => $email, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'contact_info' => $contact_info, 'now' => $now]);
		$userid = $conn->lastInsertId();

		$message = "
            <h2>Thank you for Registering.</h2>
            <p>Your Account:</p>
            <p>Email: $email</p>
            <p>Password: $password</p>
            <p>Contact Info: $contact_info</p>
            <p>Your account is now registered.</p>
        ";

		// Load PHPMailer
		require 'vendor/autoload.php';

		$mail = new PHPMailer(true);

		// Server settings
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'your_email@gmail.com'; // Your email address
		$mail->Password = 'your_password'; // Your email password
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;

		$mail->setFrom('your_email@gmail.com', 'Your Name');
		$mail->addAddress($email);
		$mail->isHTML(true);
		$mail->Subject = 'Registration Confirmation';
		$mail->Body = $message;

		$mail->send();

		unset($_SESSION['firstname']);
		unset($_SESSION['lastname']);
		unset($_SESSION['email']);

		$_SESSION['success'] = 'Account created. Check your email for confirmation.';
		header('location: signup.php');
		exit();
	} catch (Exception $e) {
		$_SESSION['error'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
		header('location: signup.php');
		exit();
	}
} else {
	$_SESSION['error'] = 'Fill up the signup form first';
	header('location: signup.php');
	exit();
}
