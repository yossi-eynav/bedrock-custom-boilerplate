<?php


namespace ContactFormPlugin\Core\Dao;


use ContactFormPlugin\Core\Entity\FormEntity;
use ContactFormPlugin\Core\Entity\FormSubmissionEntity;
use WPModules\Core\Dao\TaxonomyDao;
use WPModules\Core\Service\TaxonomyService;

class FormDao{

    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }

    public function getAllFormTypes(){

        $terms = TaxonomyDao::getInstance()->getTermsByTaxonomies(FormSubmissionEntity::TAXONOMY_FORM_TYPE);
        $formEntities = $this->termsToEntities($terms);
        return $formEntities;
    }

    private function termsToEntities($terms){
        $formEntities  = [];
            foreach($terms as $term ){
                $customFields = $term->custom_fields;
                $fieldsEntitiesArray = FormFieldDao::getInstance()->arrayToEntities($customFields['form_fields']);

                $form = new FormEntity(
                    $term->term_id,
                    $customFields['title_en'],
                    $customFields['main_paragraph_en'],
                    $term->name,
                    $fieldsEntitiesArray,
                    $customFields['thank_you_message_en']
                );

                if(!empty($customFields['title_he'])){
                    $form->setHebrewTitle($customFields['title_he']);
                }
                if(!empty( $customFields['main_paragraph_he'])){
                    $form->setHebrewMainParagraph( $customFields['main_paragraph_he']);
                }
                if(!empty( $customFields['thank_you_message_he'])){
                    $form->setHebrewThankYouMessage($customFields['thank_you_message_he']);
                }
                $formEntities[] = $form;
            }
        return $formEntities;
    }

}