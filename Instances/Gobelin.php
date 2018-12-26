<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/19/18
 * Time: 6:11 AM
 */
require_once ("models/Monster.php");

class Gobelin extends Monster
{

    function initDir(){
        $this->direction = 'E';
    }

    function getPrintName()
    {
        if($GLOBALS["DEBUG"]){

            $dead = "";
            if (!($this->getIsAlive())) {
                $dead = " (x_x)";
            }
            return "G" . $dead;
        }

        return "G";

    }

    function revert_direction()
    {
        if($this->direction == 'E')
        {
            $this->direction='O';
        }
        else
        {
            $this->direction='E';
        }
    }

    function moveForward()
    {

        $tmpX=$this->inMapPositionX;
        $tmpY=$this->inMapPositionY;

        switch ($this->direction)
        {
            case 'E':;
                $tmpX++;
                break;

            case 'O':
                $tmpX--;
                break;

            default:
                break;
        }


        $this->map->checkAndPlace($this,$tmpY,$tmpX);

        if($GLOBALS["DEBUG"])
            $this->map->printMap(); //dubug
    }

}