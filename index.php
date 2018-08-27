
<?php


if(isset($_GET['devel']) && $_GET['devel'] == 'true'){
	
	error_reporting( E_ALL );
	ini_set('display_errors', '1');
}
define('WEBROOT', str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', dirname(__file__).DIRECTORY_SEPARATOR);

require(ROOT . 'Config/core.php');
require(ROOT . 'router.php');
require(ROOT . 'request.php');
require(ROOT . 'dispatcher.php');

$dispatch = new Dispatcher();
$dispatch->dispatch();
?>
