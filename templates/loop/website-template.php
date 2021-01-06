<div class="loop-item website-template">
    <div class="template-inner">
        <?php if (has_post_thumbnail()) : ?>
        <div class="tpl-thumbnail"><?php the_post_thumbnail('medium_large'); ?></div>
        <?php endif; ?>
        <div class="tpl-info">
            <div class="tpl-info-inner">
                <h3 class="name"><?php the_title(); ?></h3>
                <?php if ($code) :  ?>
                <div class="code"><?php echo $code; ?></div>
                <?php endif; ?>

                <div class="tpl-actions">
                    <div class="act-view-detail">
                        <a
                            data-fslightbox
                            href="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>"
                        >View Detail</a>
                    </div>
                    <div class="act-live-demo">
                        <a target="_blank" href="<?php echo $demo_url ? $demo_url : '#'; ?>">View Demo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
