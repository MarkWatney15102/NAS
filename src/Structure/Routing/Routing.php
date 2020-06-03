<?php 

namespace src\Structure\Routing;

use src\Service\LoginChecker\LoginChecker;
use src\Service\Redirect\Redirect;
use src\Structure\Header\PermissionHelper\PermissionHelper;

class Routing
{
    /**
     * @var string
     */
    protected $uri;

    /**
     * @var array
     */
    protected $routes;

    /**
     * Routing constructor.
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->routes = $routes;
    }

    public function rout(): void
    {
        preg_match("/\d+/", $this->uri, $matches);
        $param = $matches[0] ?? "";
        foreach($this->routes as $route) {
            foreach ($route['request'] as $request) {
                $this->uri = preg_replace("/\d+/", "", $this->uri);
                if ((string)$request === (string)$this->uri) {
                    $controllerName = $route['controllerName'];
                    $action = $route['action'];

                    LoginChecker::isLoggedIn();

                    if ((int)$route['neededPermission'] !== 0) {
                        if (PermissionHelper::hasPerm($route['neededPermission'])) {
                            $this->routing($controllerName, $action, $param);
                        } else {
                            Redirect::to("/noPermissions");
                        }
                    } else {
                        $this->routing($controllerName, $action, $param);
                    }
                } else {
                    continue;
                }
            }
        }
    }

    private function routing(string $controllerName, string $action, string $param): void
    {
        $class = "\\src\\Controller\\{$controllerName}\\{$controllerName}";
        $controller = new $class;
        $controller->$action($param);
    }

    /**
     * @return int
     */
    public static function getSubroutingCount(): int
    {
        $routSeparation = explode("/", $_SERVER['REQUEST_URI']);
        unset($routSeparation[0]);

        return count($routSeparation);
    }
}
