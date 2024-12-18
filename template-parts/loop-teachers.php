<section>
    <a href="<?php the_permalink(); ?>">
        <figure>
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('medium'); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage_600x400.png" alt="">
            <?php endif; ?>
        </figure>
        <?php the_title(); ?>
        <?php the_excerpt(); ?>
</section>