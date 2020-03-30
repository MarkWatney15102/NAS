<?php 

namespace src\Structure\Routing;

use src\Service\LoginChecker\LoginChecker;

class Routing
{
    /**
     * @var string
     */
    protected $uri;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function rout(array $routes) 
    {
        foreach($routes as $route) {
            foreach ($route['request'] as $request) {
                if ((string)$request === (string)$this->uri) {
                    $controllerName = $route['controllerName'];
                    $action = $route['action'];
                    $accessLevel = $route['accessLevel'];

                    LoginChecker::isLoggedIn();

                    $class = "\\src\\Controller\\{$controllerName}\\{$controllerName}";
                    $controller = new $class;
                    $controller->$action();
                } else {
                    continue;
                }
            }
        }
    }

    public static function getSubroutingCount()
    {
        $routSeperation = explode("/", $_SERVER['REQUEST_URI']);
        unset($routSeperation[0]);

        return count($routSeperation);
    }
}
