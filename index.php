
<?php

define('WEBROOT', str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', dirname(__file__));

require(ROOT . 'Config/core.php');
require(ROOT . 'router.php');
require(ROOT . 'request.php');
require(ROOT . 'dispatcher.php');

$dispatch = new Dispatcher();
$dispatch->dispatch();
?>
