<!DOCTYPE html>
<html>
  <head>
    <title>Page confirmation</title>
    <meta charset="utf-8" / >
  </head>

  <body>
    <div class='main'>
      <h1>Validation de la réservation</h1>
      <?php
        echo 'Destination:  ' . $reservation->getDestination() . '</br>
              Nombre de personne(s): ' . $reservation->getNbPlaces() . '</br>';
        for($i=0 ; $i<$reservation->getNbPlaces() ; $i++)
        {
          echo $array_people[$i]->getName() . '  ' . $array_people[$i]->getAge() . '</br>';
        }
        echo 'Assurance réservation: ' . $insurance . '</br>
              Total: ' . $total_to_pay . '€';
      ?>
    </div>

    <form method="POST" action="controller.php">
      <input type="submit" name = "canceled" value="Annuler">
      <input type="submit" name = "back_validation" value="Retour">
      <input type="submit" name="sent_validation" value="Continuer">
    </form>

  </body>
</html>
