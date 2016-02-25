<?php

namespace SearchPlugin\Core\Controller;


use SearchPlugin\Core\PluginManager;
use SearchPlugin\Core\Service\SearchService;

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
        if(is_page_template()&&basename(get_page_template(),'.php')=="SearchPage"){
            $GLOBALS[PluginManager::PLUGIN_NAME]['search_result'] = SearchService::getInstance()->searchPosts();
        }
        $this->common();
    }

    private function common(){
        $GLOBALS[PluginManager::PLUGIN_NAME]['search_service'] = SearchService::getInstance();;
        $GLOBALS[PluginManager::PLUGIN_NAME]['search_page_url'] = SearchService::getInstance()->getTheSearchPage();;
    }
}