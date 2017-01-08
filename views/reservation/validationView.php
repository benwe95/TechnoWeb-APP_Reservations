<h1>Validation of the reservation</h1>
      <?php
        echo 'Destination:  ' . $reservation->getDestination() . '</br>
              Number of traveller(s): ' . $reservation->getNbPlaces() . '</br>';
        for($i=0 ; $i<$reservation->getNbPlaces() ; $i++)
        {
          echo $array_people[$i]->getName() . '  ' . $array_people[$i]->getAge() . '</br>';
        }
        echo 'Insurance of cancellation: ' . $insurance . '</br>
              Total: ' . $reservation->getTotal() . '€';
      ?>
    </div>

    <form method="POST" action="index.php?page=reservation&action=handle">
      <input type="submit" name = "canceled" value="Cancel">
      <input type="submit" name = "back_validation" value="Back">
      <input type="submit" name="send_validation" value="Continue">

    </form>
