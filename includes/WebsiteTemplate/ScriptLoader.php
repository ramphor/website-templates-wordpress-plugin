<?php
namespace Ramphor\WebsiteTemplate;

class ScriptLoader {

    public function asset_url($path = '')
    {
        return sprintf(
            '%s/assets/%s',
            rtrim(
                plugin_dir_url(WP_WEBSITE_TEMPLATES_PLUGIN_FILE),
                '/'
            ),
            $path
        );
    }

    public function load() {
        global $wp_scripts, $wp_styles;

        if (!isset($wp_scripts->registered['splide'])) {
            wp_register_script('fslightbox-basic', $this->asset_url('vendor/fslightbox-basic/fslightbox.js'), array(), '3.2.3', true);
        }
        if (!isset($wp_scripts->registered['splide'])) {
            wp_register_script('splide', $this->asset_url('vendor/splide/js/splide.min.js'), array(), '2.4.21', true);
        }
        if (!isset($wp_styles->registered['splide'])) {
            wp_register_style('splide', $this->asset_url('vendor/splide/css/splide-core.min.css'), array(), '2.4.21');
        }
        if (!isset($wp_styles->registered['splide-theme'])) {
            wp_register_style('splide-theme', $this->asset_url('vendor/splide/css/themes/splide-default.min.css'), array('splide'), '2.4.21');
        }

        // Call scripts
        wp_enqueue_script('splide');
        wp_enqueue_style('splide-theme');

        wp_enqueue_script('fslightbox-basic');
    }
}
