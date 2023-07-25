<?php
// conectare la baza de date database
include("../Conectare.php");
// se verifica daca id a fost primit
if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['aprobare']))
{
    // preluam variabila 'id' din URL
    $id = $_GET['id'];
    $aprobare = $_GET['aprobare'];

    if( $aprobare == 0 ){ 
        $aprobare = 1;
        $aprob_text = "aprobat";
    } else{ 
        $aprobare = 0;
        $aprob_text = "deaprobat";
    }

    if ($stmt = $mysqli->prepare("UPDATE articole SET aprobare = ".$aprobare." WHERE id = ?"))
    {
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }
    else
    {
    echo "ERROR: Nu se poate aproba.";
    }
    $mysqli->close();
    echo "<div>Articolul a fost ".$aprob_text."!!!!</div>";
}
echo "<p><a href=\"Vizualizare.php\">Lista articole</a></p>";
?>
