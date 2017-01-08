<form method="POST" action="index.php?page=manager&action=save" >

  <p><label for="destination">Destination</label>:
  <select name="destination" size=1 id="destination">;

  <?php
    $destinations = array('Brussels', 'London', 'Madrid', 'Paris', 'Roma');
        foreach($destinations as $dest)
        {
          //$selected = ($dest == $destination) ? 'selected="selected"' : "";
          echo '<option>' . $dest . '</option><br/>';
        }
  ?>
  </select>


  <p><label for='insurance'>Insurance of cancellation</label>
    <input type='checkbox' name='insurance' id='insurance' checked='<?php echo($insurance) ?>'>



  <p>
    <?php
      for($i=0 ; $i<count($names) ; $i++){
      $name = (count($names) == 0) ? "" : $names[$i];
      $age = (count($ages) == 0) ? "" : $ages[$i];

      echo "<label for='name'>Name</label>:
            <input type='text' name='name[]' value='" . $name .
            "' maxlength='20' id='name'><br/>
            <label for='age'>Age</label>:
            <input type='text' name='age[]' value='" . $age .
            "' size='3' maxlength='2' id='age'><br/><br/>";
     }?>
   </p>

   <p>
     <input type="submit" name="cancel_edit" value="Cancel">
     <input type="submit" name="save_edit" value="Save">
   </p>

</form>
