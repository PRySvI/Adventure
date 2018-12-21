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
     private $canMove = true;
     private $name;
     private $level;
     private $inFight;
     private $map;
     private $orientations = array('N','E','S','O');
     private $collapsed_tresor_visited;
     private $collapsed_tresor_current;
     private $collapsed_tresor_next;


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
        $this->collapsed_tresor_next;

        $this->map->initCell(new Plaine(),$this->inMapPositionY,$this->inMapPositionX);
        if($this->collapsed_tresor_current != null)
        {
            $this->map->initCell($this->collapsed_tresor_current,$this->inMapPositionY,$this->inMapPositionX);
            $this->collapsed_tresor_current = null;
        }

        if($this->collapsed_tresor_next != null)
        {
            $this->collapsed_tresor_current = $this->collapsed_tresor_next;
            $this->collapsed_tresor_next = null;
        }

        $this->map->initCell($this,$newY, $newX);
        $this->inMapPositionY = $newY;
        $this->inMapPositionX = $newX;
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
         echo "orient $this->current_orientation";
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
         echo "<br> MvRights Y $tmpY  X $tmpX level $this->level";
         if($this->checkMoveRights($tmpY,$tmpX))
         {
             $this->setMyMapPosition($tmpY,$tmpX);
         }

        $this->map->printMap(); //dubug
     }

    public function checkMoveRights($Y,$X)
    {
        if($this->map->getSizeX() < $X || $this->map->getSizeY() < $Y || $X<0)
            return false;


        $cell = $this->map->getCellInstanceInfo( $Y, $X );

        if($cell==null)
            return false;

        if($cell instanceof Montagne)
            return false;

        if($cell instanceof Adventurer) // Properties Can Walk to Dead Man
            return false;

        if($cell instanceof Tresor)
        {
            $cell->reduiceCount();
            $this->level++;
            if($cell->getCount()>0)
                $this->collapsed_tresor_next = $cell;

            return true;

        }


        /*
                 if($cell instanceof Monster){
                     return $this->fight();

                 }*/


        /*$mapCell = substr($this->map->getCell($X, $Y),0,1); //Get only first char of Cellable : Exemple A(Ind) will return only A

         if($mapCell=='A'||$mapCell=='M')
             return false;*/


        return true;
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
