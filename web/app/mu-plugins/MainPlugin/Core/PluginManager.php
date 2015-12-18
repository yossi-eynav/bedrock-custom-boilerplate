<?php
namespace MainPlugin\Core;

use MainPlugin\Core\Dao\WPAdvancedCustomFieldsDao;

if (!defined( 'ABSPATH' )) { die('Not this time.');} #Exit if accessed directly


class PluginManager{

    static private $instance = null;
    const PLUGIN_NAME =  "MainPlugin";

    private function __construct(){
        $this->addActions();
        $this->addFilters();
    }



    public function addActions(){
        add_action('init',[$this,'initActionHandler']);
    }

    public function addFilters(){
        WPAdvancedCustomFieldsDao::getInstance()->addFilters();
        // hide the  default admin bar for logged in users.
        add_filter('show_admin_bar', '__return_false');

    }

    public function initActionHandler(){
        $this->registerPostTypes();
        $this->addACFOptionPages();
        $this->registerTranslatedStrings();
    }


    /** Add the ACF option page  */
    private function addACFOptionPages(){
        acf_add_options_page("Post Archive EN");
        acf_add_options_page("Post Archive HE");
    }


//    private function registerTranslatedStrings(){
//        PolylangWrapper::getInstance()->initializeStrings();
//    }

    /** Register all of the WP postTypes;  **/
    private function registerPostTypes(){}


    public static function getInstance(){
        self::$instance = (is_null(self::$instance ) ? new PluginManager() : self::$instance );
        return self::$instance;
    }
};


