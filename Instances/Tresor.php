<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/19/18
 * Time: 6:06 AM
 */
require_once ($_SERVER['DOCUMENT_ROOT'] . '/Controllers/MapController.php');
class Tresor extends Cellable
{
    private $count=0;

    public function __construct($count,$Y, $X)
    {
        $this->count=$count;
        $this->map=Map::getInstance();
        $this->setMyMapPosition($Y, $X);
    }



    function getPrintName()
    {
        if($GLOBALS["DEBUG"])
            return "T"."(".$this->count.")";

        return "T";
    }


    function getMyInstance()
    {
        return $this;
    }

    function getCount()
    {
        return $this->count;
    }

    function reduiceCount()
    {
        if($this->count > 0)
        {
            $this->count--;
        }
    }

    public function getSortWeight()
    {
        return 2;
    }

    public function getMyResults()
    {
        $separator = " - ";
        $export_title="# {T comme Trésor} - {Axe horizontal} - {Axe vertical} - {Nb. de trésors restants}";
        $export_line = $this->getPrintName().$separator.$this->getInMapPositionX().$separator.$this->getInMapPositionY().$separator.$this->count;
        return $export_title."\r\n".$export_line."\r\n";

    }

    public function deleteMe()
    {
        $mapContoller =  MapController::getInstance();
        $mapContoller->removeFromCellables($this);
    }
}