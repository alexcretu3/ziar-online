<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = "";
$DATABASE_NAME = 'ziar';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	
	exit('Conectare esuata la MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['tip'])) {
	
	exit('Completati formular!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['tip'])) {
	
	exit('Completati formular!');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Email nu este valid!');
}
if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
    exit('Username nu este valid!');
}
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	exit('Password trebuie sa fie intre 5 si 20 charactere!');
}

if ($stmt = $con->prepare('SELECT id, password FROM utilizatori_admin WHERE username = ?')) {
	
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Username exista deja, se alege altul!';
	} else {
		if ($stmt = $con->prepare('INSERT INTO utilizatori_admin (username, password, email, tip) VALUES (?, ?, ?, ?)')) {
	
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $_POST['tip']);
			$stmt->execute();
			echo 'Va puteti loga!';
			header('Location: adminlogin.html');
		} else {
			
			echo 'Nu se poate face prepare statement 1!';
		}
	}
	$stmt->close();
} else {
	
	echo 'Nu se poate face prepare statement 2!';
}
$con->close();
?>