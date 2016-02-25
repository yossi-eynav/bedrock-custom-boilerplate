<?php


namespace MainPlugin\Core\Controller;
use MainPlugin\Core\PluginManager;
use WPModules\Core\Dao\ACFDao;
use WPModules\Core\Dao\PolylangDao;
use WPModules\Core\Service\MenuService;


class BaseCTRL{


    public function __construct(){
        $GLOBALS[PluginManager::PLUGIN_NAME]['polylang_wrapper'] =  PolylangDao::getInstance()->initializeStrings();
        $GLOBALS[PluginManager::PLUGIN_NAME]['wp_menu'] =  MenuService::getInstance();
        $GLOBALS[PluginManager::PLUGIN_NAME]['acf_wrapper'] = ACFDao::getInstance();

    }




}