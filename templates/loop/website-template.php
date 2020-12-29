<li class="loop-item website-template">
    <?php if (has_post_thumbnail()) : ?>
    <div class="tpl-thumbnail"><?php the_post_thumbnail('medium'); ?></div>
    <?php endif; ?>
    <div class="tpl-info">
        <div class="tpl-info-inner">
            <h3 class="name"><?php the_title(); ?></h3>
            <?php if ($code) :  ?>
            <div class="code"><?php echo $code; ?></div>
            <?php endif; ?>

            <div class="tpl-actions">
                <a class="act-view-detail" href="<?php the_permalink(); ?>">
                    View Detail
                </a>
                <a class="act-live-demo" href="<?php echo $demo_url ? $demo_url : '#'; ?>">
                    View Demo
                </a>
            </div>
        </div>
    </div>
</li>
