<html>
  <head>
    <title>Details des reservations</title>
    <meta charset="utf-8">
  </head>

  <body>
    <div class="main">
      <h1>Détails des réservations</h1>

      <form method="POST" action="controller.php">
      <?php

        if($error)
        {
          echo "<div class='error'>Veuillez compléter tous les champs avec des données valides.</div></br>";
        }

        for($i=0 ; $i<$reservation->getNbPlaces() ; $i++)
        {
          $name = (count($array_people) == 0) ? "" : $array_people[$i]->getName();
          $age = (count($array_people) == 0) ? "" : $array_people[$i]->getAge();

          echo "<label for='name'>Nom</label>:
                <input type='text' name='name[]' value='" . $name .
                "' maxlength='20' id='name'><br/>
                <label for='age'>Age</label>:
                <input type='text' name='age[]' value='" . $age .
                "' size='3' maxlength='2' id='age'><br/><br/>";
         }
       ?>

       <input type="submit" name = "canceled" value="Annuler">
       <input type="submit" name = "back_details" value="Retour">
       <input type="submit" name="sent_details" value="Continuer">
     </form>
    </div>
  </body>
</html>
