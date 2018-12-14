<!DOCTYPE html>
<html>
<body>
<div style="text-align:center;padding-left: 550px ;padding-top: 100px">
<?php
//start:sss
require ($_SERVER['DOCUMENT_ROOT'] . '/Controllers/MapController.php');
//use \Controllers\MapController as MapController;
$mapContoller =  MapController::getInstance();
$mapContoller->loadCfg("map.cfg");
?>
</div>
</body>
</html>