<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/19/18
 * Time: 6:11 AM
 */
require_once ("models/Monster.php");

class Gobelin extends Walkable implements Monster
{
    private $map;
    private $direction;

    public function __construct($Y, $X)
    {
        $this->map=Map::getInstance();
        $this->setMyMapPosition($Y, $X);
    }

    public function goToNextStep($nextIterationStep)
    {
        // TODO: Implement goToNextStep() method.
    }

    public function fight($enemy)
    {
        // TODO: Implement fight() method.
    }

    function getPrintName()
    {
        $dead= "";
        if(!($this->getIsAlive()))
        {
            $dead = " (x_x)";
        }
        return "G".$dead;
    }

    public function checkMoveRights($X, $Y)
    {
        // TODO: Implement checkMoveRights() method.
    }

    function setMyMapPosition($Y,$X)
    {
        $this->map->initCell($this,$Y, $X);
    }

}