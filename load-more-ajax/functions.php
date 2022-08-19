<?php 
//ADD TO FUNCTIONS.PHP
function load_more_enqueue_script_style() {
    if (is_post_type_archive('YOUR-POST-TYPE-SLUG')) {
        wp_enqueue_script('load-more', get_template_directory_uri() . '/assets/js/load-more.js', array('jquery'), false, true);
    }
    // Localize the script with new data
    $script_data_array = array(
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'security' => wp_create_nonce( 'load_more_posts' ),
    );
    wp_localize_script( 'load-more', 'blog', $script_data_array );
    // Enqueued script with localized data.
    wp_enqueue_script( 'load-more' ); 
  }
  add_action( 'wp_enqueue_scripts', 'load_more_enqueue_script_style' );
  
  function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $args = array(
      'post_type' => 'kampanja',
      'post_status' => 'publish',
      'posts_per_page' => '3',
      'paged' => $paged,
      'order' => 'ASC',
    );
    $blog_posts = new WP_Query( $args ); ?>
    <?php if ( $blog_posts->have_posts() ) : ?>
      <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
        <h2><?php the_title(); ?></h2>
        <?php the_excerpt(); ?>
      <?php endwhile; 
    endif;
    wp_die();
  }
  add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
  add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');
