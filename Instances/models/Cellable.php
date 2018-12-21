<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/18/18
 * Time: 10:04 PM
 */

interface Cellable
{
    function collapse();
    function setMyMapPosition($Y,$X);
    function getPrintName();
    function getMyInstance();
}