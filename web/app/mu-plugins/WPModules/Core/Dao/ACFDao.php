<?php


namespace WPModules\Core\Dao;



class ACFDao{


    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }


    public function addFilters(){
        add_filter("acf/format_value/type=post_object", [$this,"addCustomFieldsToPost"], 10, 3);
        add_filter("acf/format_value/type=taxonomy", [$this,"addCustomFieldsToTaxonomy"], 10, 3);
    }


    public function addCustomFieldsToPost($postArray, $post_id, $field){
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



    public function registerRepeaterFields($repeaterFieldKey,array $fieldOptions){
        foreach($fieldOptions as $fieldOption){
            $fieldOption['parent'] = $repeaterFieldKey;
            acf_add_local_field($fieldOption);
        }
}

    public function registerCustomFields($groupName,$fieldsSets,$location){

        $displayedName = ucwords(str_replace('_',' ',$groupName));
        $groupName= strtolower($groupName);

        acf_add_local_field_group(array(
            'key' => "group_$groupName",
            'title' => "$displayedName",
            'fields' =>$fieldsSets,
            'location' => array (
                array (
                    $location
                )
            )
        ));
    }


    /** Add the ACF option page  */
    public function addOptionPages($pagesNames){
        foreach($pagesNames as $pageName){
            acf_add_options_page($pageName);
        }
    }


    public function addCustomFieldsToTaxonomy($termsArray, $post_id, $field){
        if(is_array($termsArray)){
            foreach($termsArray as &$term){
                $term = TaxonomyDao::getInstance()->getTermCustomFields($term);
            }
            return $termsArray;
        }
        else {
            $term = TaxonomyDao::getInstance()->getTermCustomFields($termsArray);
            return $term;
        }
    }

}