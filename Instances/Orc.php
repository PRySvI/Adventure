<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/19/18
 * Time: 6:11 AM
 */

require_once ("models/Monster.php");

class Orc extends Monster
{
    function initDir()
    {
        $this->direction = "S";
    }


    function getPrintName()
    {
        if($GLOBALS["DEBUG"]){

            $dead = "";
            if (!($this->getIsAlive())) {
                $dead = " (x_x)";
            }
            return "O" . $dead;
        }
        return "O";

    }

    function revert_direction()
    {
        if ($this->direction == 'S') {
            $this->direction = 'N';
        } else {
            $this->direction = 'S';
        }
    }

    function moveForward()
    {

        $tmpX = $this->inMapPositionX;
        $tmpY = $this->inMapPositionY;

        switch ($this->direction) {

            case 'S':
                $tmpY++;
                break;

            case 'N':
                $tmpY--;
                break;

            default:
                break;
        }

        $this->map->checkAndPlace($this, $tmpY, $tmpX);

        if($GLOBALS["DEBUG"])
            $this->map->printMap(); //dubug
    }

}