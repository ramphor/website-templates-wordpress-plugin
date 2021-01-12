<?php

namespace Ramphor\WebsiteTemplate\Abstracts;

use Ramphor\WebsiteTemplate\Constracts\Renderer as RendererConstract;

abstract class Renderer implements RendererConstract
{
    protected $query_args = array();
    protected $demo_style;

    public function __construct($args = null)
    {
        if (!empty($args)) {
            $this->parseArgs($args);
        }
    }

    public function __toString()
    {
        $content = $this->render();
        if (is_string($content)) {
            return $content;
        }
        return '';
    }

    public static function parse($args = array())
    {
    }
}
