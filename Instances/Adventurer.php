<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/02/18
 * Time: 5:54 AM
 */
require_once ($_SERVER['DOCUMENT_ROOT'] . '/Instances/models/Walkable.php');
require_once ('Map.php');

class Adventurer extends Walkable
{
     private $current_orientation;
     private $moving_route;
     private $name;
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

     public function moveForward()
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

         if($GLOBALS["DEBUG"])
            $this->map->printMap(); //dubug
     }


    public function fight($enemy)
    {
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

        if($GLOBALS["DEBUG"])
        {
            $dead= "";
            if(!($this->getIsAlive()))
            {
                $dead = " (x_x)";
            }
            return "A" ."(".$this->name.")".$dead;
        }
        return "A";
    }

    function levelUp(){
        $this -> level ++;
    }

    public function getMyResults()
    {

        $separator = " - ";
        $export_title="# {A comme Aventurier} - {".$this->getPrintName()."} - {Axe horizontal} - {Axe vertical} - {Orientation} - {Level Obtenu}";
        $export_line = $this->getPrintName().$separator.$this->name.$separator.$this->getInMapPositionX().$separator.$this->getInMapPositionY().$separator.$this->current_orientation.$separator.$this->getLevel();
        return $export_title."\r\n".$export_line."\r\n";

    }
}
