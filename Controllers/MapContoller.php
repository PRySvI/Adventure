<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/7/18
 * Time: 6:20 PM
 */

require ($_SERVER['DOCUMENT_ROOT'] . '/Instances/Map.php');

class MapContoller
{
    private $debug = false;
    private $map;

    public function loadCfg($path)
    {
        $cfgFile = fopen($path, "r") or die("Impossible d'ouvrir le fichier!");
        while(!feof($cfgFile))
        {;
            $this->applyParams(preg_replace('/\s/', '',fgets($cfgFile)));
        }
        $this->map->printMap();
        fclose($cfgFile);
    }

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
                     $this->map=new Map($cfgKeys[1],$cfgKeys[2]);
                    break;

                case "M":
                    $this->map->initCell($cfgKeys[0],$cfgKeys[1],$cfgKeys[2]);
                    break;

                case "T":
                    $this->map->initCell($cfgKeys[0]."($cfgKeys[3])",$cfgKeys[1],$cfgKeys[2]);
                    break;
                default:
                    break;
            }
            echo "<br>";

    }

}