<?php
namespace Ramphor\WebsiteTemplate\Constracts;

interface Renderer
{
    public function render();

    public function parseArgs($args);
}
