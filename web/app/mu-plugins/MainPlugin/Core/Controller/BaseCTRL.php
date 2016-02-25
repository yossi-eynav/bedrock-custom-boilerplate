<?php


namespace MainPlugin\Core\Controller;
use MainPlugin\Core\PluginManager;
use WPModules\Core\Dao\ACFDao;
use WPModules\Core\Dao\PolylangDao;
use WPModules\Core\Service\MenuService;
use WPModules\Core\Service\PolylangService;


class BaseCTRL{


    protected function __construct(){
        $GLOBALS[PluginManager::PLUGIN_NAME]['polylang_wrapper'] =  PolylangService::getInstance();
        $GLOBALS[PluginManager::PLUGIN_NAME]['wp_menu'] =  MenuService::getInstance();
        $GLOBALS[PluginManager::PLUGIN_NAME]['acf_wrapper'] = ACFDao::getInstance();

    }




}