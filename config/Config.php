<?php

namespace config\Config;

use src\Helper\Singleton\Singleton;
use src\Service\JsonParser\JsonParser;

class Config extends Singleton
{

    /**
     * @var array
     */
    protected $routes;

    public function init(): void
    {
        $this->loadRoutes();
    }

    private function loadRoutes(): void
    {
        $routes = JsonParser::parseJsonFile($_SERVER['DOCUMENT_ROOT'] . "/routes.json");

        foreach ($routes as $route) {
            $this->routes[$route->name] = [
                "request" => $route->request,
                "controllerName" => $route->controllerName,
                "action" => $route->action,
                "neededPermission" => $route->neededPermission
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
