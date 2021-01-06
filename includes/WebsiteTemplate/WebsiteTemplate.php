<?php
namespace Ramphor\WebsiteTemplate;

use Ramphor\WebsiteTemplate\PostType;
use Ramphor\WebsiteTemplate\Metabox;
use Ramphor\WebsiteTemplate\Elementor\ElementorIntegration;

class WebsiteTemplate
{
    protected static $instance;

    public static function get_instance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function __construct()
    {
        $this->boostrap();
        $this->initFeatures();
        $this->initHooks();
    }

    protected function boostrap()
    {
        define(
            'WEBSITE_TEMPLATES_ROOT',
            dirname(WP_WEBSITE_TEMPLATES_PLUGIN_FILE)
        );
        require_once WEBSITE_TEMPLATES_ROOT . '/includes/functions.php';
    }

    public function initFeatures()
    {
        PostType::init();
        $active_plugins = get_option('active_plugins');
        if (in_array('elementor/elementor.php', $active_plugins)) {
            new ElementorIntegration();
        }
    }

    public function initHooks()
    {
        global $web_template_scripts;

        $web_template_scripts = new ScriptLoader();
        add_action('wp_enqueue_scripts', array($web_template_scripts, 'load'), 40);

        $meta_box = new Metabox();
        add_action('add_meta_boxes', array($meta_box, 'register_metabox'));
        add_action('save_post', array($meta_box, 'save'), 10, 2);
        add_filter('wp_website_template_parse_loop_data', array($this, 'parseTemplateData'), 10, 2);
    }

    public function parseTemplateData($data, $post)
    {
        $code     = get_website_template_code($post->ID);
        $demo_url = get_website_template_demo_url($post->ID);

        return array_merge($data, compact('code', 'demo_url'));
    }
}
