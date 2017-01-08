<form method="POST" action="index.php?page=manager&action=delete&id=<?= $del_id;?>">
Do you really want to delete this reservation?
<p>
  <input type="submit" name="cancel_delete" value="No">
  <input type="submit" name="save_delete" value="Yes">
</p>

</form>
