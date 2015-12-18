<?php

namespace MainPlugin\Core\DesignPatterns;

abstract class SingletonPattern{

    private static $instances = [];

    final private function __construct(){}

    final public static function getInstance(){
        $class = get_called_class();
        if(!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;

            if(method_exists(self::$instances[$class],'init')){
                self::$instances[$class]->init();

            }
        }
        return  self::$instances[$class];
    }

}