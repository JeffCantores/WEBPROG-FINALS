<?php
  function addToCart($qty,$price, $productName){
    try {
      @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
	   		$dbError = mysqli_connect_errno();
		    if($dbError){
		      	throw new Exception("DB CONNECTION ERROR");
		    }else{
          $selectProdID = 'SELECT products.id as prodID FROM products WHERE name = "'.$productName.'"';
          $resultProdID = $db->query($selectProdID);
          $prodID = $resultProdID->fetch_assoc();

          if($prodID){
            $selectUserID = 'SELECT users.id as userID FROM users WHERE username = "'.$_SESSION['username'].'"';
            $resultUserID = $db->query($selectUserID);
            $userID = $resultUserID->fetch_assoc();

            if($userID){

              $selectProdID;
              $cart_item = 'SELECT * from cart WHERE product_id = '.$prodID['prodID'];
              $count = $cart_item->num_rows();
              if ($count>0) {
                throw new Exception("Item already in Cart");
              }else {
                $insertToCart = 'INSERT INTO cart (qty, price, product_id, user_id, isCheckedOut) VALUES (?,?,?,?,?)';
                $stmt = $db->prepare($insertToCart);
                $stmt->bind_param('iiiii', $qty, $price, $prodID['prodID'], $userID['userID'], 0);
                $stmt->execute();

                if(!$stmt){
                  throw new Exception("EXCEPTION INSERT");
                } else {
                  $_SESSION['addtocart'] = 'TRUE';
                }
              }
            } else {
              throw new Exception("EXCEPTION USERID");
            }
          } else {
            throw new Exception("EXCEPTION PRODID");
          }
        }
    } catch (Exception $e) {
      echo $e->getMessage();
    }

  }
?>

<?php
  function addToCart($qty,$price, $productName){
    try {
      @ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
	   		$dbError = mysqli_connect_errno();
		    if($dbError){
		      	throw new Exception("DB CONNECTION ERROR");
		    }else{
          $selectProdID = 'SELECT products.id as prodID FROM products WHERE name = "'.$productName.'"';
          $resultProdID = $db->query($selectProdID);
          $prodID = $resultProdID->fetch_assoc();

          if($prodID){
            $selectUserID = 'SELECT users.id as userID FROM users WHERE username = "'.$_SESSION['username'].'"';
            $resultUserID = $db->query($selectUserID);
            $userID = $resultUserID->fetch_assoc();

          if($userID){
              $selectProdID;
              $cart_item = 'SELECT * from cart WHERE product_id = '.$prodID['prodID'];
              $count = $cart_item->num_rows();
              if ($count>0) {
                throw new Exception("Item already in Cart");
              }else {
                $insertToCart = 'INSERT INTO cart (qty, price, product_id, user_id, isCheckedOut) VALUES (?,?,?,?,?)';
                $stmt = $db->prepare($insertToCart);
                $stmt->bind_param('iiiii', $qty, $price, $prodID['prodID'], $userID['userID'], 0);
                $stmt->execute();

                if(!$stmt){
                  throw new Exception("EXCEPTION INSERT");
                } else {
                  $_SESSION['addtocart'] = 'TRUE';
                }
              }
            } else {
              throw new Exception("EXCEPTION USERID");
            }
          } else {
            throw new Exception("EXCEPTION PRODID");
          }
        }
    } catch (Exception $e) {
      echo $e->getMessage();
    }

  }
?>
