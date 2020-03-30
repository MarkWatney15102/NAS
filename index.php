<?php
    require $_SERVER['DOCUMENT_ROOT'] . "/autoloader.php";

    use config\Config\Config;
    use src\Structure\Routing\Routing;
    use src\Structure\Header\Header;
    use src\Models\UserModel\UserModel;
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
            $routing = new Routing();
            $routing->rout($config->getRoutes());
        ?>
    </body>
</html>
