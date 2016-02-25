<?php


namespace WPModules\Core\Dao;


class PostDao{


    private  static $instance;
    final private function __construct(){}
    final public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return  self::$instance;
    }


    public static function  getPostByID($ID){
       $post =  get_post($ID);
       $post->custom_fields = get_fields($ID);
       return $post;
    }
    /**
     * Get all custom posts by custom post slug.
     * @param $customPostSlug
     * @return array
     */
    public static function getAllCustomPostsBySlug($customPostSlug){
        $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => "$customPostSlug",
        'post_status'      => 'publish');
         $postsArray = get_posts( $args );

         foreach ($postsArray as &$post){
             $post->custom_fields = get_fields($post->ID);
         }
         return $postsArray;
    }

    /**
     * Get posts by category.
     * @param $category
     * @param string $orderByMeta - order posts by meta value
     * @return array
     */
    public static function getPostsByCategory($category,$orderByMeta=""){
        $args = array(
            'posts_per_page'   => -1,
            'category_name'    => $category,
            'post_type'        => 'post',
            'post_status'      => 'publish',
            'meta_key'=>$orderByMeta,
            'order_by'=>'meta_value',
            'order'   => 'ASC',
        );

        $postsArray = get_posts($args);
        foreach ($postsArray as &$post){
            $post->custom_fields = get_fields($post->ID);

        }
        return $postsArray;
    }


    /**
     * Get custom posts by terms.
     * @param $customPostSlug
     * @param $taxonomy
     * @param array $term
     * @return array
     */
    public static function getPostsByTerm($customPostSlug,$taxonomy,$term){
        $args = array(
            'posts_per_page'   => -1,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'hide_empty'=>false,
            'post_type'        => $customPostSlug,
            'post_status'      => 'publish',
            $taxonomy => $term
        );

        $postsArray = get_posts( $args );

        foreach ($postsArray as &$post){
            $post->custom_fields = get_fields($post->ID);

        }
        return $postsArray;
    }


    /**
     * @param $customPostSlug
     * @param string $relation
     * @param $metaKeyValuePairs
     * @return array
     *
     */
    public static function getCustomPostsByMeta($customPostSlug,$metaKeyValuePairs,$relation="AND"){

        $metaQuery = ['relation'=>$relation];
        foreach($metaKeyValuePairs as $pair){

            $metaQuery[] = [
                'key'=>$pair['key'],
                'value'=>$pair['value'],
                'compare'=> isset($pair['compare']) ? $pair['compare'] : '='
            ];

        }

        $args = array(
            'posts_per_page'   => -1,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => "$customPostSlug",
            'post_status'      => 'publish',
            'meta_query'=> $metaQuery
        );

        $postsArray = get_posts( $args );

        foreach ($postsArray as &$post){
            $post->custom_fields = get_fields($post->ID);
        }
        return $postsArray;

    }

    public static function createPost($postType, $postTitle,$pageTemplate=""){

        $post = array(
            'post_title' => $postTitle,
            'post_content' => '',
            'post_status' => 'publish',
            'post_author' => get_current_user_id(),
            'post_type' => $postType,
        );
        if($postType=="page"){
            $post["page_template"] = $pageTemplate;
        }
        return  wp_insert_post($post);
    }


    private  function getCustomPostTypeParams($postSlug,$taxonomies,$icon) {

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
            'capability_type'     => 'page',
            'menu_icon'=>$icon


        );
        return  $postTypeParams;

    }




    public function createCustomPostTypeWithTaxonomies($postSlug, $taxonomies,$icon){

        $postSlug =  strtolower($postSlug);
        if ( ! post_type_exists( $postSlug ) ) {

            $postTypeParams = self::getCustomPostTypeParams($postSlug,$taxonomies,$icon);
            register_post_type( $postSlug, $postTypeParams );

            foreach($taxonomies as $taxonomy){
                TaxonomyDao::getInstance()->registerTaxonomy($taxonomy,$postSlug);
            }

        }
    }


}