<?php
  session_start(); //start session
  require_once 'Includes/database-complex.php'; //connect to database and initialize query functions
  $db_handle = new DBController(); //new connection

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
