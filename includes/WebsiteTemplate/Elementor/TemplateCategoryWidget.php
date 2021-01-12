<?php
namespace Ramphor\WebsiteTemplate\Elementor;

use Elementor\Widget_Base;

class TemplateCategoryWidget extends Widget_Base
{
    public function get_name()
    {
        return 'web_template_cat';
    }

    public function get_title()
    {
        return __('Website Template Categories', 'wp_website_templates');
    }

    protected function _register_controls()
    {
    }

    protected function render()
    {
    }
}
