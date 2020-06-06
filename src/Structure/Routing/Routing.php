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
        $this->uri = $this->removeParams($_SERVER['REQUEST_URI']);
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
                    $dev = $route['dev'];

                    LoginChecker::isLoggedIn();

                    if ((int)$route['neededPermission'] !== 0) {
                        if (PermissionHelper::hasPerm($route['neededPermission'])) {
                            $this->routing($controllerName, $action, $param);
                        } else {
                            Redirect::to("/noPermissions");
                        }
                    } else {
                        if ((int)$dev === 1) {
                            if (PermissionHelper::isDev($_COOKIE['UID'])) {
                                $this->routing($controllerName, $action, $param);
                            } else {
                                echo 'No Dev';
                            }
                        } else {
                            $this->routing($controllerName, $action, $param);
                        }
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

    public static function checkApiCall(): bool
    {
        $rout = $_SERVER['REQUEST_URI'];

        $routSplit = explode("/", $rout);

        if ($routSplit[1] === 'api') {
            return true;
        }

        return false;
    }

    /**
     * @param string $rout
     * @return string
     */
    private function removeParams(string $rout): string
    {
        $pattern = "/(\?_=)\w+/";
        return preg_replace($pattern, "", $rout);
    }
}
