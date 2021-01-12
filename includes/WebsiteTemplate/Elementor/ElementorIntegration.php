<?php
namespace Ramphor\WebsiteTemplate\Elementor;

use Ramphor\WebsiteTemplate\Elementor\WebTemplateWidget;
use Ramphor\WebsiteTemplate\Elementor\TemplateCategoryWidget;

class ElementorIntegration
{
    public function __construct()
    {
        add_action('elementor/widgets/widgets_registered', array($this, 'registerWidgets'));
    }

    public function registerWidgets($widget_manager)
    {
        $widget_manager->register_widget_type(new WebTemplateWidget());
        $widget_manager->register_widget_type(new TemplateCategoryWidget());
    }
}
