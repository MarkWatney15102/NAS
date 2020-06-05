<?php

namespace src\Helper\Singleton;

abstract class Singleton 
{
    protected static $instance = [];

    public static function getInstance(string $className = ''){
        if ($className === '') {
            $class = get_called_class();
        } else {
            $class = $className;
        }
        if(!isset(self::$instance[$class]) || !self::$instance[$class] instanceof $class){
            self::$instance[$class] = new static();
        }
        return static::$instance[$class];
    }

    protected function __construct() {}
    private function __clone() {}
    private function __sleep() {}
    private function __wakeup() {}
}