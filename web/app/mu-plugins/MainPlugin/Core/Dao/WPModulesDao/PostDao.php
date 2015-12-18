<?php


namespace MainPlugin\Core\Dao\WPModulesDao;


class PostDao{


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
    public static function getCustomPostsByTaxonomy($customPostSlug,$taxonomy,array $term){
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



}