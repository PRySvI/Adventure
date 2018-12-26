<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/18/18
 * Time: 10:04 PM
 */
require_once ('./Instances/models/Sortable.php');

abstract class Cellable implements Sortable
{
    protected $inMapPositionY;
    protected $inMapPositionX;
    protected $map;


    abstract function getPrintName();
    abstract function getMyResults();

    function setMyMapPosition($Y, $X)
    {
        $this->inMapPositionY = $Y;
        $this->inMapPositionX = $X;
        $this->map->initCell($this,$Y, $X);
    }

    public function getInMapPositionY()
    {
        return $this->inMapPositionY;
    }

    public function getInMapPositionX()
    {
        return $this->inMapPositionX;
    }

    public function getMyInstance()
    {
        return $this;
    }
}
