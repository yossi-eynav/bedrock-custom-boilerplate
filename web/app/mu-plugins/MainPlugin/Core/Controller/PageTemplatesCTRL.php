<?php


namespace MainPlugin\Core\Controller;



class PageTemplatesCTRL extends BaseCTRL {

    private  static $instance;
    final protected function __construct(){
        parent::__construct();
    }

    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }

    public function homePage(){
    }



}