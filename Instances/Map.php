<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/Instances/Plaine.php');
class Map
{
    private $debug = false;
    private $mapGrid;
    private static $_instance = null;
    private $sizeX;
    private $sizeY;

    public static function getInstance() {

        if(is_null(self::$_instance)) {
            self::$_instance  = new Map();
        }

        return self::$_instance;
    }
    private function __construct()
    {
       if($this->debug) {echo ('__construct <br>'); }
    }


    public function initializeMap($sizeY,$sizeX)
    {
        $this->sizeX = $sizeX;
        $this->sizeY = $sizeY;
        if ($this->debug) {
            echo('initializeMap <br>');
        }
        $this->mapGrid = array();
        for($i = 0 ; $i < $sizeY; $i++ )
        {
            for($k = 0 ; $k < $sizeX; $k++ )
            {
                $this->mapGrid[$i][$k]=new Plaine($i,$k);
            }
        }
    }
    public function initCell($key,$y,$x)
    {
        if($this->debug) {echo ('initCell  <br>');}


        if(!($this->getCellInstanceInfo($y, $x) instanceof Plaine))
        {
            $this->mapGrid[$y][$x]=new Plaine($y,$x);
        }

        $this->mapGrid[$y][$x]->add($key);

    }

    public function getCellInstanceInfo($y, $x)
    {
        if($y >= $this->getSizeY() || $x >= $this->getSizeX() || $y < 0  || $x < 0)
        {
            return null;
        }

        return $this->mapGrid[$y][$x]->getMyInstance();
    }

    public function checkAndPlace($inst,$Y,$X)
    {
        if($this->getSizeX() < $X || $this->getSizeY() < $Y || $X<0)
            return;

        $cell =  $this->getCellInstanceInfo($Y,$X);

        if($inst instanceof Walkable && !($inst->getIsAlive()))
            return;

        if($cell -> allowAdd($inst))
        {

            $lastCell = $this->getCellInstanceInfo($inst->getInMapPositionY(),$inst->getInMapPositionX());
            $lastCell->remove($inst);
            $inst->setMyMapPosition($Y,$X);
        }
    }

    public function getSizeX(){ return $this->sizeX;}
    public function getSizeY(){ return $this->sizeY;}

    public function printMap() // debug only
    {
        if($this->debug) {echo ('printMap  <br>');}

        echo '<table style="\width:100% \">';
       foreach ($this->mapGrid as $cell)
        {
            echo '<tr>';
            foreach ($cell as $cell2)
            {
                echo "<td> ".$cell2->getPrintName()." </td>";
            }
            echo '</tr>';
        }
        echo '</table>';

        echo "<br> -------------------------------------  -------------------------------------  -------------------------------------  -------------------------------------  -------------------------------------  -------------------------------------<br> ";



    }

}
