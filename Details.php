<html>
  <head>
    <title>Details des reservations</title>
  </head>

  <body>
    <div class="main">
      <h1>Details des reservations</h1>

      <form method="POST" action="validation.php">
      <?php
        for($i=0 ; $i<$_POST['number_travellers'] ; $i++)
        {
          echo 'Name <input type="text" name="name[]"><br/>';
          echo 'Age <input type="text" name="age[]"><br/><br/>';
        }
       ?>

       <input type="submit" value="Etape suivante">
    </div>
  </body>
</html>
