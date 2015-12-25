<?php


namespace MainPlugin\Core\Dao\WPModulesDao;

use MainPlugin\Core\PluginManager;
use MainPlugin\Core\DesignPatterns\SingletonPattern;

class PolylangDao extends SingletonPattern{


    private function getConstants(){
    $reflectionClass = new \ReflectionClass(__CLASS__);
        return $reflectionClass->getConstants();
    }

    public function initializeStrings(){
        foreach($this->getConstants() as $key=>$value){
             $this->registerString($value);
        }
    }


    private function registerString($string){
        pll_register_string(PluginManager::PLUGIN_NAME, $string, PluginManager::PLUGIN_NAME);
    }

    public function getTranslatedString($string,$upperCase = false){
        return ($upperCase ? strtoupper( pll__($string)) : pll__($string));
    }


    public function getCurrentLang(){
        return pll_current_language();
    }

}




