<?php

namespace WPModules\Core\Service;


use WPModules\Core\Dao\TaxonomyDao;

class TaxonomyService{

    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }


    public  function  getTermsByTaxonomies($taxonomies){
       return TaxonomyDao::getInstance()->getTermsByTaxonomies($taxonomies);
    }

//    public  function  getTermCustomFields($termObject){
//        return WPTaxonomyDao::getInstance()->getTermCustomFields($termObject);
//    }

        public function createTerms($terms,$taxonomy){
            foreach($terms as $term){
                TaxonomyDao::getInstance()->createTerm($term,$taxonomy);
            }
        }

    public function getTermBySlug($slug,$taxonomy){
        TaxonomyDao::getInstance()->getTerm("slug",$slug,$taxonomy);
    }



}