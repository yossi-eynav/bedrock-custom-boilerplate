<?php


namespace MainPlugin\Core\WPModules;


use MainPlugin\Core\DesignPatterns\SingletonPattern;

class ACFService extends SingletonPattern{

    public function getOptionPageFieldByLanguage($fieldName){
        $currentLang = PolylangWrapper::getInstance()->getCurrentLang();
        return get_field($fieldName.'_'.$currentLang,"option");
    }


}