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
        $this->sizeX = $sizeX; // arrays begins form 0 so we decrciments value by 1
        $this->sizeY = $sizeY; // arrays begins form 0 so we decrciments value by 1
        if ($this->debug) {
            echo('initializeMap <br>');
        }
        $this->mapGrid = array();
        for($i = 0 ; $i < $sizeY; $i++ )
        {
            $this-> mapGrid[$i]=array_fill(0,$sizeX,new Plaine());
        }
    }
    public function initCell($key,$y,$x)
    {
        if($this->debug) {echo ('initCell  <br>');}

        //if($this->sizeof($this->mapGrid)) a finir verification
        $this->mapGrid[$y][$x]=$key;
    }

    public function getCellInstanceInfo($y, $x)
    {
        if($y > $this->getSizeY() || $x > $this->getSizeX() )
        {
            return null;
        }

        return $this->mapGrid[$y][$x]->getMyInstance();
    }

    public function getSizeX(){echo "<br> sizeX $this->sizeX"; return $this->sizeX;}
    public function getSizeY(){echo "<br> sizeY $this->sizeY"; return $this->sizeY;}

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

        echo "<br>";


    }

}
