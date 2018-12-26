<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/18/18
 * Time: 10:19 PM
 */
require_once ($_SERVER['DOCUMENT_ROOT'] . '/Instances/models/Cellable.php');
abstract class Walkable extends Cellable
{

    protected $isAlive = true;
    protected $level;

    abstract public function goToNextStep($nextIterationStep);
    abstract function moveForward();

    public function fight($enemy)
    {
        //all walakable (exeption Adventurer) fight method
        if($GLOBALS["DEBUG"])
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