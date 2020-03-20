<?php 

require $_SERVER['DOCUMENT_ROOT'] . "/autoloader.php";

use config\Config\Config;
use src\Service\Routing\Routing;
use src\Models\UserModel\UserModel;

$config = Config::getInstance();
$config->init();

$routing = new Routing();
$routing->rout($config->getRoutes());