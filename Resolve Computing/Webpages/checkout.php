<?php
  session_start(); //start session
  require_once 'Includes/database-complex.php'; //connect to database and initialize query functions
  $db_handle = new DBController(); //new connection
  $page = "checkout";

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

  if(!empty($_GET["option"])) {
		switch($_GET["option"]) {
			case "card":
				if(!empty($_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($_GET["code"] == $k)
								unset($_SESSION["cart_item"][$k]);
							if(empty($_SESSION["cart_item"]))
								unset($_SESSION["cart_item"]);
					}
				}
			break;
			case "direct":
				unset($_SESSION["cart_item"]);
			break;
		}
	}
?>

<script>
  function paymentOption() {
    const radiobtns = document.querySelectorAll('input[name="option"]');

    let selectedValue;
    for (const radiobtn of radiobtns) {
        if (radiobtn.checked) {
            selectedValue = radiobtn.value;
            break;
        }
    }

    if (selectedValue == "card")
    {
      document.getElementById("card-form").style.display="block";
      document.getElementById("direct-form").style.display="none";
    } else {
      document.getElementById("direct-form").style.display="block";
      document.getElementById("card-form").style.display="none";
    }
  }
</script>

<html>
  <?php include 'Includes/header.php'; ?>
  <script src="Scripts/jquery.min.js" type="text/javascript"></script> <!-- javascript file -->
  <script src="Scripts/jquery-ui.js"></script>  <!-- javascript file -->

  <body style="background-color:#333;" onload="checkoutFunction()">

    <?php include 'Includes/navbar1.php'; ?>

    <?php include 'Includes/navbar2.php'; ?>

    <div class="function-content">
      <center><i style="color: #0c95ad" class="fa fa-credit-card fa-10x"></i></center>
      <div class="function-title"> Checkout </div>
      <center><p> Login before checking out <a href="login.php">Back to Login!</a></p></center>

      <?php
  			if(isset($_SESSION['sessionId'])) { //if logged in
  		?>
          <center><div class="payment-plan-div">
            <h3 class="sub-header-margin">Payment Plan</h3>
            <input class="bank-transfer" type="radio" checked="checked" value="card" id="card" name="option"> Credit or Debit Card</br>
            <input class="bank-transfer" type="radio" id="direct" value="direct" name="option"> Direct Bank Transfer
            <center><input class="input-submit" style="width: 135px;" name="option" type="button" value="Confirm Option" onclick="paymentOption()" /></center>

          </br></br><div>If direct bank transfer is chosen specify your order number when you make
              the bank transfer. Your order will be shippied after the amount
              is credited to us.
            </div>
          </div></center>

          <?php
            if(isset($_POST['direct-checkout'])) {
              $_SESSION["orderNumber"] = rand(50, 350);

              require_once 'Includes/database.php';

              $stmt = $conn->prepare("UPDATE users SET ordernum = ? WHERE id = ?");
              mysqli_stmt_bind_param($stmt, "ss", $_SESSION["orderNumber"], $_SESSION['sessionId']);
              mysqli_stmt_execute($stmt);

              $checkoutType = "direct";
              unset($_SESSION["cart_item"]);
            }

            if(isset($_POST['card-checkout'])) {
              $checkoutType = "card";
              unset($_SESSION["cart_item"]);
            }
          ?>  <!-- if a successful checkout was done -->

          <form id="direct-form" name="direct-form" action="checkout.php" method="post">  <!-- name,id and form function -->

            <center><h3 class="sub-header-margin">Direct Bank Transfer - Billing Details</h3></center>

            <center><input class="input-box" type="text" name="fullname" placeholder="Full Name e.g. John M. Doe" id="name" required></center>

            <center><input class="input-box" type="text" name="email" placeholder="E-mail" id="email" title="Valid email only" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required></center>

            <center><input class="input-box" type="text" name="address" placeholder="Address" id="address" required></center>

            <center><input class="input-box" type="text" name="city" placeholder="City" id="city" required></center>

            <center><input class="input-box" type="text" name="state" placeholder="State" id="state" required></center>

            <center><input class="input-box" type="text" name="zipcode" placeholder="Zipcode" id="zipcode" required></center>

            <?php
        			if(isset($_SESSION["cart_item"])){ //if a cart item is added initialize these values
        				$total_quantity = 0;
        			  $total_price = 0;
        		?>

                <div style="height: 5vw;"><center><input class="input-submit" type="submit" class="checkout" name="direct-checkout" id="checkout" value="Checkout"></center>
                </div>

                <div style="margin-top:2vw;"><?php include 'Includes/cart-data.php'; ?></div>

        		<?php
        		} else {
        		?>
        			<center><h3>Your Cart is Empty</h3></center> <!-- displayed if cart is empty -->
        		<?php
        		}
        		?>
    		</form>

        <form id="card-form" name="checkout-form" action="" method="post" onsubmit="checkout()">  <!-- name,id and form function -->

          <center><h3 class="sub-header-margin">Credit/Debit Card - Billing Details</h3></center>

          <center><input class="input-box" type="text" name="fullname" placeholder="Full Name e.g. John M. Doe" id="name" required></center>

          <center><input class="input-box" type="text" name="email" placeholder="E-mail" id="email" title="Valid email only" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required></center>

          <center><input class="input-box" type="text" name="address" placeholder="Address" id="address" required></center>

          <center><input class="input-box" type="text" name="city" placeholder="City" id="city" required></center>

          <center><input class="input-box" type="text" name="state" placeholder="State" id="state" required></center>

          <center><input class="input-box" type="text" name="zipcode" placeholder="Zipcode" id="zipcode" required></center>

          <center><h3 class="sub-header-margin">Payment Details</h3></center>

          <center><label>Accepted Cards</label></center>

          <center><div class="icon-container">
            <i class="fab fa-cc-visa" style="color:navy;"></i>
            <i class="fab fa-cc-mastercard" style="color:red;"></i>
            <i class="fab fa-cc-discover" style="color:orange;"></i>
          </div><center>

          <center><input class="input-box" type="text" name="cardname" placeholder="Name on Card e.g. John More Doe" id="name" required></center>

          <center><input class="input-box" type="text" name="cardnumber" placeholder="Card Number e.g. 1111-2222-3333-4444" id="cardnumber" required></center>

          <center><input class="input-box" type="text" name="expmonth" placeholder="Expiry Month e.g. September" id="expmonth" required></center>

          <center><input class="input-box" type="text" name="expyear" placeholder="Expiry Year" id="expyear" required></center>

          <center><input class="input-box" type="text" name="cvv" placeholder="CVV e.g. 352" id="cvv" required></center>

          <?php
            if(isset($_SESSION["cart_item"])){ //if a cart item is added initialize these values
              $total_quantity = 0;
              $total_price = 0;
          ?>

          <div style="height: 5vw;"><center><input class="input-submit" type="submit" class="checkout" name="card-checkout" id="checkout" value="Checkout"></center>
          </div>

          <div style="margin-top:2vw;"><?php include 'Includes/cart-data.php'; ?></div>

          <?php
          } else {
          ?>
            <center><h3>Your Cart is Empty</h3></center> <!-- displayed if cart is empty -->
          <?php
          }
          ?>
      </form>

  		<?php
  		} else {
  		?>
  			<div class="no-records">You are not Logged in</div> <!-- displayed if cart is empty -->
  		<?php
  		}
  		?>

      <script src="Scripts/cart.js"></script> <!-- Javascrpt file  -->
      <script>
        function checkoutFunction() {
          var javaCheckoutType = <?php echo json_encode($checkoutType); ?>

          if(javaCheckoutType=="direct") {
            alert("Your order number is <?php echo $_SESSION["orderNumber"];?>.");
          } else if(javaCheckoutType=="card") {
            alert("Your information has been processed, check email for purchase approval.");
          }
        }
      </script>
  </body>
</html>
