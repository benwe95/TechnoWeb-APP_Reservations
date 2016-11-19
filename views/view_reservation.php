<!DOCTYPE>
<html>
  <head>
    <title>Réservations</title>
    <link rel=stylesheet href="style.css">
    <meta charset="utf-8">
  </head>

  <body>
    <div class="main">
        <div class="Intro">
          <h1>Réservation</h1>
          <p>Le prix de la place est de 10 euros jusqu'à 12 ans (inclu)
             et ensuite de 15 euros.<br/> Le prix de l'assurance annulation
             est de 20 euros quel que soit le nombre de voyageurs.</p>
        </div>

        <?php if ($error){ echo "<div class='error'>Veuillez indiquer le nombre de voyageurs.</div>"; }?>

        <form method="POST" action="controller.php">

          <p><label for="destination">Destination</label>:
          <select name="destination" size=1 id="destination">;

          <?php
            $destinations = array('Bruxelles', 'Londres', 'Madrid', 'Paris', 'Rome');
                foreach($destinations as $dest)
                {
                  echo '<option>' . $dest . '</option><br/>';
                }
          ?>
          </select>

          <p><label for="places">Nombre de voyageurs</label>:
            <?php
              //To set the value for the checkbox entry
              $insu_check = ($reservation->getInsurance()) ? 'checked' : "" ;

              echo "<input type='number' value='" . $reservation->getNbPlaces()
                  . "' name='nb_places' size='5' min='1' id='places'>

                  <p><label for='insurance'>Assurance annulation</label>
                  <input type='checkbox' name='insurance' id='insurance'" . $insu_check . ">";
            ?>

          <p><input type="submit" name="canceled" value="Annuler">
             <input type="submit" name="sent_reservation"     value="Continuer">
          </p>
        </form>

    </div>
  </body>
</html>
