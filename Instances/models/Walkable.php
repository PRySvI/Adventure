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

    private $isAlive = true;
    private $inMapPositionY;
    private $inMapPositionX;
    private $level;
    private $inFight;
    private $map;

    abstract public function goToNextStep($nextIterationStep);
    abstract public function fight();
    abstract public function checkMoveRights($X , $Y);

}