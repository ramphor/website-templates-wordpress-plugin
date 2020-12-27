<?php
namespace Ramphor\WebsiteTemplate;

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
    }
}
