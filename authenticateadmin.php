<?php
session_start();
// Conectare la MySQL
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = "";
$DATABASE_NAME = 'ziar';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	
	exit('Conectare esuata la MySQL: ' . mysqli_connect_error());
}


if ( !isset($_POST['username'], $_POST['password']) ) {
	
	exit('Completati ambele campuri username si password !');
}

if ($stmt = $con->prepare('SELECT id, password,tip FROM utilizatori_admin WHERE username = ?')) {
	
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	
	$stmt->store_result();

if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $password, $tip);
			$stmt->fetch();
			
			if (password_verify($_POST['password'], $password)) {
						session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['name'] = $_POST['username'];
				$_SESSION['id'] = $id;
				$_SESSION['tip'] = $tip;
				echo 'Welcome ' . $_SESSION['name'] . '!';
				header('Location: '.$_SESSION['tip'].'/Vizualizare.php');
			} else {
				
				
			echo 'Username si/sau password incorect 1!';
			}
} else {
	echo 'Username si/sau password incorect 2!';
}
	$stmt->close();
}
?>