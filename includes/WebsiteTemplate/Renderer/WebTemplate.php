<?php
namespace Ramphor\WebsiteTemplate\Renderer;

use Ramphor\WebsiteTemplate\Abstracts\Renderer;
use Ramphor\WebsiteTemplate\TemplateLoader;

class WebTemplate extends Renderer
{
    public function render()
    {
        $wp_query = $this->get_wp_query();
        if ($wp_query->have_posts()) {
            TemplateLoader::render('loop/start');
            while ($wp_query->have_posts()) {
                $wp_query->the_post();
                do_action('wp_website_temlate_before_loop_item', $wp_query->post, $wp_query);
                    $item_data = apply_filters('wp_website_template_parse_loop_data', array(), $wp_query->post, $wp_query);
                    TemplateLoader::render(
                        'loop/website-template',
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
