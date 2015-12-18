<?php


namespace MainPlugin\Core\Dao\WPModulesDao;


class MenuDao {

    public static function getMenuBySlug($slug,$menuID,$menuClasses){
        $args = array(
            'menu' => "$slug",
            'container' => 'nav',
            'container_id'    => $menuID,
            'menu_class' => $menuClasses,
            'echo' => false,
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        );
       return  wp_nav_menu($args);
    }

}