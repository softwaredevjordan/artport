<?php
function tatport_files() {
    wp_enqueue_script('jQuery','https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', NULL, NULL, true);
    wp_enqueue_style('tatport_styles', get_stylesheet_uri());
    wp_enqueue_script('index-js', get_theme_file_uri('/js/index.js'), NULL, NULL, true);
    wp_enqueue_script('popper','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',NULL, NULL, true);
    wp_enqueue_script('bootstrap-js','https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', NULL, NULL, true);
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
    wp_localize_script('index-js' , 'siteURL', array(
        'siteURL' => get_site_url(),
        'ajax' => admin_url('admin-ajax.php')));
   
    
      
};

add_action('wp_enqueue_scripts','tatport_files');

function tatport_title() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
};

add_action('after_setup_theme','tatport_title');

function server_side_ajax() {
    if (isset($_REQUEST) ) {
        $clicked = $_REQUEST['input'];
    }
    
    $html = '';

    if($clicked == 'artist'){
        $args = array('ink','sketches');
    }
    else if($clicked == 'ink'){
        $args = array('ink');
    }
    else if($clicked == 'drawings'){
        $args = array('sketches');
    }
    
    $wpq = new WP_Query(array(
        'post_per_page' => -1,
        'post_type' => $args
    ));
    
     if($wpq->have_posts()):
        while($wpq->have_posts()):
            $wpq->the_post();
            $html .= '<div class="post">
                    <a href="'.get_permalink($wpq->post->ID).'">
                    <img class="images" src="'.get_the_post_thumbnail_url($wpq->post->ID,$size = "medium").'" alt="">
                    <p class="title">'.get_the_title().'</p>
                    </a>   
            </div>';
        endwhile;
    endif;
    wp_reset_postdata();
    echo $html;
    wp_die();
}

add_action('wp_ajax_server_side_ajax', 'server_side_ajax');
add_action('wp_ajax_nopriv_server_side_ajax', 'server_side_ajax' ); 

function tatPort_post_types() {
    register_post_type('sketches', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'rewrite' => array('slug' => 'sketches'),
        'public' => true,
        'labels' => array(
          'name' => 'Sketches',
          'add_new_item' => 'Add New Sketch',
          'edit_item' => 'Edit Sketch',
          'all_items' => 'All Sketches',
          'singular_name' => 'sketch'
        ),
        'menu_icon' => 'dashicons-edit-large'
    ));

    register_post_type('ink', array(
      'show_in_rest' => true,
      'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
      'rewrite' => array('slug' => 'ink'),
      'public' => true,
      'labels' => array(
        'name' => 'Ink',
        'add_new_item' => 'Add New Ink',
        'edit_item' => 'Edit Ink',
        'all_items' => 'All Ink',
        'singular_name' => 'Ink'
      ),
      'menu_icon' => 'dashicons-admin-customizer'
  ));

}

add_action('init', 'tatPort_post_types');

?>