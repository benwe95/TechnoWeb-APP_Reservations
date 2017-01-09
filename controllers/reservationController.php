<?php

class Reservation extends Controller{

  private $datas = array();

  public function __construct(){
    require_once(WEBROOT.'models/reservationModel.php');
    require_once(WEBROOT.'models/peopleModel.php');

	//If there is no object of type 'reservationModel' in the current session then creates one. 
	//Otherwise unserializes it to use its content.
    if (!isset($_SESSION['reservation'])){
      $reservation = new ReservationModel();
      $_SESSION['reservation'] = serialize($reservation);
    }
    else{
      $reservation = unserialize($_SESSION['reservation']);
    }

    $array_people = $reservation->getPeople();

	//$this->datas contains all the datas that are necessary for the views
    $this->datas = array(
      'reservation' => $reservation,
      'error' => false,
      'array_people' => $array_people,
      'insurance' => 'no'
    );

  }

  public function home(){
    $this->set($this->datas);
    $this->render('home');
  }

//Main method of the reservation. It analyses which button was pressed in the form and then reacts to it.
  public function handle(){
    #-------- PAGE RESERVATION --------
    if(isset($_POST['send_reservation'])){
      //If all the fields aren't completed -> sends back the page with a message of error
      if (!isset($_POST['nb_places']) || !is_numeric($_POST['nb_places']) ){
        $this->handleError('home');
      }
      else{
        $this->handleReservation();
      }
    }

    #-------- PAGE DETAILS --------
    elseif(isset($_POST['send_details'])){
      $this->handleDetails();
    }

    elseif(isset($_POST['back_details'])){
      $this->loadView($this->datas, 'home');
    }


    #-------- PAGE VALIDATION --------
    elseif(isset($_POST['send_validation'])){
      $this->handleValidation();
      session_unset();
      session_destroy();
      $this->render('end');
    }

    elseif(isset($_POST['back_validation'])){
        $this->datas['reservation']->setTotal(0);
        $_SESSION['reservation'] = serialize($this->datas['reservation']);
        $this->loadView($this->datas, 'details');
    }


    #-------- CANCEL BUTTON --------
    elseif(isset($_POST['canceled'])){
      session_unset();
      session_destroy();
      $this->render('cancel');
    }


    #-------- LAUNCHING WEBSITE--------
    else{
        $this->loadView($this->datas, 'home');
    }

  }

//Updates the object 'reservationModel' 
  public function handleReservation(){
    $this->datas['reservation']->setDestination ( htmlspecialchars($_POST['destination']) );
    $this->datas['reservation']->setNbPlaces ( htmlspecialchars($_POST['nb_places']) );

    if( isset($_POST['insurance']) ){
      $this->datas['reservation']->setInsurance(true);
    }
    else{
      $this->datas['reservation']->setInsurance(false);
    }

    $_SESSION['reservation'] = serialize($this->datas['reservation']);
    $this->loadView($this->datas, 'details');
  }


  public function handleDetails(){
    for($i=0 ; $i<$this->datas['reservation']->getNbPlaces() ; $i++)
        {
          //Delete white characters
          $_POST['name'][$i] = trim($_POST['name'][$i]);
          $_POST['age'][$i] = trim($_POST['age'][$i]);

          if( $this->checkEntries($_POST['name'][$i] , $_POST['age'][$i]) ){
              $new_people = new People();
              $new_people->setName(htmlspecialchars($_POST['name'][$i]));
              $new_people->setAge(htmlspecialchars($_POST['age'][$i]));
              $this->datas['array_people'][$i] = $new_people;
          }
          else{
            $this->handleError('details');
          }
        }

        if(!$this->datas['error']){
          //$_SESSION['people'] = serialize($this->datas['array_people']);
          $this->datas['reservation']->setPeople($this->datas['array_people']);
          $this->datas['reservation']->computeTotal();
          $_SESSION['reservation'] = serialize($this->datas['reservation']);
          $this->datas['insurance'] = ($this->datas['reservation']->getInsurance()) ? 'yes' : 'no' ;
          $this->loadView($this->datas, 'validation');
        }
  }

//Saves the reservation in the database if the user confirmed it.
  public function handleValidation(){

    $this->datas['insurance'] = ($this->datas['reservation']->getInsurance()) ? 'yes' : 'no' ;

    $concat_names=array();
    $concat_ages=array();

    foreach($this->datas['reservation']->getPeople() as $peop){
      array_push($concat_names, $peop->getName());
      array_push($concat_ages, $peop->getAge());
    }

    $array_statement = array(
      'destination' => $this->datas['reservation']->getDestination(),
      'insurance' => $this->datas['insurance'],
      'names' => implode(':', $concat_names),
      'ages' => implode(':', $concat_ages),
      'total' => $this->datas['reservation']->getTotal() );

    $GLOBALS['database']->newEntry($array_statement);
  }

//Reloads the page where an entry was wrong. A message will be displayed for the user
  public function handleError($viewname){
    $this->datas['error'] = true;
    $this->loadView($this->datas, $viewname);
  }


  public function checkEntries($name, $age)
  {
    if(strlen($name) == 0 ) return false;

    if ( !is_numeric($age) || $age<1 || $age>99) return false;

    return true;
  }
}

 ?>
