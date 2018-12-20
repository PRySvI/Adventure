<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/19/18
 * Time: 6:06 AM
 */

class Tresor implements Cellable
{
    private $count=0;

    private $map;

    public function __construct($count,$Y, $X)
    {
        $this->count=$count;
        $this->map=Map::getInstance();
        $this->setMyMapPosition($Y, $X);
    }

    function collapse()
    {
        // TODO: Implement collapse() method.
    }

    function setMyMapPosition($Y, $X)
    {
        $this->map->initCell($this,$Y, $X);
    }

    function getPrintName()
    {
        return "T"."(".$this->count.")";
    }
}