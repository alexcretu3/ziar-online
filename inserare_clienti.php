<?php
	  include("Conectare.php");
$error='';
 if (isset($_POST['submit']))
 {
	//$client_id = htmlentities($_POST['client_id'], ENT_QUOTES);
	$client_username = htmlentities($_POST['client_username'], ENT_QUOTES);
	$client_pass = htmlentities($_POST['client_pass'], ENT_QUOTES);
	$client_email = htmlentities($_POST['client_email'], ENT_QUOTES);
	$client_str = htmlentities($_POST['client_str'], ENT_QUOTES);
	$client_oras = htmlentities($_POST['client_oras'], ENT_QUOTES);
	$client_tara = htmlentities($_POST['client_tara'], ENT_QUOTES);
	$client_codpost = htmlentities($_POST['client_codpost'], ENT_QUOTES);
	$client_nrcard = htmlentities($_POST['client_nrcard'], ENT_QUOTES);
	$client_tipcard = htmlentities($_POST['client_tipcard'], ENT_QUOTES);
	$client_dataexp=$_POST['client_dataexp'];
$client_dataexp1=date("Y-m-d H:i:s", mktime($_POST['client_dataexp']));
echo $client_dataexp1;
	$acceptareemail = htmlentities($_POST['acceptareemail'], ENT_QUOTES);
	$client_nrinregRC = htmlentities($_POST['client_nrinregRC'], ENT_QUOTES);
	$client_nume = htmlentities($_POST['client_nume'], ENT_QUOTES);
	$cod_fiscal = htmlentities($_POST['cod_fiscal'], ENT_QUOTES);
	
	// verificam daca sunt completate
	if ($client_username == "" || $client_pass=="" || $client_email==""|| $client_str=="" || $client_oras=="" || $client_tara==""|| $client_codpost=="" || $client_nrcard==''||$client_tipcard==''||$client_dataexp1==''||$acceptareemail==''||$client_nrinregRC==''||$client_nume==''||$cod_fiscal=='')
	{
		// daca sunt goale se afiseaza un mesaj
		$error = 'ERROR: Campuri goale!';
	} else {
		// insert


		if ($stmt = $mysqli->prepare("INSERT into clienti (client_username, client_pass, client_email, client_str, client_oras, client_tara, client_codpost, client_nrcard, client_tipcard, client_dataexp, acceptareemail, client_nrinregRC, client_nume, cod_fiscal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"))
	{
			$stmt->bind_param("sssssssissiisi", $client_username, $client_pass, $client_email, $client_str, $client_oras, $client_tara, $client_codpost, $client_nrcard, $client_tipcard, $client_dataexp1, $acceptareemail, $client_nrinregRC, $client_nume, $cod_fiscal);
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
<head> 
	<title><?php echo "Inserare inregistrare"; ?> </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head> 
<body>
	<h1><?php echo "Inserare inregistrare"; ?></h1>
	<?php if ($error != '') {
	echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
	<form action="" method="post">
	<div>
	<strong>Username: </strong> <input type="text" name="client_username"/><br/>
	<strong>Password: </strong> <input type="text" name="client_pass"/><br/>
	<strong>Email: </strong> <input type="text" name="client_email" /><br/>
	<strong>Strada: </strong> <input type="text" name="client_str" /><br/>
	<strong>Oras: </strong> <input type="text" name="client_oras" /><br/>
	<strong>Tara: </strong> <input type="text" name="client_tara" /><br/>
	<strong>Cod postal: </strong> <input type="text" name="client_codpost" /><br/>
	<strong>Nr card: </strong> <input type="text" name="client_nrcard" /><br/>
	<strong>Tip Card: </strong> <input type="text" name="client_tipcard" /><br/>
	<strong>Data exp: </strong> <input type="text" name="client_dataexp" /><br/>
	<strong>Acceptare email: </strong> <input type="text" name="acceptareemail" /><br/>
	<strong>Nr Inreg RC: </strong> <input type="text" name="client_nrinregRC" /><br/>
	<strong>Nume: </strong> <input type="text" name="client_nume" /><br/>
	<strong>Cod Fiscal: </strong> <input type="text" name="cod_fiscal"/><br/>
	<br/>
	<input type="submit" name="submit" value="Submit" />
	<a href="vizualizare_clienti.php">Index</a>
	</div>
	</form>
</body>
</html>