<?php

namespace MainPlugin\Core\WPModules;

use MainPlugin\Core\DesignPatterns\SingletonPattern;
use MainPlugin\Core\Dao\WPMenuDao;

class WPMenuService extends SingletonPattern{

    public function getWPMenuBySlug($slug,$menuID="",$menuClasses=""){
        return WPMenuDao::getMenuBySlug($slug,$menuID,$menuClasses);
    }

}