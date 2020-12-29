<?php

namespace Ramphor\WebsiteTemplate\Abstracts;

use WP_Query;
use Ramphor\WebsiteTemplate\Constracts\Renderer as RendererConstract;

abstract class Renderer implements RendererConstract
{
    protected $query_args = array();

    public function __construct($args = null) {
        if (!empty($args)) {
            $this->parseArgs($args);
        }
    }

    public function parseArgs($args = array()) {
        if (isset($args['limit'])) {
            $this->setLimit($args['limit']);
        }
    }

    public static function parse($args = array()) {
    }

    public function get_wp_query() {
        $args = wp_parse_args(array(
            'post_type' => 'web_template'
        ), $this->query_args);
        $wp_query = new WP_Query($args);
        return apply_filters(
            'wp_website_templates_get_wp_query',
            $wp_query,
            $this
        );
    }

    /**
     * Parse args methods
     */
    public function setLimit($limit) {
        $this->query_args['posts_per_page'] = intval($limit);
    }
}
