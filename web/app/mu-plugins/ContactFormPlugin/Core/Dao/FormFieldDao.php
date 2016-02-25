<?php


namespace ContactFormPlugin\Core\Dao;


use ContactFormPlugin\Core\Entity\FormFieldEntity;

class FormFieldDao extends BaseDao{
    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }

    public function arrayToEntities($fieldsArray){
        $formFieldsEntities = [];
        foreach($fieldsArray as $field){
            $formField = new FormFieldEntity(
                uniqid(),
                $field['field_input_type'],
                $field['form_field_name'],
                $field['field_input_type'],
                $field['short_description_en'],
                $field['required']
            );
            if(!empty($field['long_description_en'])){
                $formField->setEnglishLongDescription($field['long_description_en']);
            }
            if(!empty($field['long_description_he'])){
                $formField->setHebrewLongDescription($field['long_description_he']);
            }
            if(!empty($field['short_description_he'])){
                $formField->setHebrewShortDescription($field['short_description_he']);
            }
            if(!empty($field['field_options'])){
                $formField->setOptionFields($field['field_options']);
            }

            $formFieldsEntities[] = $formField;
        }
        return $formFieldsEntities;

    }


}