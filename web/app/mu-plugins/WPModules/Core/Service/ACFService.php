<?php


namespace WPModules\Core\Service;



use WPModules\Core\Dao\ACFDao;

class ACFService{


    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }

    public function getOptionPageFieldByLanguage($fieldName){
        $currentLang = PolylangService::getInstance()->getCurrentLang();
        return get_field($fieldName.'_'.$currentLang,"option");
    }

    public function addOptionPages(array $pagesNames){
        ACFDao::getInstance()->addOptionPages($pagesNames);
    }

    public function addFilters(){
        ACFDao::getInstance()->addFilters();

    }

    private function setFieldsOptions(&$fieldsOptions){
        foreach($fieldsOptions as &$fieldOptions){
            foreach($fieldOptions as $fieldKey=>$fieldValue){
                if(!isset($fieldOptions['name'])){
                    die("ACF field registration failed. Please send in the field options the field name");
                }
                if(!isset($fieldOptions['type'])){
                    $fieldOptions['type'] = "text";
                }
                if(!isset($fieldOptions['required'])){
                    $fieldOptions['required'] = 1;
                }
                $fieldOptions['key'] = 'field_'.$fieldOptions['name'];
                $fieldOptions['label'] = ucwords(str_replace('_',' ',$fieldOptions['name']));



           }
        }
    }

    public function registerCustomFields($groupName,$fieldsOptions,$location){
        $this->setFieldsOptions($fieldsOptions);
        ACFDao::getInstance()->registerCustomFields($groupName,$fieldsOptions,$location);
    }
    public function registerRepeaterCustomFields($repeaterFieldKey,$fieldsOptions){
        $this->setFieldsOptions($fieldsOptions);
        ACFDao::getInstance()->registerRepeaterFields($repeaterFieldKey,$fieldsOptions);
    }


}