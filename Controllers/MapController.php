<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/02/18
 * Time: 5:47 AM
 */


include('./myconf.php');

foreach(glob("./Instances/" . "/*.php") as $file){
    require_once $file;
}

class MapController
{
    private static $_instance = null;
    private $map;
    private $walkableInstances = array();
    private $cellableInstances = array();
    private $someAdventurerMaxSteps = 0;


    public static function getInstance() {

        if(is_null(self::$_instance)) {
            self::$_instance  = new MapController();
        }

        return self::$_instance;
    }

    public function removeFromCellables($key){
        if(count($this->cellableInstances)>0)
        {
            unset($this->cellableInstances[array_search($key,$this->cellableInstances)]);
        }

    }

    public function loadCfg()
    {
        $cfgFile = fopen("input_config.txt", "r") or die("Impossible d'ouvrir le fichier!");
        while(!feof($cfgFile))
        {
            $this->applyParams(preg_replace('/\s/', '',fgets($cfgFile)));
        }
        fclose($cfgFile);
        if($GLOBALS["DEBUG"]){
            $this->map->printMap();
            echo "====== FIRST PRINT BEFORE START GAME =========<br>";
        }

        $this->startGame();
        $this->exportResults();
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
                if($GLOBALS["DEBUG"])
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
        if($GLOBALS["DEBUG"]) {
            echo 'applyParams ';
        }
        $cfgKeys = explode("-",$line);
        $key = substr($line,0,1);
            switch ($key)
            {
                case "C":
                    $this->map=Map::getInstance();
                    $this->map->initializeMap($cfgKeys[2],$cfgKeys[1]);
                    array_push($this->cellableInstances,$this->map);
                    break;

                case "M":
                    $tmp_mont = new Montagne($cfgKeys[2],$cfgKeys[1]);
                    array_push($this->cellableInstances,$tmp_mont);
                    break;

                case "T":
                    $tmp_tresor = new Tresor($cfgKeys[3],$cfgKeys[2],$cfgKeys[1]);
                    array_push($this->cellableInstances,$tmp_tresor);
                    break;

                case "A":
                    $tmp_advent = new Adventurer($cfgKeys[1],$cfgKeys[3],$cfgKeys[2],$cfgKeys[4],$cfgKeys[5]);
                    array_push($this->walkableInstances,$tmp_advent);
                    if(strlen($cfgKeys[5]) > $this->someAdventurerMaxSteps)
                    {
                        $this->someAdventurerMaxSteps = strlen($cfgKeys[5]);
                    }
                    array_push($this->cellableInstances,$tmp_advent);
                    break;

                case "G":
                    $tmp_gobelin = new Gobelin($cfgKeys[2],$cfgKeys[1],$cfgKeys[3],$cfgKeys[4]);
                    array_push($this->walkableInstances,$tmp_gobelin);
                    array_push($this->cellableInstances,$tmp_gobelin);
                    break;

                case "O":
                    $tmp_orc = new Orc($cfgKeys[2],$cfgKeys[1],$cfgKeys[3],$cfgKeys[4]);
                    array_push($this->walkableInstances,$tmp_orc);
                    array_push($this->cellableInstances,$tmp_orc);
                    break;

                default:
                    break;
            }

    }

    public function exportResults()
    {
        $ex_file = fopen('output_config.txt','w');
        foreach ($this->cellableInstances as $cell)
            fwrite($ex_file,$cell->getMyResults());

        fclose($ex_file);
    }

}