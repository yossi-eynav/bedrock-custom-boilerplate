<?php


namespace MainPlugin\Core\Controller;
use MainPlugin\Core\PluginManager;
use MainPlugin\Core\DesignPatterns\SingletonPattern;
use MainPlugin\Core\WPModules\ACFWrapper;
use MainPlugin\Core\WPModules\PolylangWrapper;
use MainPlugin\Core\WPModules\WPMenuService;


class BaseController extends SingletonPattern{


    public function init(){
        PluginManager::getInstance()->addActions();
        $GLOBALS[PluginManager::PLUGIN_NAME] = [];
        $GLOBALS[PluginManager::PLUGIN_NAME]['polylang_wrapper'] =  PolylangWrapper::getInstance()->initializeStrings();
        $GLOBALS[PluginManager::PLUGIN_NAME]['wp_menu'] =  WPMenuService::getInstance();
        $GLOBALS[PluginManager::PLUGIN_NAME]['acf_wrapper'] = ACFWrapper::getInstance();

    }





}