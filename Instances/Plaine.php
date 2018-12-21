<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/19/18
 * Time: 6:08 AM
 */

require_once ($_SERVER['DOCUMENT_ROOT'] . '/Instances/models/Cellable.php');
//use \Cellable as Cellable;

class Plaine implements Cellable
{
    public function collapse()
    {
        // TODO: Implement collapse() method.
    }

    public function setMyMapPosition($X, $Y)
    {
        // TODO: Implement setMyMapPosition() method.
    }

    public function getPrintName()
    {
        return ".";
    }

    function getMyInstance()
    {
        return $this;
    }
}