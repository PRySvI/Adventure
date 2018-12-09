<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/7/18
 * Time: 7:36 AM
 */

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

    public function printMap() // debug only
    {
        if($this->debug) {echo ('printMap  <br>');}
        echo '<h1>';
        foreach ($this->mapGrid as $cell)
        {
            foreach ($cell as $cell2)
            {
                echo ($cell2);
                echo '    ';
            }
            echo '<br>    ';
        }
        echo '</h1>';
    }

}
