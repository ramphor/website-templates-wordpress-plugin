<?php
namespace Ramphor\WebsiteTemplate;

use Ramphor\WebsiteTemplate\PostType;
use Ramphor\WebsiteTemplate\Metabox;

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
    }

    public function initFeatures()
    {
        PostType::init();
    }

    public function initHooks()
    {
        $meta_box = new Metabox();
        add_action('add_meta_boxes', array($meta_box, 'register_metabox'));
        add_action('save_post', array($meta_box, 'save'), 10, 2);
    }
}
