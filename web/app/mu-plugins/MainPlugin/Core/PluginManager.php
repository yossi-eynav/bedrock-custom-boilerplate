<?php
namespace MainPlugin\Core;

use MainPlugin\Core\Dao\WPModulesDao\ACFDao;
use MainPlugin\Core\Dao\WPModulesDao\PolylangDao;

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
        add_action( 'login_enqueue_scripts', [$this,'styleAdminPanel'] );
        add_action('admin_head', [$this,'styleAdminPanel']);
        add_action('admin_menu', [$this,'addLogoToAdminMenu'], 100 );
    }

    public  function addLogoToAdminMenu(){
        add_menu_page( 'restart-group', '-', 'read', 'restart-group', function(){
            echo '<iframe width="100%" height="1000" src="https://restartit.co.il" class="center-block"></iframe>';
        });

    }
    public function styleAdminPanel(){
        wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/dist/styles/main.css' );


    }

    public function addFilters(){
        ACFDao::getInstance()->addFilters();

        // hide the  default admin bar for logged in users.
        add_filter('show_admin_bar', '__return_false');


        // Change Wordpress login page logo href.
        add_filter('login_headerurl',function(){
            return 'http://restartit.co.il';
        });

    }

    public function initActionHandler(){
        $this->registerPostTypes();
        $this->addACFOptionPages();
        $this->registerTranslatedStrings();
    }


    /** Add the ACF option page  */
    private function addACFOptionPages(){
        acf_add_options_page("Footer");
    }


    private function registerTranslatedStrings(){
        PolylangDao::getInstance()->initializeStrings();
    }

    /** Register all of the WP postTypes;  **/
    private function registerPostTypes(){}


    public static function getInstance(){
        self::$instance = (is_null(self::$instance ) ? new PluginManager() : self::$instance );
        return self::$instance;
    }
};


