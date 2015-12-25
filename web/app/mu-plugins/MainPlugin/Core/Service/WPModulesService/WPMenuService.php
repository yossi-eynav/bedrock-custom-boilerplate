<?php

namespace MainPlugin\Core\WPModules;

use MainPlugin\Core\DesignPatterns\SingletonPattern;
use MainPlugin\Core\Dao\WPModulesDao\MenuDao;

class WPMenuService extends SingletonPattern{

    public function getWPMenuBySlug($slug,$menuID="",$menuClasses=""){
        return MenuDao::getMenuBySlug($slug,$menuID,$menuClasses);
    }

}