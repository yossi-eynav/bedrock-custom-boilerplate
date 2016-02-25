<?php


namespace BenAndJerrysPlugin\Core\Controller;


use BenAndJerrysPlugin\Core\PluginManager;
use BenAndJerrysPlugin\Core\Service\BusinessValueService;
use BenAndJerrysPlugin\Core\Service\IceCreamService;

class PageTemplatesController extends BaseController {

    private  static $instance;
    final protected function __construct(){
        parent::__construct();
    }

    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }

    public function homePage(){
        $GLOBALS[PluginManager::PLUGIN_NAME]['production_ice_creams']  = IceCreamService::getInstance()->getAllEntities();
        $GLOBALS[PluginManager::PLUGIN_NAME]['sorted_values'] = BusinessValueService::getInstance()->getAllValuesSortedByTerms();
    }

    public function iceCreamShops(){
        $postsArray = get_field('ice_creams');
        $GLOBALS[PluginManager::PLUGIN_NAME]['ice_creams'] = IceCreamService::getInstance()->postsToEntities($postsArray);
    }

    public function valuesOverView(){
        $GLOBALS[PluginManager::PLUGIN_NAME]['sorted_values'] = BusinessValueService::getInstance()->getAllValuesSortedByTerms();

    }

    public function contactUs(){
        $formID = "";
        if(isset($_GET['form-id'])){
            $formID =sanitize_text_field($_GET['form-id']);
        }
        $GLOBALS[PluginManager::PLUGIN_NAME]['current_form'] = $formID;
    }


}