<div class="post ">
    <div class="post-thumbnail">
        <?php the_post_thumbnail(); ?>
    </div>
    <div class="post-info flex-center-start gap-18">
        <div class="post-category flex-center-between gap-10">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/folder.png" alt="folder icon" />
            <p><?php the_category(', '); ?></p>
        </div>
        <div class="post-author flex-center-between gap-10">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/folder.png" alt="folder icon" />
            <p>
                <?php
                if (!empty($author)) {
                    echo $author;
                } else {
                    echo $userAdmin;
                }
                ?>
            </p>
        </div>
        <div class="post-comments flex-center-between gap-10">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/comments.png" alt="comments icon" />
            <p>
                <?= $commentCount ?>
            </p>
        </div>
    </div>
    <div class="post-content">
        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    </div><!-- .post-content -->
</div><!-- .post -->