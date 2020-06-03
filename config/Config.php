<?php

namespace config\Config;

use src\Helper\Singleton\Singleton;
use src\Service\JsonParser\JsonParser;
use src\Service\LoginChecker\LoginChecker;
use src\Structure\Permission\Permissions\Permissions;

class Config extends Singleton
{

    /**
     * @var array
     */
    protected $routes;

    public function init(): void
    {
        $this->loadRoutes();

        if (LoginChecker::isUserLoggedIn()) {
            $permissions = new Permissions($_COOKIE['UID']);
        }
    }

    private function loadRoutes(): void
    {
        $routes = JsonParser::parseJsonFile($_SERVER['DOCUMENT_ROOT'] . "/routes.json");

        foreach ($routes as $route) {
            $this->routes[$route->name] = [
                "request" => $route->request,
                "controllerName" => $route->controllerName,
                "action" => $route->action,
            ];
        }
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
