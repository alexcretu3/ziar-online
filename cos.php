<?php
require_once "ShoppingCart.php";
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<?php
 include("Conectare.php");
 if (isset($_GET['articol_id']) && isset($_GET['client_id']))
 {


		// preluam datele de pe formular
		
		$shoppingCart = new ShoppingCart();       

		$articol_id = htmlentities($_GET['articol_id'], ENT_QUOTES);
		$client_id = htmlentities($_GET['client_id'], ENT_QUOTES);	

		if (isset($_GET['action']) && $_GET['action'] == 'remove')
		{
			$check_cart = $shoppingCart->deleteCurrentCartItem($client_id, $articol_id);
			print_r($check_cart);
			echo "Articol scos din cos!";

		} else {

	
				// verificam daca sunt completate
				if ($articol_id==''||$client_id=='')
				{
					// daca sunt goale se afiseaza un mesaj
					$error = 'ERROR: Campuri goale!';
				} else {

					$check_cart = $shoppingCart->getCartItemByProduct($articol_id, $client_id);
					if (empty($check_cart)) {
						$add_tocart = $shoppingCart->addToCart($articol_id,$client_id);
						echo "Articol adaugat in cos!";
					}else echo "Articol exista deja in cos!";
				}

		}	
 } 
 else echo 'ERROR: Campuri goale!';

 // se inchide conexiune mysqli
 $mysqli->close();
?>


<a href="magazinhome.php">Homepage</a>
