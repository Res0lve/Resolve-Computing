<?php  // book number/validnumber counts how much book buttons/(tick or x) are needed and counter controls the book button and checks
  if (!empty($service_array)) {
    foreach($service_array as $key=>$value){
      $validNumber=0; $bookNumber= 0; $counter= 0; $validityCheck = array("FALSE", "FALSE", "FALSE"); $state = array("disabled", "disabled", "disabled");
?>
      <div class="service-row">
        <form method="post" action="<?php echo $service ?>.php?action=add&code=<?php echo $service_array[$key]["code"]; ?>">
          <div class="service-column1"><img class="service-image" src="<?php echo $service_array[$key]["image"]; ?>">
            <div class="service-name"><?php echo $service_array[$key]["name"]; ?></div>
          </div>

          <div class="service-column2">
            <div class="service-subcolumn1 service-date"><?php echo $service_array[$key]["date1"]?></div>
            <div class="service-subcolumn2 service-time"><?php echo $service_array[$key]["time1"]?></div>
            <?php
              if($service_array[$key]["available1"]==true) {
                $validityCheck[$counter]="TRUE";
                $state[$counter]="enabled";
              } $counter++;
            ?>

            <?php if($service_array[$key]["date2"] != NULL){ ?>
              <br/><br/><div class="service-subcolumn1 service-date"><?php echo $service_array[$key]["date2"]?></div>
              <div class="service-subcolumn2 service-time"><?php echo $service_array[$key]["time2"]?></div>
              <?php
                if($service_array[$key]["available2"]==true) {
                  $validityCheck[$counter]="TRUE";
                  $state[$counter]="enabled";
                } $counter++;
              ?>
            <?php $bookNumber+= 1; $validNumber+=1; } ?>

            <?php if($service_array[$key]["date3"] != NULL){ ?>
              <br/><br/><div class="service-subcolumn1 service-date"><?php echo $service_array[$key]["date3"]?></div>
              <div class="service-subcolumn2 service-time"><?php echo $service_array[$key]["time3"]?></div>
              <?php
                if($service_array[$key]["available3"]==true) {
                  $validityCheck[$counter]="TRUE";
                  $state[$counter]="enabled";
                } $counter++;
              ?>
            <?php $bookNumber+= 1; $validNumber+=1; } ?>
          </div>



            <div class="service-column3">
              <?php for($counter=0; $counter<=$validNumber; $counter++){ ?>
                <?php if($validityCheck[$counter]== "TRUE"){ ?>
                  <i style="color: green;" class="fa fa-check"></i>
                <?php } else { ?>
                  <i style="color: red;" class="fa fa-times"></i>
                <?php } ?>
              </br></br>
              <?php } ?>
            </div>


          <div class="service-colum4">
            <?php for($counter=0; $counter<=$bookNumber; $counter++){ ?>
              <input class="service-book" name="book" type="submit" value="BOOK" onclick="bookAlert()" <?php echo $state[$counter]?>/>
            <?php } ?>
          </div>

        </form>
      </div>
<?php
    }
  } else {
    echo "NO ITEMS";
  }
?>

<script>
  function bookAlert() {
    alert("Service was added to the shopping cart!");
  }
</script>
