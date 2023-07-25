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
				<h1>ProZiar National</h1>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<p>Salutare bine te-ai intors, <?php echo $_SESSION['name'];?>!</p>
		</div>
            <h2>Toate articolele</h2>
            <a href="vizualizarecos.php"><i class="fas fa-shopping-cart"></i>Vizualizare cos</a>
		<div id="product-grid">
        
    <?php
    $shoppingCart = new ShoppingCart();
    $query = "SELECT * FROM articole WHERE aprobare = 1";
    $product_array = $shoppingCart->getAllProduct($query);
    $cat_array = array();
    if (!empty($product_array)) {
        foreach ($product_array as $key => $value) { 
            array_push($cat_array, $product_array[$key]["categorie"]);
        }
    }

    $cat_array_unique = array_unique($cat_array,SORT_STRING);
    
    if (!empty($cat_array_unique)) {
        foreach ($cat_array_unique as $category_name) { 
            
            ?></br></br>
                   <div class="txt-heading">
                            <div class="txt-heading-label"><?php  echo $category_name;   ?></div>
                     </div>
            <?php
            $query = "SELECT * FROM articole WHERE aprobare = 1 AND categorie ='".$category_name."'";
            $product_array = $shoppingCart->getAllProduct($query);
            foreach ($product_array as $key => $value) {  ?>
                <div class="product-item">
                    <form method="post" action="cos.php?articol_id=<?php echo $product_array[$key]["id"]; ?>&client_id=<?php echo $_SESSION['id']; ?>">
                        <div>
                            <a href='Visualizare.php?articol_id=<?php echo $product_array[$key]["id"]; ?>&client_id=<?php echo $_SESSION['id']; ?>'><strong><?php echo $product_array[$key]["titlu"]; ?></strong></a>
                        </div>
                        <div class="product-price"><?php echo $product_array[$key]["categorie"]; ?></div>
                        <div>
                            <input type="submit" value="Adauga la cos"  class="btnAddAction" />
                        </div>
                    </form>
                </div>
                    
            <?php
            }
        }
    }    
    ?>
</div>
	</body>
</html>