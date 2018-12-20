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


    /*public function initializeMap($sizeX,$sizeY)
    {
        $this->sizeX=$sizeX-1; // arrays begins form 0 so we decrciments value by 1
        $this->sizeY=$sizeY-1; // arrays begins form 0 so we decrciments value by 1
        if($this->debug) {echo ('initializeMap <br>');}
        $this->mapGrid = array();
        for($i = 0 ; $i < $sizeY; $i++ )
        {
            $this-> mapGrid[$i]=array_fill(0,$sizeX,'.');
        }
    }*/

    public function initializeMap($sizeX,$sizeY)
    {
        $this->sizeX = $sizeX - 1; // arrays begins form 0 so we decrciments value by 1
        $this->sizeY = $sizeY - 1; // arrays begins form 0 so we decrciments value by 1
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
        $this->mapGrid[$x][$y]=$key;
    }

    public function getCellInstanceInfo($y, $x)
    {
        return $this->mapGrid[$y][$x];
    }

    public function getCellInfoChar($y, $x)
    {
        return $this->mapGrid[$y][$x];
    }

    public function getSizeX(){return $this->sizeX;}
    public function getSizeY(){return $this->sizeY;}

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
