<?php


namespace MainPlugin\Core\Dao;


use MainPlugin\Core\Dao\WPModulesDao\PostDao;
use MainPlugin\Core\DesignPatterns\SingletonPattern;

abstract class BaseDao extends SingletonPattern{

    public function getAllItems(){
        $postsArray = PostDao::getAllCustomPostsBySlug(static::CUSTOM_POST_TYPE_SLUG);
        $iceCreamsArray =  $this->postsArrayToEntities($postsArray);
        return $iceCreamsArray;
    }
    abstract function postsArrayToEntities($postsArray);

    public  function getEntityByID($ID){
        $post =  PostDao::getPostByID($ID);
        if($post){
            $entity = static::postsArrayToEntities([$post]);
            return array_pop($entity);
        }
        else{
            return [];
        }
    }
}