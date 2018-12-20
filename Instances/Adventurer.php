<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/Instances/models/Walkable.php');
require_once ('Map.php');
class Adventurer extends Walkable
{
     private $isAlive = true;
     private $inMapPositionY;
     private $inMapPositionX;
     private $orientation;
     private $moving_route;
     private $canMove = true;
     private $name;
     private $level;
     private $inFight;
     private $map;


    public function __construct($name, $inMapPositionY, $inMapPositionX, $orientation, $moving_route)
    {
        $this->inMapPositionY = $inMapPositionY;
        $this->inMapPositionX = $inMapPositionX;
        $this->orientation = $orientation;
        $this->moving_route = str_split($moving_route);
        $this->name = $name;
        $this->map = Map::getInstance();
        $this->setMyMapPosition($inMapPositionY, $inMapPositionX);
    }


    function setMyMapPosition($Y, $X)
    {
        $this->map->initCell($this,$Y, $X);
        $this->inMapPositionY = $Y;
        $this->inMapPositionX = $X;
    }


     public function goToNextStep($nextIteration)
     {
         if($nextIteration > count($this->moving_route))
         {
             return;
         }

         if(!$this->isAlive)
             return ; // if adv is dead , leave the method.

       /*  if(!$this->canMove)
             return ; // same for blocked adventurers;*/

         switch ($this->moving_route[$nextIteration])
         {
             case 'A':
                 $this->movForward();
                 break;
         }



     }

     public function checkMoveRights($X , $Y)
     {
        if($this->map->getSizeX() < $X)
            return false;

        if($this->map->getSizeY() < $Y)
            return false;

        // $cell = $this->map->getCellInstanceInfo($X , $Y);
         /*
                  if($cell instanceof Monster){
                      return $this->fight();

                  }*/


       /*$mapCell = substr($this->map->getCell($X, $Y),0,1); //Get only first char of Cellable : Exemple A(Ind) will return only A

        if($mapCell=='A'||$mapCell=='M')
            return false;*/

        return true;
        //tresor
     }
     private function movForward()
     {
         $tmpX=$this->inMapPositionX;
         $tmpY=$this->inMapPositionY;

         switch ($this->orientation)
         {
             case 'S':
                 $tmpY++;
                 if($this->checkMoveRights($tmpX,$tmpY))
                 {

                     $this->setMyMapPosition($tmpX,$tmpY);
                 }
                 break;
         }

        // $this->map->printMap(); //dubug
     }
    public function fight()
    {
        $inFight = true;
        echo "fight";
        $inFight = false;
        return true;
    }

    function collapse()
    {
        // TODO: Implement collapse() method.
    }

    function getPrintName()
    {
        return "A" ."(".substr($this->name,0,strlen($this->name)/2).")";
    }

}
