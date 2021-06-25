<?php
  session_start();

  if(isset($_SESSION['sessionId'])) {
    $alertStatus = "loggedin";
  }

  if(!empty($_GET["logout"])) {
		if($_GET["logout"]== true && isset($_SESSION['sessionId'])) {
      session_destroy();
      $alertStatus = "loggedout";
		}

    if($_GET["logout"]== true && !(isset($_SESSION['sessionId']))) {
      session_destroy();
      $alertStatus = "notloggedin";
		}
	}
?>

<html>
  <title>Resolve Computing</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Webpages/ReComputingSS.css?v=1.0">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.14.0/css/all.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:400,700'>

  <body onload="alertFunction()">
    <div class="navbar">
      <a href="index.php" class="re-bar-item re-button"><i class="fa fa-home"></i> HOME</a>
      <a href="Webpages/products.php" class="re-bar-item re-button"><i class="fa fa-box-open"></i> PRODUCTS</a>
      <a href="Webpages/services.php" class="re-bar-item re-button"><i class="fa fa-handshake"></i> SERVICES</a>
      <a href="Webpages/search.php" class="re-bar-item re-button re-hover-green"><i class="fa fa-search"></i></a> <!--needed-->
    </div>

    <div class="navbar">
      <a href="Webpages/login.php" class="re-bar-item re-button"><i class="fa fa-sign-in"></i> LOGIN</a>
      <a href="Webpages/register.php" class="re-bar-item re-button"><i class="fa fa-user-plus"></i> REGISTER</a>
      <a href="Webpages/wishlist.php" class="re-bar-item re-button"><i class="fa fa-list"></i> WISHLIST</a>
      <a href="Webpages/shoppingcart.php" class="re-bar-item re-button"><i class="fa fa-shopping-cart"></i> SHOPPING CART</a>
      <a href="Webpages/checkout.php" class="re-bar-item re-button"><i class="fa fa-credit-card"></i> CHECKOUT</a>
      <a href="index.php?logout=true" class="re-bar-item re-button"><i class="fa fa-sign-out"></i> LOGOUT</a> <!--needed-->
    </div>

    <center><div style="background-color:#333">
      <a href="index.php"><img id="main-banner" src="Images/recomputingbanner.png"></a>
    </div></center>

    <div class="container">
      <a href="Webpages/products.php">
        <video id="products-video" class="main-video" autoplay="autoplay" loop="loop">
          <source src="Videos/products.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </a>
      <a href="Webpages/services.php">
        <video id="services-video" class="main-video" autoplay="autoplay" loop="loop">
          <source src="Videos/services.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </a>
      <div class="products-text1">Products</div>
      <div class="products-text2">The best computers and parts that Jamaica has to offer.</div>
      <div class="products-text3">Parts range from essentials like mouses and keyboards to more technical parts like cpus and gpus. </div>

      <div class="services-text1">Services</div>
      <div class="services-text2">Skilled and customer-friendly professionals ready to help.</div>
      <div class="services-text3">Services offered include repairs, performance-tuning, cleaning and custom computer building. </div>
    </div>

    <div style="background-color:#333" id="about-page">
      <b><p style="padding-top:15px">What is Resolve Computing?</p></b>
      <p>Resolve Computing is Jamaica’s best, one-stop shop for all the state of the art Computers and parts. We offer
      convenient package delivery or just pick up your order at one of our branches. Not interested in getting a new rig or
      upgrade? Maybe you might be interested in getting your current setup fine-tuned or repaired.  Book an appointment to speak with one of our professionals.</p>
      <b><p style="padding-top:15px">Common Question:</p></b>
      <p>Do I have to make an order before time or book an appointment?</p>
      <p style="padding-top:15px">No! Just visit one of our branches and one of our professionals will assist you!</p>
      <i><p style="padding-top:15px">We offer many options for your convenience!</p></i>

      <div class="bottom-navbar">
        <a> Find us on: </a>
        <a href="" class="re-bar-item re-button"><i class="fab fa-instagram"></i></a>
        <a href="" class="re-bar-item re-button"><i class="fab fa-twitter"></i></a>
        <a href="" class="re-bar-item re-button"><i class="fab fa-facebook-square"></i></a>
      </div>
    </div>

    <script>
      function alertFunction() {
        var javaAlertStatus = <?php echo json_encode($alertStatus); ?>

        if(javaAlertStatus=="loggedin") {
          alert("You were logged in");
        } else if(javaAlertStatus=="loggedout") {
          alert("You were logged out");
        } else if(javaAlertStatus=="notloggedin") {
          alert("You were not logged in");
        }
      }
    </script>
  </body>
</html>
