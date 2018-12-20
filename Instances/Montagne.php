<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/19/18
 * Time: 6:07 AM
 */
require_once ('Map.php');
class Montagne implements Cellable
{
    private $map;

    public function __construct($Y, $X)
    {
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
       return "M";
    }
}