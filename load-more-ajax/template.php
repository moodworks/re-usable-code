    <div class="wrap">
        <div id="primary" class="content-area">
            <?php $args = array(
                'post_type' => 'YOUR-POST-TYPE-HERE',
                'post_status' => 'publish',
                'posts_per_page' => '3',
                'paged' => 1,
                'order' => 'ASC',
            );
            $blog_posts = new WP_Query($args); ?>
            <?php if ($blog_posts->have_posts()) : ?>
                <div class="blog-posts">
                    <?php while ($blog_posts->have_posts()) : $blog_posts->the_post(); ?>
                        <h2><?php the_title(); ?></h2>
                        <?php the_excerpt(); ?>
                    <?php endwhile; ?>
                </div>
                <div class="loadmore">Load More</div>
                <span class="no-more-post"></span>
            <?php endif; ?>
        </div>
    </div>
