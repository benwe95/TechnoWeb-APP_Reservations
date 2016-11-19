<?php
session_start();

include_once ('models\model_reservation.php');
include_once ('models\model_people.php');


if (!isset($_SESSION['reservation']))
{
    $reservation = new Reservation();
    $_SESSION['reservation'] = serialize($reservation);
}
else
{
    $reservation = unserialize($_SESSION['reservation']);
}

$error = false;
$array_people = (isset($_SESSION['people'])) ? unserialize($_SESSION['people']) : array();
$total_to_pay = 0;


#-------- PAGE RESERVATION --------
if(isset($_POST['sent_reservation']))
{
  //If all the fields aren't completed -> sends back the page with a message of error
  if (!isset($_POST['nb_places']) || !is_numeric($_POST['nb_places']) )
  {
    $error = true;
    include 'views\view_reservation.php';
  }
  else
  {
    $reservation->setDestination ( htmlspecialchars($_POST['destination']) );
    $reservation->setNbPlaces ( htmlspecialchars($_POST['nb_places']) );

    if( isset($_POST['insurance']) )
    {
      $reservation->setInsurance(true);
    }
    else
    {
      $reservation->setInsurance(false);
    }

    $_SESSION['reservation'] = serialize($reservation);
    include 'views\view_details.php';

  }
}

#-------- PAGE DETAILS --------
elseif(isset($_POST['sent_details']))
{
    for($i=0 ; $i<$reservation->getNbPlaces() ; $i++)
    {
      //Delete white characters
      $_POST['name'][$i] = trim($_POST['name'][$i]);
      $_POST['age'][$i] = trim($_POST['age'][$i]);

      if( checkEntries($_POST['name'][$i] , $_POST['age'][$i]) )
      {
          $new_people = new People();
          $new_people->setName(htmlspecialchars($_POST['name'][$i]));
          $new_people->setAge(htmlspecialchars($_POST['age'][$i]));
          //$_SESSION['people'][$i] = serialize($new_people);
          $array_people[$i] = $new_people;

          $total_to_pay += ($_POST['age'][$i] <= 12) ? 10 : 15 ;
      }
      else
      {
          $error = true;
          include 'views\view_details.php';
      }
    }

    if(!$error)
    {
      $_SESSION['people'] = serialize($array_people);

      if($reservation->getInsurance()) $total_to_pay += 20;
      $insurance = ($reservation->getInsurance()) ? 'oui' : 'non' ;

      include 'views\view_validation.php';
    }
}


elseif(isset($_POST['back_details']))
{
    include 'views\view_reservation.php';
}


#-------- PAGE VALIDATION --------
elseif(isset($_POST['sent_validation']))
{
  session_unset();
  session_destroy();
  include 'views\view_end.php';
}


elseif(isset($_POST['back_validation']))
{
    include 'views\view_details.php';
}


#-------- CANCEL BUTTON --------
elseif(isset($_POST['canceled']))
{
  session_unset();
  session_destroy();
  include 'views\view_cancel.php';
}


#-------- LAUNCHING WEBSITE--------
else
{
    include 'views\view_reservation.php';
}


#-------- FUNCTIONS --------
function checkEntries($name, $age)
{
  if(strlen($name) == 0 ) return false;

  if ( !is_numeric($age) || $age<1 || $age>99) return false;

  return true;
}

?>
