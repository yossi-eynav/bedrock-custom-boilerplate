<?php


namespace MainPlugin\Core\Dao\WPModulesDao;


use MainPlugin\Core\DesignPatterns\SingletonPattern;

class ACFDao extends SingletonPattern{



    public function addFilters(){
        add_filter("acf/format_value/type=post_object", [$this,"filterPostType"], 10, 3);
        add_filter("acf/format_value/type=taxonomy", [$this,"filterTaxonomyType"], 10, 3);
    }


    public function filterPostType($postArray, $post_id, $field){
        if(is_array($postArray)){
            foreach($postArray as &$post){
                $post->custom_fields = get_fields($post->ID);
            }
        }
        else {
            $postArray->custom_fields = get_fields($postArray->ID);
        }
        return $postArray;
    }


    public function filterTaxonomyType($termsArray, $post_id, $field){

        if(is_array($termsArray)){
            foreach($termsArray as &$term){
                $term = WPTaxonomyDao::getInstance()->getTermCustomFields($term);
            }
            return $termsArray;
        }
        else {
            $term = WPTaxonomyDao::getInstance()->getTermCustomFields($termsArray);
            return $term;
        }
    }

}