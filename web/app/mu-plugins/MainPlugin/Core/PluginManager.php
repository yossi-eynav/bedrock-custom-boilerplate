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

        /**
         * Make manipulation to the Admin Panel.
         */
        add_action( 'login_enqueue_scripts', [$this,'styleAdminPanel'] );
        add_action('admin_head', [$this,'styleAdminPanel']);
        add_action('admin_menu', [$this,'addLogoToAdminMenu'], 100 );

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

    /**
     * Add restart logo to the Admin Panel.
     */
    public  function addLogoToAdminMenu(){
        add_menu_page( 'restart-group', '-', 'read', 'restart-group', function(){
            echo '<iframe width="100%" height="1000" src="http://restartgroup.co" class="center-block"></iframe>';
        });

    }

    /**
     * Add custom stylesheet to the Admin Panel.
     */
    public function styleAdminPanel(){
        wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/dist/styles/admin.css' );
    }

    public function addFilters(){
        ACFDao::getInstance()->addFilters();

        // hide the  default admin bar for logged in users.
        add_filter('show_admin_bar', '__return_false');


        // Change Wordpress login page logo href.
        add_filter('login_headerurl',function(){
            return 'http://restartgroup.co';
        });

        add_filter('wp_handle_upload_prefilter', [$this,'changeUploadedFileName']);


    }

    public function initActionHandler(){
        $this->registerPostTypes();
        $this->addACFOptionPages();
        $this->registerTranslatedStrings();
    }


    /** Add the ACF option page  */
    private function addACFOptionPages(){
//        acf_add_options_page();

    }

    /**
     * Register Polylang strings.
     */
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


