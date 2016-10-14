<html>
  <head>
    <title>Réservations</title>
  </head>

  <body>
    <div class="main">
        <div class="Intro">
          <h1>Reservation</h1>
          <p>Le prix de la place est de 10 euros jusqu'a 12 ans
             et ensuite de 15 euros.<br/> Le prix de l'assurance annulation
             est de 20 euros quel que soit le nombre de voyageurs.</p>
        </div>
        <form method="POST" action="details.php">
          <p>Destination
            <select name="destination" size=1>
              <option>Bruxelles
              <option>Londres
              <option>Madrid
              <option>Paris
              <option>Rome
            </select>
          <p>Nombre de voyageurs
            <select name="number_travellers" siez=1>
              <option>1
              <option>2
              <option>3
              <option>4
              <option>5
            </select>
          <p>Assurance annulation <input type="checkbox" value='A'>
          <p><input type="submit" value="Etape suivante">


    </div>
  </body>
</html>
