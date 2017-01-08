<h1>Reservation</h1>
    <p>The price of the place is 10€ before 12 years (included) and then it's 15€.
    <br/>The price for the insurance of cancellation is 20€ whatever is the number of travellers.</p>


  <?php if ($error){ echo "<div class='error'>Veuillez indiquer le nombre de voyageurs.</div>"; }?>


  <form method="POST" action="index.php?page=reservation&action=handle" >

    <p><label for="destination">Destination</label>:
    <select name="destination" size=1 id="destination">;

    <?php
      $destinations = array('Brussels', 'London', 'Madrid', 'Paris', 'Roma');
          foreach($destinations as $dest)
          {
            echo '<option>' . $dest . '</option><br/>';
          }
    ?>
    </select>

    <p>
      <label for='places'>Number of travellers</label>:
      <input type='number' value="<?php echo $reservation->getNbPlaces(); ?>"
            name='nb_places' size='5' min='1' id='places'>

    <p><label for='insurance'>Insurance of cancellation</label>
      <input type='checkbox' name='insurance' id='insurance' <?php echo($reservation->getInsurance()) ? 'checked' : "" ; ?>>

    <p>
      <input type="submit" name="canceled" value="Cancel">
      <input type="submit" name="send_reservation" value="Continue">
    </p>
  </form>
