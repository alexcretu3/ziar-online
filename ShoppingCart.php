<?php
require_once "DBController.php";

class ShoppingCart extends DBController
{

    function getAllProduct($query)
    {        
        $productResult = $this->getDBResult($query);
        return $productResult;
    }

    function getMemberCartItem($member_id)
    {
        $query = "SELECT articole.*, articole.id as cart_id FROM articole, tbl_cart WHERE articole.id = tbl_cart.articol_id AND tbl_cart.client_id = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );
        
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }

    function getProductByCode($product_code)
    {
        $query = "SELECT * FROM articole WHERE code=?";
        
        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $product_code
            )
        );
        
        $productResult = $this->getDBResult($query, $params);
        return $productResult;
    }

    function getCartItemByProduct($articol_id, $client_id)
    {
        $query = "SELECT * FROM tbl_cart WHERE articol_id = ? AND client_id = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $articol_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $client_id
            )
        );
        
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }

    function getCartItemsByClient($client_id)
    {
        $query = "SELECT articol_id FROM tbl_cart WHERE client_id = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $client_id
            )
        );
        
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }

    function addToCart($articol_id,$client_id)
    {
        $query = "INSERT INTO tbl_cart (articol_id,client_id) VALUES (?, ?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $articol_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $client_id
            )
        );
        
        $this->updateDB($query, $params);
    }

    function updateCartQuantity($quantity, $cart_id)
    {
        $query = "UPDATE tbl_cart SET  quantity = ? WHERE id= ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );
        
        $this->updateDB($query, $params);
    }

    function deleteCartItem($cart_id)
    {
        $query = "DELETE FROM tbl_cart WHERE id = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );
        
        $this->updateDB($query, $params);
    }

    function deleteCurrentCartItem($client_id, $articol_id)
    {
        $query = "DELETE FROM tbl_cart WHERE client_id = ? and articol_id = ? ";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $client_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $articol_id
            )
        );
        
        $this->updateDB($query, $params);
    }

    function emptyCart($member_id)
    {
        $query = "DELETE FROM tbl_cart WHERE client_id = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );
        
        $this->updateDB($query, $params);
    }
}
