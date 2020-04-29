<?php
require $_SERVER['DOCUMENT_ROOT'] . "/autoloader.php";

use config\Config\Config;
use src\Structure\Heading\Heading\Heading;
use src\Structure\Routing\Routing;
use src\Structure\Header\Header;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $config = Config::getInstance();
    $config->init();

    $header = new Header();
    $header->loadCssFiles();
    $header->loadJsFiles();
    ?>
    <meta charset="UTF-8">
</head>
<body>
<?php
$heading = new Heading();
$heading->loadHeading();

$routing = new Routing($config->getRoutes());
$routing->rout();

?>
</body>
</html>
