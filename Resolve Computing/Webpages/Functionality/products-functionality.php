<?php
  session_start(); //start session
  require_once("Includes/database-complex.php"); //connect to database and initialize query functions
  $db_handle = new DBController(); //new connection
  if(isset($_POST['cart'])) { //if submit action is not empty do one of these
    if(!empty($_POST["quantity"])) { //if the quantity is greater than 0
      $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE code='" . $_GET["code"] . "'"); //query all products
      $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));

      if(!empty($_SESSION["cart_item"])) { //if cart item is not empty
        if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) { //and if session cart item is in array
          foreach($_SESSION["cart_item"] as $k => $v) { //for each cart item
              if($productByCode[0]["code"] == $k) {
                if(empty($_SESSION["cart_item"][$k]["quantity"])) { //if cart was previously empty sets it to 0
                  $_SESSION["cart_item"][$k]["quantity"] = 0;
                }
                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"]; //add quantity for each add
              }
          }
        } else {
          $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray); //merges previous cart wit new cart item
        }
      } else {
        $_SESSION["cart_item"] = $itemArray;
      }
    }
  } elseif(isset($_POST['wishlist'])) { //same code as above
    if(!empty($_POST["quantity"])) { //if the quantity is greater than 0
      $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE code='" . $_GET["code"] . "'"); //query all products
      $itemWishArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));

      if(!empty($_SESSION["wish_item"])) { //if cart item is not empty
        if(in_array($productByCode[0]["code"],array_keys($_SESSION["wish_item"]))) { //and if session cart item is in array
          foreach($_SESSION["wish_item"] as $k => $v) { //for each cart item
              if($productByCode[0]["code"] == $k) {
                if(empty($_SESSION["wish_item"][$k]["quantity"])) { //if cart was previously empty sets it to 0
                  $_SESSION["wish_item"][$k]["quantity"] = 0;
                }
                $_SESSION["wish_item"][$k]["quantity"] += $_POST["quantity"]; //add quantity for each add
              }
          }
        } else {
          $_SESSION["wish_item"] = array_merge($_SESSION["wish_item"],$itemWishArray); //merges previous cart wit new cart item
        }
      } else {
        $_SESSION["wish_item"] = $itemWishArray;
      }
    }
  } elseif(isset($_POST['book'])){
    $serviceByCode = $db_handle->runQuery("SELECT * FROM services WHERE code='" . $_GET["code"] . "'"); //query all products
    $itemArray = array($serviceByCode[0]["code"]=>array('name'=>$serviceByCode[0]["name"], 'code'=>$serviceByCode[0]["code"], 'quantity'=>1, 'price'=>$serviceByCode[0]["price"], 'image'=>$serviceByCode[0]["image"]));

    if(!empty($_SESSION["cart_item"])) { //if cart item is not empty
      if(in_array($serviceByCode[0]["code"],array_keys($_SESSION["cart_item"]))) { //and if session cart item is in array
        foreach($_SESSION["cart_item"] as $k => $v) { //for each cart item
            if($serviceByCode[0]["code"] == $k) {
              if(empty($_SESSION["cart_item"][$k]["quantity"])) { //if cart was previously empty sets it to 0
                $_SESSION["cart_item"][$k]["quantity"] = 0;
              }
              $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"]; //add quantity for each add
            }
        }
      } else {
        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray); //merges previous cart wit new cart item
      }
    } else {
      $_SESSION["cart_item"] = $itemArray;
    }
  }
?>
