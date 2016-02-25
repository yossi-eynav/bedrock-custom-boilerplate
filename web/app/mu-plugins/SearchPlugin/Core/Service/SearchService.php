<?php


namespace SearchPlugin\Core\Service;


use SearchPlugin\Core\Dao\SearchDao;
use WPModules\Core\Service\PolylangService;

class SearchService extends BaseService{


    const AJAX_ACTION  = "search_posts";
    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }
    public function searchPosts(){
        if(!empty($_GET['search'])){
            $searchText = sanitize_text_field($_GET['search']);
            return SearchDao::getInstance($searchText)->getPostsByMeta();
        }
        else{
            return [];
        }

    }
    public function getSearchForm(){

    }

    public function getTheSearchPage(){
        $page = get_page_by_title('SearchPage');
        $postID =  PolylangService::getInstance()->getTranslatedPost($page->ID);
        return get_post_permalink($postID);
    }
}