<?php

namespace MainPlugin\Core\Controller;


use MainPlugin\Core\Controller\PageTemplatesCTRL;

class CTRLManager{


    private  static $instance;
    final private function __construct(){
        $this->addActions();

    }
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }


    private function addActions(){
        add_action('template_redirect',[$this,'router']);
        add_action('admin_init',[$this,'router']);
    }



    public function router(){
        if(is_page_template()){
            $pageTemplate = basename(get_page_template(),'.php');
        }
        else if(is_archive()){
            $pageTemplate = 'archive-'.get_queried_object()->name;
        }
        else{
            if(isset(get_queried_object()->post_type)){
                $pageTemplate = get_queried_object()->post_type;
            }
            else{
                $pageTemplate=  "";
            }
        }

        switch($pageTemplate){
            case 'HomePage':
                PageTemplatesCTRL::getInstance()->homePage();
                break;
            default :
                PageTemplatesCTRL::getInstance();

        }

    }
}