<?php

namespace MainPlugin\Core\WPModules;


use MainPlugin\Core\DesignPatterns\SingletonPattern;
use MainPlugin\Core\Dao\WPModulesDao\TaxonomyDao;

class WPTaxonomyService extends SingletonPattern{

    public function registerTaxonomy($taxonomy,$postSlug){
        TaxonomyDao::getInstance()->registerTaxonomy($taxonomy,$postSlug);
    }


    public  function  getTermsByTaxonomies($taxonomies){
       return TaxonomyDao::getInstance()->getTermsByTaxonomies($taxonomies);
    }

    public  function  getTermCustomFields($termObject){
        return TaxonomyDao::getInstance()->getTermCustomFields($termObject);
    }


}