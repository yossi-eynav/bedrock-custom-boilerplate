<?php


namespace ContactFormPlugin\Core\Dao;


use ContactFormPlugin\Core\Entity\FormSubmissionEntity;
use WPModules\Core\Dao\TaxonomyDao;

class FormSubmissionDao extends BaseDao
{

    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }

    function postsArrayToEntities($postsArray){


    }

    public function insertNewForm(){
        $postData = [
            'post_title'=>'New Form Submission!',
            'post_type'=>FormSubmissionEntity::CUSTOM_POST_TYPE_SLUG,
            'post_author'=>1
        ];
        $postID = wp_insert_post($postData);
        $formType = (int) $_POST['form_type'];
        $formStatusTerm = TaxonomyDao::getInstance()->getTerm(
            FormSubmissionEntity::TAXONOMY_FORM_STATUS_TERM_UNREAD,
            FormSubmissionEntity::TAXONOMY_FORM_STATUS
        );

        if($postID&&term_exists($formType)&&term_exists($formStatusTerm->term_id)){
            wp_set_object_terms( $postID, $formType,FormSubmissionEntity::TAXONOMY_FORM_TYPE,false);
            wp_set_object_terms( $postID, $formStatusTerm->term_id,FormSubmissionEntity::TAXONOMY_FORM_STATUS , false );
            update_field('form_status',$formStatusTerm->term_id, $postID);
            update_field('form_type', $formType, $postID);
            $formFields = [];
            foreach($_POST as $key=>$value){
                if($key=="form_type"||$key=="action"){
                    continue;
                }
                $formFields[] = [
                  'form_field_value'=>$value,
                  'form_field_name'=>$key
                ];
            }
            update_field('field_submission_form_fields',$formFields,$postID);

        }
        wp_send_json_success();
    }

}