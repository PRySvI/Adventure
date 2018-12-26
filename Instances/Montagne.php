<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/02/18
 * Time: 6:07 AM
 */

require_once ('Map.php');

class Montagne extends Cellable
{

    public function __construct($Y, $X)
    {
        $this->map=Map::getInstance();
        $this->setMyMapPosition($Y, $X);
    }


    function getPrintName()
    {
       return "M";
    }


    function getMyInstance()
    {
        return $this;
    }

    public function getSortWeight()
    {
        return 4;
    }

    public function getMyResults()
    {
        $separator = " - ";
        $export_line = $this->getPrintName().$separator.$this->getInMapPositionX().$separator.$this->getInMapPositionY();
        return $export_line."\r\n";

    }
}