<?php
function get_website_template_code($post_id)
{
    return get_post_meta($post_id, '_web_template_code', true);
}

function get_website_template_demo_url($post_id)
{
    return get_post_meta($post_id, '_web_template_demo_url', true);
}
