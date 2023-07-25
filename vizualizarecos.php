<?php
require_once "ShoppingCart.php";
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pagina Home</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Cos</h1>
			</div>
		</nav>
            <h2>Toate articolele din cos</h2>
            <a href="magazinhome.php">Homepage</a>
		<div id="product-grid">
        
    <?php
    $shoppingCart = new ShoppingCart();
    $product_array = $shoppingCart->getCartItemsByClient($_SESSION['id']);
    $product_array_ids = array();
   
    if (!empty($product_array)) {

        foreach ($product_array as $key => $value) {
            array_push($product_array_ids, $product_array[$key]["articol_id"]);
        }
    }
    $product_array = join("','",$product_array_ids);       
    $query = "SELECT * FROM articole WHERE id in ('$product_array')";
    $product_array = $shoppingCart->getAllProduct($query);
    
    if (!empty($product_array)) {

        foreach ($product_array as $key => $value) {  ?>
            
                <div class="product-item">
                    <form method="post" action="cos.php?action=remove&articol_id=<?php echo $product_array[$key]["id"]; ?>&client_id=<?php echo $_SESSION['id']; ?>">
                        <div>
                            <a href='Visualizare.php?articol_id=<?php echo $product_array[$key]["id"]; ?>&client_id=<?php echo $_SESSION['id']; ?>'><strong><?php echo $product_array[$key]["titlu"]; ?></strong></a>
                        </div>
                        <div class="product-price"><?php echo $product_array[$key]["categorie"]; ?></div>
                        <div>
                            <input type="submit" value="Sterge din cos"  class="btnAddAction" />
                        </div>
                    </form>
                </div>
                    
            <?php
            
        }
    }    
    ?>
</div>
	</body>
</html>