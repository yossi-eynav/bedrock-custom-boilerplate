<?php
namespace SearchPlugin\Core;

use BenAndJerrysPlugin\Core\Entity\IceCreamEntity;
use SearchPlugin\Core\Service\SearchService;

if (!defined( 'ABSPATH' )) { die('Not this time.');} #Exit if accessed directly


class PluginManager {

    const PLUGIN_NAME =  "SearchPlugin";

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
        SearchService::getInstance()->searchPosts();

    }

    private function addAjaxHooks(){
            add_action( 'wp_ajax_'.SearchService::AJAX_ACTION, [SearchService::getInstance(),'searchPosts'] );
            add_action( 'wp_ajax_nopriv_'.SearchService::AJAX_ACTION,  [SearchService::getInstance(),'searchPosts'] );
    }


    private function addFilters(){

    }




};


