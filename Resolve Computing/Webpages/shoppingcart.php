<?php
  session_start(); //start session
  require_once 'Includes/database-complex.php'; //connect to database and initialize query functions
  $db_handle = new DBController(); //new connection
  $page = "shoppingcart";

	if(!empty($_GET["action"])) {
		switch($_GET["action"]) {
			case "remove":
				if(!empty($_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($_GET["code"] == $k)
								unset($_SESSION["cart_item"][$k]);
							if(empty($_SESSION["cart_item"]))
								unset($_SESSION["cart_item"]);
					}
				}
			break;
			case "empty":
				unset($_SESSION["cart_item"]);
			break;
		}
	}
?>

<html>
  <?php include 'Includes/header.php'; ?>

  <body style="background-color:#333;">

    <?php include 'Includes/navbar1.php'; ?>

    <?php include 'Includes/navbar2.php'; ?>

    <div class="function-content">
      <center><i style="color: #0c95ad" class="fa fa-shopping-cart fa-10x"></i></center>
      <div class="function-title"> Shopping Cart </div>
      <center><p> Finished shopping? <a href="checkout.php">Proceed to checkout!</a></p></center>
    </div>

  		<?php
  			if(isset($_SESSION["cart_item"])){ //if a cart item is added initialize these values
  				$total_quantity = 0;
  			  $total_price = 0;
  		?>

      <a class="input-submit" style="left:90vw;" href="<?php echo $page ?>.php?action=empty">Empty Cart</a> <!-- empties cart -->
      
      <?php include 'Includes/cart-data.php'; ?>

  		<?php
  		} else {
  		?>
  			<div class="no-records">Your Cart is Empty</div> <!-- displayed if cart is empty -->
  		<?php
  		}
  		?>
  	</div>
  </body>
</html>
