<?php

namespace WPModules\Core\Service;

use WPModules\Core\Dao\MenuDao;

class MenuService{

    private  static $instance;

    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }

    public function getWPMenuBySlug($slug,$menuID="",$menuClasses="",$addCurrentLangSuffix = false){
        if($addCurrentLangSuffix){
            $slug = $slug.'_'.PolylangService::getInstance()->getCurrentLang();
        }
        return MenuDao::getMenuBySlug($slug,$menuID,$menuClasses);
    }

}