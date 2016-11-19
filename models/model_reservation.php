<?php
class Reservation
{
  private $destination;
  private $nb_places;
  private $insurance;


  public function __construct($dest = "", $places = 1, $insu = false)
  {
    $this->destination = $dest;
    $this->nb_places = $places;
    $this->insurance = $insu;
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

}
?>
