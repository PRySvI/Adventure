<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/19/18
 * Time: 6:08 AM
 */

require_once ($_SERVER['DOCUMENT_ROOT'] . '/Instances/models/Cellable.php');
//use \Cellable as Cellable;

class Plaine extends Cellable
{
    private $cellContainer;

    public function __construct($nY,$nX)
    {
        $this->cellContainer = array();
        $this->inMapPositionY = $nY;
        $this->inMapPositionX = $nX;
    }

    private function sortByPriority($a, $b)
    {
        return $b->getSortWeight() - $a->getSortWeight();

    }


    public function getPrintName()
    {

        if(count($this->cellContainer) > 0)
        {
            if(count($this->cellContainer) > 1)
                usort($this->cellContainer ,array($this, 'sortByPriority'));

            foreach ($this->cellContainer as $item)
            {
                return $item->getPrintName();
            }
        }
        else
        {
            return ".";
        }
    }


    function add($key)
    {
        if(!($key instanceof Cellable))
        {
            return;
        }

        if($key instanceof Plaine)
        {
            return;
        }

        if($key!=null)
        {
            array_push($this->cellContainer,$key);
        }
    }

    function remove($obj){

        unset($this->cellContainer[array_search($obj,$this->cellContainer)]);
    }

    function allowAdd($key)
    {
        if($this->cellContainer!=null && count($this->cellContainer)>0)
        {
            usort($this->cellContainer ,array($this, 'sortByPriority'));

            for($i=0 ; $i < count($this->cellContainer) ; $i++)
            {
                if(is_null($this->cellContainer[$i]) )
                    continue;


                $item = $this->cellContainer[$i];

                if($item instanceof Montagne)
                    return false;

                if($key instanceof Walkable)
                {

                    if($key instanceof $item)
                        return false;

                    if($key instanceof Adventurer && $item instanceof Adventurer)
                    {
                        return false;
                    }

                    if($key instanceof Monster && $item instanceof Adventurer || $key instanceof Adventurer && $item instanceof Monster)
                    {
                        if($item->getIsAlive() && $key->getIsAlive())
                            $key->fight($item);
                    }

                    if($key instanceof Adventurer && $item instanceof Tresor)
                    {
                        $key->levelUp();

                        $item->reduiceCount();

                        if($item->getCount()==0)
                        {
                            $item->deleteMe();
                            unset($this->cellContainer[$i]);
                        }
                    }

                    if($key instanceof Monster && $item instanceof Monster)
                        return false;



                }

            }
        }

        return true;
    }
    public function getMyResults()
    {
        $separator = " - ";
        $export_line = $this->getPrintName().$separator.$this->getInMapPositionY().$separator.$this->getInMapPositionX();
        return $export_line."\r\n";

    }
   public function getSortWeight()
    {
        return 0;
    }
}