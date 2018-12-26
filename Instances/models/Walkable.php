<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/18/18
 * Time: 10:19 PM
 */

require_once ($_SERVER['DOCUMENT_ROOT'] . '/Instances/models/Cellable.php');

abstract class Walkable implements Cellable
{

    protected $isAlive = true;
    protected $inMapPositionY;
    protected $inMapPositionX;
    protected $level;
    protected $map;

    abstract public function goToNextStep($nextIterationStep);
    public function fight($enemy)
    {
        //all walakable (exeption Adventurer) fight method
        echo $this->getPrintName()." fight";
        if($this->level > $enemy->getLevel())
        {
            $enemy->doDie();
        }
        else
        {
            $this->doDie();
        }
    }
    public function getInMapPositionY()
    {
        return $this->inMapPositionY;
    }

    public function getInMapPositionX()
    {
        return $this->inMapPositionX;
    }

    function setMyMapPosition($newY, $newX)
    {
        $this->inMapPositionY = $newY;
        $this->inMapPositionX = $newX;
        $this->map->initCell($this, $newY, $newX);
    }

    function getMyInstance()
    {
        return $this;
    }

    function getLevel(){
        return $this->level;
    }

    function getIsAlive()
    {
        return $this->isAlive;
    }

    public function getSortWeight()
    {
        return ($this->getIsAlive() == true ? 3 : 1);
    }

    public function doDie()
    {
        $this->isAlive=false;
    }
}