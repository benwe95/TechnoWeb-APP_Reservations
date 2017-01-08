<table class='table'>
      <tr><td>Destination</td><td>Names (age)</td><td>Insurance</td><td>Total €</td><td></td><td></td>

      <?php foreach($database->query('SELECT * FROM reservations') as $res):
      $array_db_names = explode( ':', $res->names);
      $array_db_ages = explode( ':', $res->ages); ?>

      <tr>
        <td><?php echo $res->destination; ?></td>
        <td><?php for ($i=0 ; $i<count($array_db_names) ; $i++)
                  {
                    echo $array_db_names[$i] . '  (' . $array_db_ages[$i] . ') </br>';
                  }?></td>
        <td><?php echo $res->insurance; ?></td>
        <td><?php echo $res->total; ?></td>
        <td><a href="index.php?page=manager&action=delete&id=<?= $res->id;?>">
          <input type="submit" name="action" value="Delete"></a></td>
        <td><a href="index.php?page=manager&action=edit&id=<?= $res->id;?>">
          <input type="submit" name="action" value="Edit"></a></td>

      <?php endforeach; ?>

</table>
