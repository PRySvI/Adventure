<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/Instances/models/Walkable.php');
require_once ('Map.php');
class Adventurer extends Walkable
{
     private $isAlive = true;
     private $inMapPositionY;
     private $inMapPositionX;
     private $current_orientation;
     private $moving_route;
     private $name;
     private $level;
     private $map;
     private $orientations = array('N','E','S','O');


    public function __construct($name, $inMapPositionY, $inMapPositionX, $orientation, $moving_route)
    {
        $this->inMapPositionY = $inMapPositionY;
        $this->inMapPositionX = $inMapPositionX;
        $this->current_orientation = $orientation;
        $this->moving_route = str_split($moving_route);
        $this->name = $name;
        $this->map = Map::getInstance();
        $this->setMyMapPosition($inMapPositionY, $inMapPositionX);
        $this->level=1;
    }



    function setMyMapPosition($newY, $newX)
    {
        $this->inMapPositionY = $newY;
        $this->inMapPositionX = $newX;
        $this->map->initCell($this, $newY, $newX);
    }

    /**
     * @return mixed
     */
    public function getInMapPositionY()
    {
        return $this->inMapPositionY;
    }

    /**
     * @return mixed
     */
    public function getInMapPositionX()
    {
        return $this->inMapPositionX;
    }



     public function goToNextStep($nextIteration)
     {
         if($nextIteration > count($this->moving_route))
         {
             return;
         }

         if(!$this->isAlive)
             return ; // if adv is dead , leave the method.


         $indexOfOrientation = array_search($this->current_orientation,$this->orientations);
         switch ($this->moving_route[$nextIteration])
         {
             case 'A':
                 break;

             case 'D':
                $newIndex = ($indexOfOrientation == 3 ? 0 : $indexOfOrientation + 1) ;
                $this->current_orientation=$this->orientations[$newIndex];
                 break;

            case 'G':
                $newIndex = ($indexOfOrientation == 0 ? 3 : $indexOfOrientation - 1) ;
                $this->current_orientation=$this->orientations[$newIndex];
                 break;

             default:
                 break;


         }
         $this->moveForward();

     }

      private function moveForward()
     {
         $tmpX=$this->inMapPositionX;
         $tmpY=$this->inMapPositionY;

         switch ($this->current_orientation)
         {
             case 'S':
                 $tmpY++;
                 break;

             case 'N':
                 $tmpY--;
                 break;

             case 'E':
                 $tmpX++;
                 break;

             case 'O':
                 $tmpX--;
                 break;

             default:
                 break;
         }


         $this->map->checkAndPlace($this,$tmpY,$tmpX);
        $this->map->printMap(); //dubug
     }


    public function fight($enemy)
    {
        echo " <br> Adventurer fight <br>";
        if($this->level >= $enemy->getLevel())
        {
            $enemy->doDie();
            $this->levelUp();
        }
        else
        {
            $this->doDie();
        }
    }


    function getPrintName()
    {

        $dead= "";
        if(!($this->getIsAlive()))
        {
            $dead = " (x_x)";
        }
        return "A" ."(".$this->name.")".$dead;
    }

    function levelUp(){
        $this -> level ++;
    }
}
