<?php
class Adventurer
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

    /**
     * Adventurer constructor.
     * @param $name
     * @param $inMapPositionY
     * @param $inMapPositionX
     * @param $orientation
     * @param $moving_route
     * @param $map
     */
    public function __construct($name, $inMapPositionY, $inMapPositionX, $orientation, $moving_route,$map )
    {
        $this->inMapPositionY = $inMapPositionY;
        $this->inMapPositionX = $inMapPositionX;
        $this->orientation = $orientation;
        $this->moving_route = str_split($moving_route);
        $this->name = $name;
        $this->map = $map;
    }



    /**
     * @param int $inMapPositionY
     */
    public function setInMapPositionY($inMapPositionY)
    {
        $this->inMapPositionY = $inMapPositionY;
    }

    /**
     * @return int
     */
    public function getInMapPositionX()
    {
        return $this->inMapPositionX;
    }

    /**
     * @return int
     */
    public function getInMapPositionY()
    {
        return $this->inMapPositionY;
    }
    /**
     * @param int $inMapPositionX
     */
    public function setInMapPositionX($inMapPositionX)
    {
        $this->inMapPositionX = $inMapPositionX;
    }

    private function setInMapPositions($X ,$Y){

        $this->map->initCell(".", $this->inMapPositionX,$this->inMapPositionY);
        $this->map->initCell("A(".substr($this->name,0,strlen($this->name)/2).")",$X,$Y);
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


         // $this->map->printMap();
     }

     private function checkMoveRights($X , $Y)
     {
        if($this->map->getSizeX() < $X)
            return false;

        if($this->map->getSizeY() < $Y)
            return false;


       /*$mapCell = substr($this->map->getCell($X, $Y),0,1); //Get only first char of Cellable : Exemple A(Ind) will return only A

        if($mapCell=='A'||$mapCell=='M')
            return false;*/

        return true;
        //tresor
     }
     private function movForward()
     {
         $tmpX=$this->getInMapPositionX();
         $tmpY=$this->getInMapPositionY();
         switch ($this->orientation)
         {
             case 'S':
                 $tmpY++;
                 if($this->checkMoveRights($tmpX,$tmpY))
                 {

                     $this->setInMapPositions($tmpX,$tmpY);
                 }
                 break;
         }
     }
    private function fight()
    {
        $inFight = true;
        echo "fight";
        $inFight = false;
    }

}
