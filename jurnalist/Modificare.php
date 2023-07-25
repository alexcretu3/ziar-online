<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<?php // connectare bazadedate
 include("../Conectare.php");
//Modificare datelor
// se preia id din pagina vizualizare
$error='';
 if (!empty($_POST['id']))
 { if (isset($_POST['submit']))
 { // verificam daca id-ul din URL este unul valid
	if (is_numeric($_POST['id']))
		{ // preluam variabilele din URL/form
			 $id = $_POST['id'];
			 $titlu = htmlentities($_POST['titlu'], ENT_QUOTES);
			 $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
			 $categorie = htmlentities($_POST['categorie'], ENT_QUOTES);
 // verificam daca numele, prenumele, an si grupa nu sunt goale
	 if ($titlu == ''||$descriere==''||$categorie=='')
		 { // daca sunt goale afisam mesaj de eroare
		 echo "<div> ERROR: Completati campurile obligatorii!</div>";
	 }else 
		{ // daca nu sunt erori se face update  name, code, image, price, descriere, categorie
			if ($stmt = $mysqli->prepare("UPDATE articole SET titlu=?,descriere=?, categorie=? WHERE id='".$id."'"))
			 {
				 $stmt->bind_param("sss", $titlu,$descriere,$categorie);
				 $stmt->execute();
								 $stmt->close();
			  }// mesaj de eroare in caz ca nu se poate face update
			else
				{echo "ERROR: nu se poate executa update.";}
		}
	}
	// daca variabila 'id' nu este valida, afisam mesaj de eroare
	else
	{echo "id incorect!";} }}?>
<html>
<head><title> <?php if ($_GET['id'] != '') { echo "Modificare articol"; }?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>

<body>
<h1><?php if ($_GET['id'] != '') { echo "Modificare articol"; }?></h1>
<?php if ($error != '') {
 echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
	<form action="" method="post">
		 <div>
		 <?php if ($_GET['id'] != '') { ?>
		 <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
		 <p><?php 
		if ($result = $mysqli->query("SELECT * FROM articole where id='".$_GET['id']."'"))
		 {
		if ($result->num_rows > 0)
		{ $row = $result->fetch_object();?></p>
		<strong>Titlu: </strong> <input type="text" name="titlu" value="<?php echo$row->titlu; ?>"/><br/>
		<strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo$row->descriere; ?>"/><br/>
		<strong>Categorie: </strong> 
		
		<select name="categorie" id="categorie">
			<option value="artistic" <?php if ($row->categorie == "artistic") echo "selected"; ?>>artistic</option>
			<option value="technic" <?php if ($row->categorie == "technic") echo "selected"; ?>>technic</option>
			<option value="science" <?php if ($row->categorie == "science") echo "selected"; ?>>science</option>
			<option value="moda" <?php if ($row->categorie == "moda") echo "selected"; ?>>moda</option>
			<option value="sport" <?php if ($row->categorie == "sport") echo "selected"; ?>>sport</option>
		</select>
	<?php }}} ?>
		<br/>
		<br/>
		<input type="submit" name="submit" value="Submit" />
		<a href="Vizualizare.php">Index</a>
		</div>
	</form>
</body>
</html>