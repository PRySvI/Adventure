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
        {
            $str = preg_replace('/\s/', '',fgets($cfgFile));
            $this->applyParams(explode("-",$str));
        }
        fclose($cfgFile);
    }

    public function applyParams($arr)
    {
        if($this->debug) {
            echo 'applyParams '.'<br>'.$arr[0].'<br>'.$arr[1].'<br>'.$arr[2].'<br>'.'+++++++++++++'.'<br>';
        }

            switch ($arr[0])
            {
                case "C​":
                    $this->map=new Map($arr[1],$arr[2]);
                    $this->map->printMap();
                    break;
            }

    }

}