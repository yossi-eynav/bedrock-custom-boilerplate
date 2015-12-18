<?php

namespace MainPlugin\Core\WPModules;


use MainPlugin\Core\DesignPatterns\SingletonPattern;
use MainPlugin\Core\Dao\WPTaxonomyDao;

class WPTaxonomyService extends SingletonPattern{

    public function registerTaxonomy($taxonomy,$postSlug){
     WPTaxonomyDao::getInstance()->registerTaxonomy($taxonomy,$postSlug);
    }


    public  function  getTermsByTaxonomies($taxonomies){
       return WPTaxonomyDao::getInstance()->getTermsByTaxonomies($taxonomies);
    }

    public  function  getTermCustomFields($termObject){
        return WPTaxonomyDao::getInstance()->getTermCustomFields($termObject);
    }

    public static function termsArrayToString($termsArray,$prefix=""){
        if(sizeof($termsArray)===0){
            return "";
        }
        else if(sizeof($termsArray)===1){
            $termID =  is_array($termsArray)?array_pop($termsArray)->term_id : $termsArray->term_id;
            return $prefix.$termID;
        }
        else{
            return implode('  ',array_map(function($term) use ($prefix){return $prefix.$term->term_id;},$termsArray));
        }
    }


}