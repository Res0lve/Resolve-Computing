<table class="item-table" cellpadding="16" cellspacing="0">
  <tbody>
  <tr class="item-header">
    <th style="text-align:left; width:100vw;" width="53%">NAME</th>
    <th style="text-align:right;" width="10%">CODE</th>
    <th style="text-align:right;" width="5%">QTY</th>
    <th style="text-align:right;" width="10%">UNIT PRICE</th>
    <th style="text-align:right;" width="10%">PRICE</th>
    <th style="text-align:center;" width="8%">REMOVE</th>
  </tr>

    <?php
      foreach ($_SESSION["cart_item"] as $item){ //displays all cart items
        $item_price = $item["quantity"]*$item["price"];
    ?>
        <tr class="cart-row">
          <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image"/><?php echo $item["name"]; ?></td>
          <td style="text-align:right;"><?php echo $item["code"]; ?></td>
          <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
          <td style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
          <td style="text-align:right;"><?php echo "$ ".number_format($item_price, 2); ?></td>
          <td style="text-align:center;"><a href="<?php echo $page ?>.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><i class="fa fa-trash"></a></td>
        </tr>
        <?php
          $total_quantity += $item["quantity"];
          $total_price += ($item["price"]*$item["quantity"]);
      }
        ?>

    <tr class="cart-summary">
      <td colspan="2" align="right">Total:</td> <!--bottom part of shopping cart -->
      <td align="right"><?php echo $total_quantity; ?></td>
      <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
      <td></td>
    </tr>
  </tbody>
</table>
