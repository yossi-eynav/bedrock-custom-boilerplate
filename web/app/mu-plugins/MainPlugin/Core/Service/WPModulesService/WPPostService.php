<?php


namespace MainPlugin\Core\WPModules;
use MainPlugin\Core\DesignPatterns\SingletonPattern;

class WPPostService extends SingletonPattern{


    public static function createCustomPostTypeWithTaxonomies($postSlug,array $taxonomies) {
        $postSlug =  strtolower($postSlug);

        if ( ! post_type_exists( $postSlug ) ) {

            $postTypeParams = self::getCustomPostTypeParams($postSlug,$taxonomies);
            $postType = register_post_type( $postSlug, $postTypeParams );

            foreach($taxonomies as $taxonomy){
                 WPTaxonomyService::getInstance()->registerTaxonomy($taxonomy,$postSlug);
            }
        }
    }


    private static function getCustomPostTypeParams($postSlug,$taxonomies) {

        $displayedSlug = ucwords(str_replace('_',' ',$postSlug));
        $labels = array(
            'name'                => _x( $displayedSlug, 'Post Type General Name', 'text_domain' ),
            'singular_name'       => _x( $displayedSlug, 'Post Type Singular Name', 'text_domain' ),
            'menu_name'           => __( $displayedSlug, 'text_domain' ),
            'name_admin_bar'      => __( $displayedSlug, 'text_domain' ),
            'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
            'all_items'           => __( 'All Items', 'text_domain' ),
            'add_new_item'        => __( 'Add New Item', 'text_domain' ),
            'add_new'             => __( 'Add New', 'text_domain' ),
            'new_item'            => __( 'New Item', 'text_domain' ),
            'edit_item'           => __( 'Edit Item', 'text_domain' ),
            'update_item'         => __( 'Update Item', 'text_domain' ),
            'view_item'           => __( 'View Item', 'text_domain' ),
            'search_items'        => __( 'Search Item', 'text_domain' ),
            'not_found'           => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
        );
        $postTypeParams = array(
            'label'               => __( $postSlug, 'text_domain' ),
            'description'         => __( $displayedSlug." Description", 'text_domain' ),
            'labels'              => $labels,
            'supports'            => array('title'),
            'taxonomies'          => $taxonomies,
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page'
        );
        return  $postTypeParams;
    }

}