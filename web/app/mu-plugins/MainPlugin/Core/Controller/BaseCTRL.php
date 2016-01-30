<?php


namespace MainPlugin\Core\Controller;
use MainPlugin\Core\PluginManager;
use MainPlugin\Core\DesignPatterns\SingletonPattern;
use MainPlugin\Core\Dao\WPModulesDao\ACFDao;
use MainPlugin\Core\Dao\WPModulesDao\PolylangDao;
use MainPlugin\Core\WPModules\WPMenuService;


class BaseCTRL{


    public function init(){
        PluginManager::getInstance()->addActions();
        $GLOBALS[PluginManager::PLUGIN_NAME] = [];
        $GLOBALS[PluginManager::PLUGIN_NAME]['polylang_wrapper'] =  PolylangDao::getInstance()->initializeStrings();
        $GLOBALS[PluginManager::PLUGIN_NAME]['wp_menu'] =  WPMenuService::getInstance();
        $GLOBALS[PluginManager::PLUGIN_NAME]['acf_wrapper'] = ACFDao::getInstance();

    }





}