<?php
require_once "ShoppingCart.php";
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<?php // connectare bazadedate
include("Conectare.php");
//Modificare datelor
?>
<html>
<head><title> <?php if ($_GET['articol_id'] != '') { echo "Vizualizare articol"; }?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>

<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body>
<h1><?php if ($_GET['articol_id'] != '') { echo "Vizualizare articol"; }?></h1>

	<form method="post" action="cos.php?articol_id=<?php echo $_GET['articol_id']; ?>&client_id=<?php echo $_GET['client_id']; ?>">
		 <div>
		 <?php if ($_GET['articol_id'] != '') { ?>
		 <p><?php 
		if ($result = $mysqli->query("SELECT * FROM articole where id='".$_GET['articol_id']."'"))
		 {
			if ($result->num_rows > 0)
			{ $row = $result->fetch_object();?></p>
			<strong>Titlu: </strong> <p> <?php echo$row->titlu; ?> </p><br/>
			<strong>Descriere: </strong> <p> <?php echo$row->descriere; ?> </p><br/>
			<strong>Categorie: </strong> <p> <?php echo$row->categorie; ?> </p><br/>
		
	<?php }}} ?>
		<br/>
		<br/>
		<input type="submit" name="submit" value="Adauga la cos" class="btnAddAction"/>
		<a href="magazinhome.php">Homepage</a>
		</div>
	</form>
</body>
</html>