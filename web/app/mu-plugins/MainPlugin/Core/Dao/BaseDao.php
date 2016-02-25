<?php


namespace MainPlugin\Core\Dao;



use WPModules\Core\Dao\PostDao;

abstract class BaseDao{


    public function getAllItems($customPostTypeSlug){
        $postsArray = PostDao::getAllCustomPostsBySlug($customPostTypeSlug);
        $entitiesArray =  $this->postsArrayToEntities($postsArray);
        return $entitiesArray;
    }
    abstract function postsArrayToEntities($postsArray);

    public  function getEntityByID($ID){
        $post =  PostDao::getPostByID($ID);
        if($post){
            $entity = $this->postsArrayToEntities([$post]);
            return array_pop($entity);
        }
        else{
            return [];
        }
    }

}