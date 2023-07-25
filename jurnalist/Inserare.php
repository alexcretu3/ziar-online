<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<?php
 include("../Conectare.php");
$error='';
 if (isset($_POST['submit']))
 {
 // preluam datele de pe formular
 $titlu = htmlentities($_POST['titlu'], ENT_QUOTES);
$descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
$categorie = htmlentities($_POST['categorie'], ENT_QUOTES);
$autorid = $_SESSION['id'];
$aprobare = 0;
 // verificam daca sunt completate
if ($titlu == ''||$descriere==''||$categorie=='')
 {
 // daca sunt goale se afiseaza un mesaj
 $error = 'ERROR: Campuri goale!';

 } else {
 // insert
 if ($stmt = $mysqli->prepare("INSERT into articole (titlu,descriere, categorie,autorid,aprobare) VALUES (?, ?, ?,?,?)"))
 {
 $stmt->bind_param("sssii", $titlu, $descriere,$categorie,$autorid,$aprobare);
 $stmt->execute();
$stmt->close();
 }
 // eroare le inserare
 else
 {
 echo "ERROR: Nu se poate executa insert.";
 }

 }
 }

 // se inchide conexiune mysqli
 $mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head> <title><?php echo "Inserare articol"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head> <body>
<h1><?php echo "Inserare articol"; ?></h1>
<?php if ($error != '') {
 echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
		<div>
		<strong>Titlu: </strong> <input type="text" name="titlu" value=""/><br/>
		<strong>Descriere: </strong> <input type="text" name="descriere" value=""/><br/>
		<select name="categorie" id="categorie">
					<option value="artistic">artistic</option>
					<option value="technic">technic</option>
					<option value="science">science</option>
					<option value="moda">moda</option>
					<option value="sport">sport</option>
		</select>
		<input type="hidden" name="autorid" value=""/>
		<input type="hidden" name="aprobare" value=""/>

		<br/>
		<input type="submit" name="submit" value="Submit" />
		<a href="Vizualizare.php">Lista articole</a>
		</div>
</form></body></html>