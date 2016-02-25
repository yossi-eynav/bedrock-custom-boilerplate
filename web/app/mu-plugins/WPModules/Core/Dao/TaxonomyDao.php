<?php

namespace WPModules\Core\Dao;




class TaxonomyDao{

    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }

    public function registerTaxonomy($taxonomy,$postSlug){
        $displayedSlug = ucwords(str_replace('_',' ',$taxonomy));
        $labels = array(
            'name'                       => _x( $displayedSlug, 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( $displayedSlug, 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( $displayedSlug, 'text_domain' ),
            'all_items'                  => __( 'All Items', 'text_domain' ),
            'parent_item'                => __( 'Parent Item', 'text_domain' ),
            'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
            'new_item_name'              => __( 'New Item Name', 'text_domain' ),
            'add_new_item'               => __( 'Add New Item', 'text_domain' ),
            'edit_item'                  => __( 'Edit Item', 'text_domain' ),
            'update_item'                => __( 'Update Item', 'text_domain' ),
            'view_item'                  => __( 'View Item', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
            'popular_items'              => __( 'Popular Items', 'text_domain' ),
            'search_items'               => __( 'Search Items', 'text_domain' ),
            'not_found'                  => __( 'Not Found', 'text_domain' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => false,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => false,
            'show_tagcloud'              => false,
        );
        register_taxonomy($taxonomy, $postSlug,$args);
    }


    public  function  getTermsByTaxonomies($taxonomies){
        $args = array(
            'orderby'           => 'name',
            'order'             => 'ASC',
            'hide_empty'        => false,
            'number'            => '',
            'fields'            => 'all',
            'hierarchical'      => true,
            'child_of'          => 0,
            'childless'         => false,
        );
        $terms = get_terms($taxonomies, $args);
        foreach($terms as &$term) {
            $term = $this->getTermCustomFields($term);
        }
        return $terms;
    }

    public function getTermCustomFields($termObject){
        $termObject->custom_fields =  get_fields($termObject);
        return $termObject;
    }

    public function createTerm($term,$taxonomy,$args = []){
        wp_insert_term($term,$taxonomy,$args);
    }
    public function getTerm($value, $taxonomy,$field="slug"){
        $term = get_term_by($field, $value, $taxonomy);
        $term->custom_fields = $this->getTermCustomFields($term);
        return $term;
    }


}