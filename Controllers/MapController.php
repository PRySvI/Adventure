<?php
//namespace Controllers;
/*require ($_SERVER['DOCUMENT_ROOT'] . '/Instances/Map.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/Instances/Adventurer.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/Instances/Montagne.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/Instances/Tresor.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/Instances/Gobelin.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/Instances/Orc.php');*/

foreach(glob($_SERVER['DOCUMENT_ROOT'] . "/Instances/" . "/*.php") as $file){
    require_once $file;
}

class MapController
{
    private static $_instance = null;
    private $debug = false;
    private $map;
    private $walkableInstances = array();
    private $someAdventurerMaxSteps = 0;

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
        echo "====== FIRST PRINT BEFORE START GAME =========<br>";
        $this->startGame();
    }

    /* The game loop, is true while adventurer (X) dont make all movements
     * $someAdventurerMaxSteps this is the most long route of adventurer (X) loaded in cfg
     * Exemple: Adv (Bob) have route AAFFAAA = 7 steps and Adv (John) have route AADADA = 6 steps
     * so $someAdventurerMaxSteps = 7 //
     * Every rotations every adventurers make one step
     */
    public function startGame()
    {
        for($currentStep = 0 ; $currentStep < $this->someAdventurerMaxSteps; $currentStep++)
        {
            foreach ($this->walkableInstances as $walkable) {
                echo $walkable->getPrintName()." goToNextStep <br>";
                $walkable->goToNextStep($currentStep);
            }
        }
    }
    /*
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
                    $this->map->initializeMap($cfgKeys[2],$cfgKeys[1]);
                    break;

                case "M":
                    new Montagne($cfgKeys[2],$cfgKeys[1]);
                    break;

                case "T":
                    new Tresor($cfgKeys[3],$cfgKeys[2],$cfgKeys[1]);
                    break;

                case "A":
                    array_push($this->walkableInstances,new Adventurer($cfgKeys[1],$cfgKeys[3],$cfgKeys[2],$cfgKeys[4],$cfgKeys[5]));
                    if(strlen($cfgKeys[5]) > $this->someAdventurerMaxSteps)
                    {
                        $this->someAdventurerMaxSteps = strlen($cfgKeys[5]);
                    }
                    break;

                case "G":
                    array_push($this->walkableInstances,new Gobelin($cfgKeys[2],$cfgKeys[1],$cfgKeys[3],$cfgKeys[4]));
                    break;

                case "O":
                    array_push($this->walkableInstances,new Orc($cfgKeys[2],$cfgKeys[1],$cfgKeys[3],$cfgKeys[4]));
                    break;

                default:
                    break;
            }

    }

}