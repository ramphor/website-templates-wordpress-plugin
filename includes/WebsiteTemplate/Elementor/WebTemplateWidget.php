<?php
namespace Ramphor\WebsiteTemplate\Elementor;

use Elementor\Widget_Base;
use Ramphor\WebsiteTemplate\Renderer\WebTemplate;

class WebTemplateWidget extends Widget_Base
{
    public function get_name()
    {
        return 'wp_web_templates';
    }

    public function get_title()
    {
        return __('Website Templates', 'wp_website_templates');
    }

    protected function render()
    {
        $webTemplate = new WebTemplate();
        $webTemplate->parseArgs(array(
            'limit' => 9,
        ));
        echo $webTemplate->render();
    }
}
