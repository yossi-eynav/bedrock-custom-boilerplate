<?php

namespace MainPlugin\Core\Controller;


use BenAndJerrysPlugin\Core\Controller\PageTemplatesController;

class CTRLManager{

    public function __construct(){
        $this->addActions();
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
                PageTemplatesController::getInstance()->homePage();
                break;
            default :
                new BaseCTRL();

        }

    }
}