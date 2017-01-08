  <?php

class Manager extends Controller{

  private $datas = array();

  public function __construct(){
    require_once(WEBROOT.'models/reservationModel.php');
    require_once(WEBROOT.'models/peopleModel.php');

    $this->datas = array(
      'database' => $GLOBALS['database']
    );
  }

  public function home(){
    $this->loadView($this->datas, 'home');
  }


  public function edit($id){

    $infos = $this->datas['database']->query('SELECT * FROM reservations WHERE id='.$id);
    $_SESSION['id'] = $infos[0]->id;
    $infos['destination'] = $infos[0]->destination;
    $infos['insurance'] = ($infos[0]->insurance == 'yes') ? true : false;
    $infos['names'] = explode(':', $infos[0]->names);
    $infos['ages'] = explode(':', $infos[0]->ages);

    $this->loadView($infos, 'edit');
  }


  public function save(){
    if(isset($_POST['save_edit'])){
      $insu = ($_POST['insurance'] == true) ? 'yes' : 'no' ;
      $total=0;

      foreach($_POST['age'] as $age){
        if ($age<=12){
          $total += 10;
        }
        else{
          $total += 15;
        }
      }
      if($insu =='yes') $total += 20;

      $array_statement = array(
        'destination' => $_POST['destination'],
        'insurance' => $insu,
        'names' => implode(':', $_POST['name']),
        'ages' => implode(':', $_POST['age']),
        'total' => $total,
        'id' => $_SESSION['id']
      );

    $this->datas['database']->modifyEntry($array_statement);

    }
    $this->loadView($this->datas, 'home');
  }


  public function delete($id){
    $this->datas['del_id'] = $id;
    if(isset($_POST['save_delete'])){
      $statement = 'DELETE FROM reservations WHERE id='.$id;
      $this->datas['database']->deleteEntry($statement);
      $this->loadView($this->datas, 'home');
    }
    elseif (isset($_POST['cancel_delete'])) {
      $this->loadView($this->datas, 'home');
    }
    else{
      $this->loadView($this->datas, 'delete');
    }
  }
}
 ?>
