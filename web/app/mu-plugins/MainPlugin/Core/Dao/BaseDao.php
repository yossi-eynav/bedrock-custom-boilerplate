<?php


namespace MainPlugin\Core\Dao;


use MainPlugin\Core\DesignPatterns\SingletonPattern;

abstract class BaseDao extends SingletonPattern{

    abstract function getAllItems();
    abstract function postsArrayToEntities($postsArray);
}