<?php
  $product_array = $db_handle->runQuery("SELECT * FROM products WHERE category = '$product' ORDER BY id ASC");
  if (!empty($product_array)) {
    foreach($product_array as $key=>$value){
?>
    <div class="product-row">
      <form method="post" action="<?php echo $product ?>.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>"><!-- starts add product functionality  -->
        <div class="product-column1"><input type="text" class="product-quantity" name="quantity" value="1" size="2" />
          <input class="input-submit" style="width: 80%; margin: 1vw;" name="wishlist" type="submit" value="Add to Wishlist" onclick="wishlistAlert()"/>
          <input class="input-submit" style="width: 80%; margin: 1vw;" name="cart" type="submit" value="Add to Cart" onclick="cartAlert()"/>
        </div>
        <div class="product-column2"><img class="product-image" src="<?php echo $product_array[$key]["image"]; ?>">
          <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
        </div>
        <div class="product-column3 product-stock"><?php echo $product_array[$key]["stock"]; ?></div>
        <div class="product-column4 product-price"><?php echo "$"."JA ".$product_array[$key]["price"]; ?></div>
      </form>
    </div>

<?php
    }
  } else {
    echo "NO ITEMS";
  }
?>

<script>
  function cartAlert() {
    alert("Product was added to the shopping cart!");
  }
</script>

<script>
  function wishlistAlert() {
    alert("Product was added to wishlist!");
  }
</script>
