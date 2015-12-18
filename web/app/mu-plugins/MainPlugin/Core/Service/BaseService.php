<?php

namespace MainPlugin\Core\Service;

use MainPlugin\Core\DesignPatterns\SingletonPattern;

abstract class BaseService extends SingletonPattern{

    abstract function getAllEntities();

}