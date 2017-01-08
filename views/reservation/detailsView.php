<form method="POST" action="index.php?page=reservation&action=handle">
    <?php

      if($error){
        echo "<div class='error'>Please complete all the fields.</div></br>";
      }

      for($i=0 ; $i<$reservation->getNbPlaces() ; $i++){
        $name = (count($array_people) == 0) ? "" : $array_people[$i]->getName();
        $age = (count($array_people) == 0) ? "" : $array_people[$i]->getAge();

        echo "<label for='name'>Name</label>:
              <input type='text' name='name[]' value='" . $name .
              "' maxlength='20' id='name'><br/>
              <label for='age'>Age</label>:
              <input type='text' name='age[]' value='" . $age .
              "' size='3' maxlength='2' id='age'><br/><br/>";
       }
     ?>

     <input type="submit" name = "canceled" value="Cancel">
     <input type="submit" name = "back_details" value="Back">
     <input type="submit" name="send_details" value="Continue">
   </form>
