<?php
namespace Ramphor\WebsiteTemplate\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Ramphor\WebsiteTemplate\Renderer\WebTemplate;
use Ramphor\WebsiteTemplate\PostType;

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

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'jankx'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $args = array(
            'taxonomy' => PostType::WEB_TEMPLATE_CAT,
            'hide_empty' => false,
            'field' => 'id=>name'
        );
        $this->add_control(
            'post_categories',
            [
                'label' => __('Categories', 'jankx'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => version_compare($GLOBALS['wp_version'], '4.5.0') ? get_terms($args) : get_terms($args['taxonomy'], $args),
                'default' => '',
            ]
        );

        $this->add_control(
            'posts_per_page',
            [

                'label' => __('Number of Posts', 'jankx'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 5,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $webTemplate = new WebTemplate();
        $webTemplate->parseArgs(array(
            'demo_style' => 'link',
        ));
        $webTemplate->setLimit(
            array_get($settings, 'posts_per_page') >= 0
            ? array_get( $settings, 'posts_per_page' )
            : -1
        );
        $footerCallable = array($webTemplate, 'footerScripts');
        if (is_callable($footerCallable)) {
            add_action('wp_print_footer_scripts', $footerCallable);
        }
        echo $webTemplate->render();
    }
}
