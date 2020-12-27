<?php
namespace Ramphor\WebsiteTemplate;

class PostType
{
    const WEB_POST_TYPE = 'web_template';
    const WEB_TEMPLATE_CAT = 'web_template_cat';

    public static function init()
    {
        add_action('init', array(__CLASS__, 'register_post_type'));
        add_action('init', array(__CLASS__, 'register_taxonomies'));
    }

    public static function register_post_type()
    {
        $labels = array(
            'name' => __('Web Templates', 'wp-website-templates')
        );
        register_post_type(
            static::WEB_POST_TYPE,
            apply_filters(
                'web_template_post_type_args',
                array(
                    'labels' => $labels,
                    'menu_icon' => 'dashicons-analytics',
                    'supports' => array( 'title', 'editor', 'thumbnail'),
                    'has_archive' => true,
                    'public' => true,
                )
            )
        );
    }

    public static function register_taxonomies()
    {
        $labels = array(
            'name' => __('Categories'),
            'plural_name' => __('Category')
        );

        register_taxonomy(
            static::WEB_TEMPLATE_CAT,
            static::WEB_POST_TYPE,
            array(
                'labels' => $labels,
                'public' => true,
            )
        );
    }
}
