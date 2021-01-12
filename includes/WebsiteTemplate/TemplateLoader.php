<?php
namespace Ramphor\WebsiteTemplate;

use Jankx\Template\Template;

class TemplateLoader
{
    protected static $loader;

    public static function getLoader()
    {
        if (is_null(static::$loader)) {
            $templateDirectory = sprintf('%s/templates', dirname(WP_WEBSITE_TEMPLATES_PLUGIN_FILE));
            static::$loader = Template::getLoader(
                $templateDirectory,
                apply_filters(
                    'wp_website_template_override_directory',
                    'templates/website-templates'
                ),
                'wordpress'
            );
        }
        return static::$loader;
    }

    public static function search()
    {
        $args = func_get_args();
        return call_user_func_array(array(
            static::getLoader(),
            'searchTemplate'
        ), $args);
    }

    public static function render()
    {
        $args = func_get_args();
        return call_user_func_array(array(
            static::getLoader(),
            'render'
        ), $args);
    }
}
