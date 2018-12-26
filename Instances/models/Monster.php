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

    public function __construct($Y, $X, $steps , $lvl)
    {
        $this->map=Map::getInstance();
        $this->setMyMapPosition($Y, $X);
        $this->route_steps=$steps;
        $this->level=$lvl;
        $this->initDir();
        $this->steps_count=0;
    }

    public function goToNextStep($nextIteration)
    {
        if(!($this->getIsAlive()))
            return;

       // echo $this->getPrintName()." move dir ".$this->direction . "<br>";
       // echo "<br> steps cnt ".$this->steps_count."<br>";



        $this->moveForward();
        $this->steps_count++;

        if($this->steps_count == $this->route_steps)
        {

            $this->revert_direction();
            $this->steps_count = 0;
        }

    }

    abstract function revert_direction();
    abstract function moveForward();
    abstract function initDir();
}