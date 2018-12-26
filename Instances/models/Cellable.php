<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/18/18
 * Time: 10:04 PM
 */
require_once ($_SERVER['DOCUMENT_ROOT'] . '/Instances/models/Sortable.php');

interface Cellable extends Sortable
{
    function setMyMapPosition($Y,$X);
    function getPrintName();
    function getMyInstance();
}