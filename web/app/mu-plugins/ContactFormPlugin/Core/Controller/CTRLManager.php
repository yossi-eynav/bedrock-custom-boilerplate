<?php

namespace ContactFormPlugin\Core\Controller;


use ContactFormPlugin\Core\PluginManager;
use ContactFormPlugin\Core\Service\FormSubmissionService;

class CTRLManager{

    private  static $instance;
    final private function __construct(){
        $this->addActions();
    }
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }


    private function addActions(){
        add_action('template_redirect',[$this,'router']);
        add_action('admin_init',[$this,'router']);
    }

    public function router(){
        $this->allPages();
    }


    private function allPages(){
        $GLOBALS[PluginManager::PLUGIN_NAME]['form_types'] = FormSubmissionService::getInstance()->getFormTypes();
    }


}