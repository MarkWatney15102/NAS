<?php
require $_SERVER['DOCUMENT_ROOT'] . "/autoloader.php";

use config\Config\Config;
use src\Structure\Heading\Heading\Heading;
use src\Structure\Routing\Routing;
use src\Structure\Header\Header;

$config = Config::getInstance();
$config->init();

if (!Routing::checkApiCall()) { ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <?php
            $header = new Header();
            $header->loadCssFiles();
            $header->loadJsFiles();
            $header->loadHeaderInformation();
            ?>
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
<?php } else { ?>
    <?php
        $routing = new Routing($config->getRoutes());
        $routing->rout();
    ?>
<?php } ?>