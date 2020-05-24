<?php
	require_once('model/product-class.php');
	function getItemDetails($itemName){
		try{
			@ $db = new mysqli('127.0.0.1:3306','krimhajefcee', 'incorrect', 'awr_database');
	   		$dbError = mysqli_connect_errno();
		    if($dbError){
		      	throw new Exception("DB CONNECTION ERROR");
		    }else{
		        $selectQuery =
						'SELECT
							products.id as prod_id, img_dir, name, colors.color, prices.price, categories.category
						FROM products
							INNER JOIN colors
								ON colors.id = products.color_id
							INNER JOIN prices
								ON prices.id = products.price_id
							INNER JOIN categories
								ON categories.id = products.category_id
									WHERE name = "'.$itemName.'"';

		        $resultLogo = $db->query($selectQuery);
		        $dir = $resultLogo->fetch_assoc();


						$product = new Product();

						$product->setProduct($dir['prod_id'], $dir['name'], $dir['img_dir'], $dir['price'], $dir['color'], $dir['category']);

						$itemPrice = $product->__get('productPrice');

						?>
							<script>
								sessionStorage.setItem("price", <?php echo $itemPrice; ?>);
							</script>
						<?php

		        echo '<div class="products">';
 							echo '<div class="row">';
								echo '<div class="item-img col-6">';
									echo '<img class="item-view-img" src="'.$product->__get('productImgUrl').'">';
								echo '</div>';

								echo '<div class="col-5">';
								 	echo '<form action="add-to-cart.php" method="POST">';
										echo '<div class="form-group">';
											echo '<input class="uneditable" name="name" size="20" type="text" value="'.$product->__get('productName').'" readonly><br>';
											echo '<input class="uneditable" name="color" size="20" type="text" value="'.$product->__get('productColor').'" readonly><br>';
											echo '<input onchange="computePrice()" id="qty" class="uneditable" name="qty" size="29" type="number" value="1" min=1 ><br>';

											echo '<input id="price" class="uneditable" name="color" size="20" type="text" value="'.$itemPrice.'" readonly><br>';
										echo '</div>';

										$selectCurrent = 'SELECT user_id FROM currentuser';
										$resultCurrent = $db->query($selectCurrent);
										$cnt = $resultCurrent->num_rows;

										echo '<div class="form-group">';
											if($cnt == 0){
												echo '<input type="submit" class="add-to-cart" value="ADD TO CART" disabled>';
											} else {
												echo '<input type="submit" class="add-to-cart" value="ADD TO CART">';
											}
										echo '</div>';
									echo '</form >';
								echo '</div>';
							echo '</div>';
						echo '</div>';
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
?>