<?php
namespace ContactFormPlugin\Core;

use ContactFormPlugin\Core\Entity\FormEntity;
use ContactFormPlugin\Core\Entity\FormSubmissionEntity;
use ContactFormPlugin\Core\Service\FormService;
use ContactFormPlugin\Core\Service\FormSubmissionService;
use WPModules\Core\Service\ACFService;
use WPModules\Core\Service\PostService;
use WPModules\Core\Service\TaxonomyService;

if (!defined( 'ABSPATH' )) { die('Not this time.');} #Exit if accessed directly


class PluginManager {

    const PLUGIN_NAME =  "ContactFormPlugin";
    const TAXONOMY_FORM_TYPE = "";

    private  static $instance;
    final private function __construct(){
        $this->addActionsHooks();
        $this->addFilters();
    }
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new PluginManager();
        }
        return  self::$instance;
    }


    private function addActionsHooks(){
        add_action('init',[$this,'initActionHandler']);
        $this->addAjaxHooks();
    }

    public function initActionHandler(){
        $this->registerPostTypes();
        $this->createTerms();
        FormService::getInstance()->registerFormACF();
        FormSubmissionService::getInstance()->registerFormACF();
    }

    private function addAjaxHooks(){
            add_action( 'wp_ajax_'.FormSubmissionService::AJAX_ACTION, [FormSubmissionService::getInstance(),'insertNewFormSubmission'] );
            add_action( 'wp_ajax_nopriv_'.FormSubmissionService::AJAX_ACTION,  [FormSubmissionService::getInstance(),'insertNewFormSubmission'] );
    }


    private function addFilters(){

    }



    /** Register  WP postTypes;  **/
    private function registerPostTypes(){
        PostService::getInstance()->createCustomPostTypeWithTaxonomies(FormSubmissionEntity::CUSTOM_POST_TYPE_SLUG,[FormSubmissionEntity::TAXONOMY_FORM_STATUS,FormSubmissionEntity::TAXONOMY_FORM_TYPE]);
    }

    private function createTerms(){
       TaxonomyService::getInstance()->createTerms(
           [
               FormSubmissionEntity::TAXONOMY_FORM_STATUS_TERM_READ,
               FormSubmissionEntity::TAXONOMY_FORM_STATUS_TERM_PROGRESS,
               FormSubmissionEntity::TAXONOMY_FORM_STATUS_TERM_UNREAD,
           ]
           ,FormSubmissionEntity::TAXONOMY_FORM_STATUS);
    }

};


