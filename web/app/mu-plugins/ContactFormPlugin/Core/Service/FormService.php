<?php

namespace ContactFormPlugin\Core\Service;


use ContactFormPlugin\Core\Entity\FormSubmissionEntity;
use WPModules\Core\Service\ACFService;

class FormService extends BaseService{

    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }

    public function registerFormACF(){
        $ACFService = ACFService::getInstance();
        $ACFService->registerCustomFields(
            "form",
            [
                ['name' => 'title_en'],
                ['name' => 'main_paragraph_en'],
                ['name' => 'title_he','required'=>0],
                ['name' => 'main_paragraph_he','required'=>0],
                ['name' => 'thank_you_message_en'],
                ['name' => 'thank_you_message_he','required'=>0],
                ['name' => 'main_paragraph_he','required'=>0],
                ['name' => 'form_fields', 'type' => 'repeater'],
            ],
            ['param' => 'taxonomy', 'operator' => '==', 'value' => FormSubmissionEntity::TAXONOMY_FORM_TYPE]
        );

        $ACFService->registerRepeaterCustomFields("field_form_fields",
            [
                [
                    'name' => 'form_field_name',
                ],
                [
                    'name' => 'field_type_validation',
                    'type' => 'select',
                    'choices'=>[
                        'text'=>"Text",
                        'number'=>"Number",
                        'mail'=>"Email",
                        'date'=>"Date",
                        "letters"=>"Only Letters",
                        "max_length_10"=>"Max Length 10",
                        "max_length_20"=>"Max Length 20",
                        "digits"=>"Only Digits"
                    ],
                ],
                [
                    'name' => 'field_input_type',
                    'type' => 'select',
                    'choices'=>[
                        'text'=>"Text",
                        'email'=>"Email",
                        'date'=>"Date",
                        'textarea'=>"Textarea",
                        'phone'=>"Phone",
                        'select'=>"Select Box"
                    ],
                ],
                [
                    'name' => 'short_description_en',
                ],
                [
                    'name' => 'long_description_en',
                    'required'=>0

                ],
                [
                    'name' => 'short_description_he',
                    'required'=>0
                ],
                [
                    'name' => 'long_description_he',
                    'required'=>0
                ],
                [
                    'name' => 'required',
                    'type' => 'true_false',
                    'required'=>0
                ],
                [
                    'name' => 'field_options',
                    'instructions'=>"separate the fields with a comma.",
                    'required'=>0
                ]
            ]
        );


    }
    public function getAllFormTypes(){
//        return FormDao::getInstance()->getAllFormTypes(FormEntity::TAXONOMY_FORM_TYPE);
    }
}