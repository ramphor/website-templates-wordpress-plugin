<?php
namespace Ramphor\WebsiteTemplate\Renderer;

use WP_Query;
use Ramphor\WebsiteTemplate\Abstracts\Renderer;
use Ramphor\WebsiteTemplate\TemplateLoader;

class WebTemplate extends Renderer
{
    public function parseArgs($args = array())
    {
        if (isset($args['limit'])) {
            $this->setLimit($args['limit'] > 0 ? $args['limit'] : -1);
        }
        if (isset($args['demo_style'])) {
            $this->demo_style = $args['demo_style'];
        }
    }

    public function get_wp_query()
    {
        $args = wp_parse_args(array(
            'post_type' => 'web_template'
        ), $this->query_args);

        return apply_filters(
            'wp_website_templates_get_wp_query',
            new WP_Query($args),
            $this
        );
    }

    /**
     * Parse args methods
     */
    public function setLimit($limit)
    {
        $this->query_args['posts_per_page'] = intval($limit);
    }

    public function render()
    {
        $wp_query = $this->get_wp_query();
        $template_files = array('loop/website-template');
        if ($this->demo_style && $this->demo_style !== 'link') {
            array_unshift($template_files, sprintf('loop/%s/website-template', $this->demo_style));
        }
        if ($wp_query->have_posts()) {
            TemplateLoader::render('loop/start');
            while ($wp_query->have_posts()) {
                $wp_query->the_post();
                do_action('wp_website_temlate_before_loop_item', $wp_query->post, $wp_query);
                    $item_data = apply_filters('wp_website_template_parse_loop_data', array(), $wp_query->post, $wp_query);
                    TemplateLoader::render(
                        $template_files,
                        array_merge(
                            $item_data,
                            array(
                                'post' => $wp_query->post,
                                'wp_query' => $wp_query,
                            )
                        )
                    );
                do_action('wp_website_temlate_after_loop_item', $wp_query->post, $wp_query);
            }
                wp_reset_postdata();
            TemplateLoader::render('loop/end');
        } else {
            TemplateLoader::render('not-found');
        }
    }
}
