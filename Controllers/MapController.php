<?php
//namespace Controllers;
require ($_SERVER['DOCUMENT_ROOT'] . '/Instances/Map.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/Instances/Adventurer.php');


class MapController
{
    private static $_instance = null;
    private $debug = false;
    private $map;
    private $adventurers = array();

    /**
     * MapController constructor.
     * @param bool $debug
     * @param $map
     * @param $adenturers
     */
    public function __construct()
    {

    }

    public static function getInstance() {

        if(is_null(self::$_instance)) {
            self::$_instance  = new MapController();
        }

        return self::$_instance;
    }

    public function loadCfg($path)
    {
        $cfgFile = fopen($path, "r") or die("Impossible d'ouvrir le fichier!");
        while(!feof($cfgFile))
        {
            $this->applyParams(preg_replace('/\s/', '',fgets($cfgFile)));
        }
        fclose($cfgFile);
        $this->map->printMap();
        $this->startGame();
    }

    public function startGame()
    {
        //startBots();
        foreach ($this->adventurers as $currentAdventurer)
        {
            $currentAdventurer->startMyRoute();
        }
    }
    /**
     * This block make initialization of params
     */
    public function applyParams($line)
    {
        if($this->debug) {
            echo 'applyParams '.'<br>'.$line[0].'<br>'.$line[1].'<br>'.$line[2].'<br>'.'+++++++++++++'.'<br>';
        }
        $cfgKeys = explode("-",$line);
        $key = substr($line,0,1);
            switch ($key)
            {
                case "C":
                    $this->map=Map::getInstance();
                    $this->map->initializeMap($cfgKeys[1],$cfgKeys[2]);
                    break;

                case "M":
                    $this->map->initCell($cfgKeys[0],$cfgKeys[1],$cfgKeys[2]);
                    break;

                case "T":
                    $this->map->initCell($cfgKeys[0]."($cfgKeys[3])",$cfgKeys[1],$cfgKeys[2]);
                    break;

                case "A":
                    array_push($this->adventurers,new Adventurer($cfgKeys[1],$cfgKeys[2],$cfgKeys[3],$cfgKeys[4],$cfgKeys[5],$this->map));
                    $this->map->initCell($cfgKeys[0]."(".substr($cfgKeys[1],0,strlen($cfgKeys[1])/2).")",$cfgKeys[2],$cfgKeys[3]);
                    break;


                default:
                    break;
            }
            echo "<br>";

    }

}