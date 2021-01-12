<?php
namespace Ramphor\WebsiteTemplate\Renderer;

use Ramphor\WebsiteTemplate\Abstracts\Renderer;
use Ramphor\WebsiteTemplate\PostType;
use Ramphor\WebsiteTemplate\TemplateLoader;

class WebTemplateCategory extends Renderer
{
    protected $query_args = array();

    public function parseArgs($args)
    {
    }

    protected function get_terms()
    {
        $args = array_merge(
            apply_filters('wp_website_templates_get_category_args', $this->query_args),
            array(
                'taxonomy' => PostType::WEB_TEMPLATE_CAT,
            )
        );
        global $wp_version;
        $terms = version_compare($wp_version, '4.5.0', '>') ? get_terms($args) : get_terms($args['taxonomy'], $args);

        return apply_filters('wp_website_templates_category_terms', $terms, $args, $this);
    }

    public function render()
    {
        $terms = $this->get_terms();
        if (is_array($terms) && count($terms)) {
            ob_start();
            TemplateLoader::render('category/loop-start');
            foreach ($terms as $term) {
                TemplateLoader::render('category/item', apply_filters(
                    'wp_website_templates_create_item_data',
                    array(
                        'ID' => $term->term_id,
                        'name' => $term->name,
                        'url' => get_term_link($term),
                        'slug' => $term->slug,
                    ),
                    $term
                ));
            }
            TemplateLoader::render('category/loop-end');

            return ob_get_clean();
        }
    }
}
