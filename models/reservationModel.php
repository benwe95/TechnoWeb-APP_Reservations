<?php

class ReservationModel{

  private $destination;
  private $nb_places;
  private $insurance;
  private $total = 0;
  private $people;

  public function __construct($dest = "", $places = 1, $insu = false, $people=array()){
    $this->destination = $dest;
    $this->nb_places = $places;
    $this->insurance = $insu;
    $this->people = $people;
  }

  public function getDestination()
  { return $this->destination; }

  public function setDestination($dest)
  { $this->destination = $dest; }


  public function getNbPlaces()
  { return $this->nb_places; }

  public function setNbPlaces($places)
  { $this->nb_places = $places; }


  public function getInsurance()
  { return $this->insurance; }

  public function setInsurance($insu)
  { $this->insurance = $insu; }


  public function getTotal()
  { return $this->total; }

  public function setTotal($tot)
  { $this->total = $tot;}

  public function computeTotal()
  {
    foreach($this->people as $peop){
      if ($peop->getAge()<=12){
        $this->total += 10;
      }
      else{
        $this->total += 15;
      }
    }

    if($this->insurance == true) $this->total += 20;
  }


  public function getPeople()
  { return $this->people; }

  public function setPeople($array_people)
  { $this->people = $array_people; }

}
?>
