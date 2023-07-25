<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<?php session_start(); ?>

<html>
<head>
<title>Vizualizare articole</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Lista articole</h1>
<a href="../logoutadmin.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
<?php

// connectare bazadedate
 include("../Conectare.php");
 $autorid = $_SESSION['id'];
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM articole ORDER BY id "))
{ // Afisare inregistrari pe ecran
if ($result->num_rows > 0)
{
// afisarea inregistrarilor intr-o table
echo "<table border='1' cellpadding='10'>";
// antetul tabelului
echo "<tr><th>ID</th><th>Titlu</th><th>Aprobat</th><th>Descriere</th><th>Categorie</th><th>Id jurnalist</th><th></th></tr>";
while ($row = $result->fetch_object())
{
// definirea unei linii pt fiecare inregistrare

if( $row->aprobare == 0 ){ 
    $aprob = "Nu";
    $aprob_text = "Aproba";
} else { 
    $aprob = "Da";
    $aprob_text = "Dezaproba";
}
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->titlu . "</td>";
echo "<td>" . $aprob . "</td>";
echo "<td>" . $row->descriere . "</td>";
echo "<td>" . $row->categorie . "</td>";
echo "<td>" . $row->autorid . "</td>";
echo "<td><a href='aproba_dezaproba.php?aprobare=" . $row->aprobare . "&id=" . $row->id . "'>".$aprob_text."</a></td>";
echo "</tr>";
}
echo "</table>";
}
// daca nu sunt inregistrari se afiseaza un rezultat de eroare
else
{
echo "Nu sunt articole in tabela!";
}
}
// eroare in caz de insucces in interogare
else
{ echo "Error: " . $mysqli->error(); }
// se inchide
$mysqli->close();
?>
</body>
</html>