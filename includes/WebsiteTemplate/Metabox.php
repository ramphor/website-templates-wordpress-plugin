<?php
namespace Ramphor\WebsiteTemplate;

class Metabox
{
    public function register_metabox()
    {
        add_meta_box(
            'web-templates-meta',
            __('Template Metas', 'wp_web_templates'),
            array( $this, 'render_metabox'),
            PostType::WEB_POST_TYPE,
            'side',
            'high'
        );
    }

    public function render_metabox($post)
    {
        ?>
        <p>
            <label for="">
                CODE
            </label>
            <input class="widefat" type="text" name="web_template_code" value="<?php echo get_post_meta($post->ID, '_web_template_code', true); ?>" />
        </p>
        <p>
            <label for="">
                Demo URL
            </label>
            <input class="widefat" type="text" name="demo_url" value="<?php echo get_post_meta($post->ID, '_web_template_demo_url', true); ?>" />
        </p>
        <?php
    }

    public function save($post_id, $post)
    {
        if ($post->post_type !== PostType::WEB_POST_TYPE) {
            return;
        }

        if (isset($_POST['web_template_code'])) {
            $template_code = $_POST['web_template_code'];
            if (!empty($template_code)) {
                update_post_meta($post_id, '_web_template_code', $template_code);
            }
        }
        if (isset($_POST['demo_url'])) {
            $template_code = $_POST['demo_url'];
            if (!empty($template_code)) {
                update_post_meta($post_id, '_web_template_demo_url', $template_code);
            }
        }
    }
}
