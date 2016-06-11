<?php
namespace MainPlugin\Core;

use WPModules\Core\Service\ACFService;
use WPModules\Core\Service\PolylangService;

if (!defined( 'ABSPATH' )) { die('Not this time.');} #Exit if accessed directly





class PluginManager {

    const PLUGIN_NAME =  "MainPlugin";

    private  static $instance;
    final private function __construct(){
        $this->addActionsHooks();
        $this->addFilters();
    }

    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }


    public function addActionsHooks(){
        add_action('init',[$this,'initActionHandler']);

        /**
         * Make manipulation on the Admin Panel.
         */
//        add_action( 'login_enqueue_scripts', [$this,'styleAdminPanel'] );
//        add_action('admin_head', [$this,'styleAdminPanel']);
    }

    
    /**
     * Change the uploaded file name to a constant pattern.
     * @param $file
     * @return mixed
     */
    public function changeUploadedFileName($file){
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $file['name'] = uniqid().'_'.time().'.'.$fileExtension;
        return $file;
    }


    public function addFilters(){

        ACFService::getInstance()->addFilters();

        // hide the  default admin bar for logged in users.
        add_filter('show_admin_bar', '__return_false');

        // Change Wordpress login page logo href.
//        add_filter('login_headerurl',function(){
//            return 'http://restartgroup.co';
//        });
        add_filter('wp_handle_upload_prefilter', [$this,'changeUploadedFileName']);
    }


//
    /**
     * Add custom stylesheet to the Admin Panel.
     */
    public function styleAdminPanel(){
        wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/dist/styles/admin.css' );
    }


    public function initActionHandler(){
        $this->registerPostTypes();
        $this->registerTranslatedStrings();
        ACFService::getInstance()->addOptionPages(
            [
                "Post Archive EN",
                "Post Archive HE",
                "General Info"
            ]
        );
    }


    private function registerTranslatedStrings(){
        PolylangService::getInstance()->initializeStrings();
    }

    /** Register  WP postTypes;  **/
    private function registerPostTypes(){

    }


};


