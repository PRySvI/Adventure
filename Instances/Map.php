<?php
class Map
{
    private $debug = false;
    private $mapGrid;


    function __construct($y,$x)
    {
       if($this->debug) {echo ('__construct <br>'); }
        $this->initializeMap($x,$y);
    }



    private function initializeMap($sizeX,$sizeY)
    {
        if($this->debug) {echo ('initializeMap <br>');}
        $this->mapGrid = array();
        for($i = 0 ; $i < $sizeX; $i++ )
        {
            $this-> mapGrid[$i]=array_fill(0,$sizeY,'.');
        }
    }

    public function initCell($key,$y,$x)
    {
        if($this->debug) {echo ('initCell  <br>');}
        $this->mapGrid[$x][$y]="$key";
    }

    public function printMap() // debug only
    {
        if($this->debug) {echo ('printMap  <br>');}
        echo '<table style="\width:100% \">';
        foreach ($this->mapGrid as $cell)
        {
            echo '<tr>';
            foreach ($cell as $cell2)
            {
                echo "<td> $cell2 </td>";
            }
            echo '</tr>';
        }
        echo '</table>';
    }

}
