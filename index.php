<!DOCTYPE html>
<html>
<body>
<div style="text-align:center;padding-top: 100px">
<?php
require 'Controllers/MapContoller.php';
$mapContoller =  new MapContoller();
$mapContoller->loadCfg("map.cfg");
?>
</div>
</body>
</html>