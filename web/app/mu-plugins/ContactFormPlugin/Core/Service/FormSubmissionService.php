<?php



namespace ContactFormPlugin\Core\Service;


use ContactFormPlugin\Core\Dao\FormDao;
use ContactFormPlugin\Core\Dao\FormSubmissionDao;
use ContactFormPlugin\Core\Entity\FormSubmissionEntity;
use WPModules\Core\Service\ACFService;
use WPModules\Core\Service\TaxonomyService;

class FormSubmissionService extends BaseService
{
    const AJAX_ACTION = "insert_new_form";

    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }

    function getAllEntities()
    {
        // TODO: Implement getAllEntities() method.
    }

    public function insertNewFormSubmission(){
        foreach($_POST as $key=>$value){
            $_POST[$key] = sanitize_text_field($value);
        }
        FormSubmissionDao::getInstance()->insertNewForm();

    }

    public function registerFormACF(){
        $ACFService = ACFService::getInstance();
        $ACFService->registerCustomFields(
            "form_submission",
            [
                [
                    'name' => 'form_status',
                    'type'=>'taxonomy',
                    'add_term'=>0,
                    'taxonomy'=>FormSubmissionEntity::TAXONOMY_FORM_STATUS,
                    'field_type'=>"select",
                    'load_save_terms'=>1

                ],
                [
                    'name' => 'form_type',
                    'type'=>'taxonomy',
                    'add_term'=>0,
                    'taxonomy'=>FormSubmissionEntity::TAXONOMY_FORM_TYPE,
                    'field_type'=>"select",
                    'load_save_terms'=>1
                ],
                ['name' => 'submission_form_fields', 'type' => 'repeater','required'=>0]
            ],
            ['param' => 'post_type', 'operator' => '==', 'value' => FormSubmissionEntity::CUSTOM_POST_TYPE_SLUG]
        );
        $ACFService->registerRepeaterCustomFields("field_submission_form_fields",
            [
                [
                    'name' => 'form_field_name'
                ],
                [
                    'name' => 'form_field_value'
                ]
            ]
        );


    }
    public function getFormTypes(){
        return FormDao::getInstance()->getAllFormTypes();

    }

}