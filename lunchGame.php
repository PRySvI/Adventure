<?php
/**
 * Created by PhpStorm.
 * User: Sviatoslav Prylutsky
 * Date: 12/26/18
 * Time: 2:22 PM
 */
require ('Controllers/MapController.php');
$mapContoller =  MapController::getInstance();
$mapContoller->loadCfg();
?>