<?php

namespace SearchPlugin\Core\Dao;


use SearchPlugin\Core\Entity\SearchEntity;

class SearchDao extends BaseDao{

    private  static $instance;
    private  $searchText;


    final private function __construct(){

    }
    final public static function getInstance($searchText){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        self::$instance->setSearchText($searchText);
        return  self::$instance;
    }

    /**
     * @param mixed $searchText
     */
    public function setSearchText($searchText)
    {

        $this->searchText = strtolower($searchText);
    }

    public function getPostsByMeta(){
        $postTypes = get_post_types();
        $query = new \WP_Query(
           [
            'meta_value'=>$this->searchText,
            'meta_compare'=>'LIKE',
            'order'=>'DESC',
            'orderby'=>'date',
            'post_type'=>$postTypes
           ]
        );
        $searchEntities = $this->postsToEntities($query->posts);
        return $searchEntities;
    }

    private  function postsToEntities($posts){
        $searchEntities = [];
        foreach($posts as $post){
            $customFields  = get_fields($post->ID);
            $matchedField = "";
            foreach($customFields as $key=>$value) {
                if (is_string($value)&&!empty($value)&&strpos(strtolower($value),$this->searchText) !== false) {
                    $matchedText = strip_tags($value);
                    $pattern =  '/('.$this->searchText.')/si';
                    $matchedField = preg_replace($pattern,' <span>$1</span> ',$matchedText);
                }
            }

//
            $searchEntity=  new SearchEntity(
                $post->ID,
                $post->post_title,
                $matchedField,
                get_post_permalink($post->ID)
            );
            $searchEntities[] = $searchEntity;
        }
        return $searchEntities;
    }


}