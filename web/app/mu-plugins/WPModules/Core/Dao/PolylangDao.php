<?php

namespace WPModules\Core\Dao;


use WPModules\Core\Service\PostService;

class PolylangDao{

    private  static $instance;
    private $_customTaxonomies = [];

    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }



    public function registerString($string){
        pll_register_string("BenAndJerrys", $string, "BenAndJerrys");
    }



    public function addFilters(){
        add_filter('pll_get_taxonomies',[$this,'addTaxonomiesToPll'] , 10, 2);
    }

    /**
     * @param mixed $customTaxonomies
     */
    public function setCustomTaxonomies(array $customTaxonomies){
        foreach($customTaxonomies as $customTaxonomy){
            $this->_customTaxonomies[] = $customTaxonomy;
        }
    }

    function addTaxonomiesToPll($taxonomies) {
        foreach ($this->_customTaxonomies as $customTaxonomy) {
            $taxonomies[$customTaxonomy] = $customTaxonomy;
        }
        return $taxonomies;
    }

    public function  getCurrentLang(){
        return pll_current_language();
    }

    public function getTranslatedString($string){
        return  pll__($string);
    }

    public function getTranslatedTerm($termID){
        return pll_get_term($termID);
    }

    public function getTranslatedPost($postID){
        return pll_get_post($postID);
    }

    public function getLangSwitcher($args){
        return  pll_the_languages($args);
    }

    public function createSearchPage(){
        return PostDao::createPost("page","SearchPage","SearchPage");

    }
}