<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/19/18
 * Time: 6:05 AM
 */

abstract class Monster extends Walkable
{

    protected $route_steps;
    public $steps_count = 0;
    protected $direction;
    protected $fights_cnt = 0;


    public function __construct($Y, $X, $steps , $lvl)
    {
        $this->map=Map::getInstance();
        $this->setMyMapPosition($Y, $X);
        $this->route_steps=$steps;
        $this->level=$lvl;
        $this->initDir();
        $this->steps_count = 0;
    }

    public function goToNextStep($nextIteration)
    {
        if(!($this->getIsAlive()))
            return;

        $this->moveForward();
        $this->steps_count++;

        if($this->steps_count == $this->route_steps)
        {

            $this->revert_direction();
            $this->steps_count = 0;
        }

    }

    function fight($enemy)
    {
        $this->fights_cnt++;
        parent::fight($enemy);
    }

    public function getMyResults(){
        $separator = " - ";
        $export_title="# {".$this->getPrintName()." "."comme ".($this->getPrintName()=='G'?"Gobelin":"Orc")."} - {Axe horizontal} - {Axe vertical} - {Etat D -> dead L -> Live} {Nb combat effectué}";
        $export_line = $this->getPrintName().$separator.$this->getInMapPositionX().$separator.$this->getInMapPositionY().$separator.($this->isAlive ? "L":"D").$separator.$this->fights_cnt;
        return $export_title."\r\n".$export_line."\r\n";
    }

    abstract function revert_direction();
    abstract function initDir();
}