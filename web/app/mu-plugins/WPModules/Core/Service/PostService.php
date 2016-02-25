<?php


namespace WPModules\Core\Service;

use WPModules\Core\Dao\PostDao;

class PostService{


    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }


    public  function createCustomPostTypeWithTaxonomies($postSlug,array $taxonomies,$icon = null) {
        PostDao::getInstance()->createCustomPostTypeWithTaxonomies($postSlug,$taxonomies,$icon);
    }


    public function getFooterPosts(){
       return PostDao::getPostsByCategory("footer_posts","post_order");
    }
}