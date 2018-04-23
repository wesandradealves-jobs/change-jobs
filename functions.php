<?php

$jobs_labels = array(
    'name' => _x('Jobs', 'post type general name'),
    'singular_name' => _x('Job', 'post type singular name'),
    'add_new' => _x('Add New', 'Job '),
    'add_new_item' => __('Add New Job '),
    'edit_item' => __('Edit Job '),
    'new_item' => __('New Job '),
    'view_item' => __('View Job '),
    'search_items' => __('Search Jobs'),
    'not_found' =>  __('Nothing found'),
    'not_found_in_trash' => __('Nothing found in Trash'),
    'parent_item_colon' => ''
);
$jobs = array(
        'labels' => $jobs_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'jobs', 'with_front' => true ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'excerpt', 'editor', 'thumbnail', 'custom-fields')
);
register_post_type( 'jobs', $jobs );

function create_jobs_taxonomies() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
    );
    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categories' ),
    );
    register_taxonomy( 'jobs_categories', array( 'jobs' ), $args );
}
add_action( 'init', 'create_jobs_taxonomies');

// 

function create_jobs_locations() {
    $labels = array(
        'name'              => _x( 'Locations', 'taxonomy general name' ),
        'singular_name'     => _x( 'Location', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Locations' ),
        'all_items'         => __( 'All Locations' ),
        'parent_item'       => __( 'Parent Location' ),
        'parent_item_colon' => __( 'Parent Location:' ),
        'edit_item'         => __( 'Edit Location' ),
        'update_item'       => __( 'Update Location' ),
        'add_new_item'      => __( 'Add New Location' ),
        'new_item_name'     => __( 'New Location Name' ),
        'menu_name'         => __( 'Locations' ),
    );
    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categories' ),
    );
    register_taxonomy( 'jobs_locations', array( 'jobs' ), $args );
}
add_action( 'init', 'create_jobs_locations');

// 

function my_vc_shortcode_blog_search( $atts ) {   
    echo '<form role="search" method="get" id="searchform" action="'.esc_url( home_url( "/" ) ).'">
    <input name="s" type="text" value="'.get_search_query().'" placeholder="by Typing a keyword" />
    <p><i class="glyphicon glyphicon-tag"><!-- --></i> <strong>by Tag</strong></p><ul>';
        $categories = get_categories(array("hide_empty" => 0,"type"=> "post","orderby"=> "name"));
        $posttags = get_terms( 'post_tag', array( 'hide_empty' => false, 'parent' => 0 ) );
        foreach ($posttags as $tag) {
            echo "<li><div class='custom-checkbox'><div><input value='".strtolower($tag->slug)."' id='".$tag->name."' name='tag[]' type='checkbox' /><label for='".$tag->name."'><span></span>".$tag->name."</label></div></div></li>";
        }
        echo '</ul><p><i class="glyphicon glyphicon-list-alt"><!-- --></i> <strong>by Category</strong></p><ul>';
        foreach($categories as $category) { 
            echo "<li><div class='custom-checkbox'><div><input value='".strtolower($category->term_id)."' id='".$category->name."' name='cat[]' type='checkbox' /><label for='".$category->name."'><span></span>".$category->name."</label></div></div></li>";
        }  
    echo '</ul><p class="text-center">
        <button class="btn btn-default btn-default-style-2">Search</button>
        <input type="hidden" name="post_type" value="post" />
        </p></form>';
}
add_shortcode( 'my_vc_php_output_blog_search', 'my_vc_shortcode_blog_search');

function my_vc_shortcode( $atts ) {   
    echo '<form role="search" method="post" id="searchform" action="'.esc_url( home_url( "/" ) ).'"><p><i class=" glyphicon glyphicon-map-marker"><!-- --></i> <strong>Location</strong></p><div class="custom-select"><select name="jobs_locations" id="jobs_locations" ><option value=""></option>}
    option';
        $jobs_categories = get_terms( array(
            'taxonomy' => 'jobs_categories',
            'hide_empty' => false,
        ));
        $jobs_locations = get_terms( array(
            'taxonomy' => 'jobs_locations',
            'hide_empty' => false,
        ));
        foreach ( $jobs_locations as $term ) {
            if(strtolower($term->slug)=="victoria") {
                echo "<option selected='selected' value='".strtolower($term->slug)."'>".$term->name."</option>";  
            } else {
                echo "<option value='".strtolower($term->slug)."'>".$term->name."</option>";
            }  
        } 
        echo '</select></div><p><i class="glyphicon glyphicon-list-alt"><!-- --></i> <strong>Category</strong></p><ul>';
        foreach ( $jobs_categories as $term ) {
            echo "<li><div class='custom-checkbox'><div><input value='".strtolower($term->slug)."' id='".$term->name."' name='jobs_categories[]' type='checkbox' /><label for='".$term->name."'><span></span>".$term->name."</label></div></div></li>";
        }  
    echo '</ul><p class="text-center"><button class="btn btn-default btn-default-style-2">Search for jobs</button><input type="hidden" value="'.get_search_query().'" name="s" id="s" /><input type="hidden" name="post_type" value="jobs" /></p></form>';
}
add_shortcode( 'my_vc_php_output', 'my_vc_shortcode');

function my_vc_shortcode_blog( $atts ) {
    $query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' =>  3, 'order' => 'ASC'));
    if($query->have_posts()=="1"){
      while ( $query->have_posts() ) : $query->the_post();
      echo '
          <article class="blog-post blog-post__'.$post->ID.' col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center-xs">
            <div style="background-image:url('.wp_get_attachment_url(get_post_thumbnail_id($post->ID), full).')" class="blog-post__thumbnail"><!-- --></div>
            <h3>'.get_the_title().'</h3>
            <p><small>Posted in '.get_the_date().'</small></p>
            <p><a href="'.get_the_permalink().'" title="'.get_the_title().'">'.substr(get_the_content(), 0, 140).'...</a></p><p>';
            the_tags();
      echo '
            </p>
            <p class="text-center-xs"><a class="btn btn-default btn-default-style-2" href="'.get_the_permalink().'" title="'.get_the_title().'">Read More</a></p>
          </article>
        ';
    endwhile; 
    wp_reset_query();   
    } else {
      echo "<p>Nenhuma notícia encontrada :-(</p>";
    }    
}
add_shortcode( 'my_vc_php_output_blog', 'my_vc_shortcode_blog');

function my_vc_shortcode_form( $atts ) {
    echo '<iframe width="100%" height="600" frameborder="0" src="https://educationchangemakers.typeform.com/to/VQrP6D"></iframe>';   
}
add_shortcode( 'my_vc_php_output_form', 'my_vc_shortcode_form');

function loginRedirect( $redirect_to, $request, $user ){
    if( is_array( $user->roles ) ) { // check if user has a role
        return get_bloginfo('url')."/wp-admin/edit.php?post_type=page";
    }
}
add_filter("login_redirect", "loginRedirect", 10, 3);

function remove_menus(){
  
  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'jetpack' );                    //Jetpack* 
  // remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  // remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'plugins.php' );                //Plugins
  // remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  // remove_menu_page( 'options-general.php' );        //Settings
  
}


add_action( 'admin_menu', 'remove_menus' );

// 

add_action( 'init', 'getrid' );

function getrid() {
  // remove_post_type_support( 'page', 'editor' );
  remove_post_type_support( 'page', 'thumbnail' );
  remove_post_type_support( 'page', 'page-attributes' );
}

// Handle the post_type parameter given in get_terms function

function df_terms_clauses($clauses, $taxonomy, $args) {
    if (!empty($args['post_type'])) {
        global $wpdb;
        $post_types = array();
        foreach($args['post_type'] as $cpt) {
            $post_types[] = "'".$cpt."'";
        }
        if(!empty($post_types)) {
            $clauses['fields'] = 'DISTINCT '.str_replace('tt.*', 'tt.term_taxonomy_id, tt.term_id, tt.taxonomy, tt.description, tt.parent', $clauses['fields']).', COUNT(t.term_id) AS count';
            $clauses['join'] .= ' INNER JOIN '.$wpdb->term_relationships.' AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN '.$wpdb->posts.' AS p ON p.ID = r.object_id';
            $clauses['where'] .= ' AND p.post_type IN ('.implode(',', $post_types).')';
            $clauses['orderby'] = 'GROUP BY t.term_id '.$clauses['orderby'];
        }
    }
    return $clauses;
}
add_filter('terms_clauses', 'df_terms_clauses', 10, 3);
// 
// function add_taxonomies_to_pages() {
//  register_taxonomy_for_object_type( 'category', 'page' );
//  }
// add_action( 'init', 'add_taxonomies_to_pages' );
// if ( ! is_admin() ) {
//    add_action( 'pre_get_posts', 'category_and_tag_archives' );
   
// }
// function category_and_tag_archives( $wp_query ) {
//     $my_post_array = array('post','page');
    
//     if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'jobs_cateo' ) )
//        $wp_query->set( 'post_type', $my_post_array );
   
//    if ( $wp_query->get( 'tag' ) )
//        $wp_query->set( 'post_type', $my_post_array );
// }
// 
function themeslug_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'logo_section' , array(
        'title'       => __( 'Logo', 'themeslug' ),
        'priority'    => 1
    ));
    $wp_customize->add_setting( 'logo' );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
        'label'    => __( 'Logo', 'themeslug' ),
        'section'  => 'logo_section',
        'settings' => 'logo'
    )));  
    $wp_customize->add_section( 'footer' , array(
        'title'       => __( 'Footer', 'themeslug' ),
        'priority'    => 2
    ));
    $wp_customize->add_setting( 'blog_description' );
    $wp_customize->add_control('blog_description',  array(
        'label' => 'Blog description',
        'section' => 'footer',
        'type' => 'textarea',
        'settings' => 'blog_description'
    ));
    $wp_customize->add_setting( 'blog_contact' );
    $wp_customize->add_control('blog_contact',  array(
        'label' => 'Blog contact',
        'section' => 'footer',
        'type' => 'text',
        'settings' => 'blog_contact'
    ));
    $wp_customize->add_setting( 'blog_address' );
    $wp_customize->add_control('blog_address',  array(
        'label' => 'Blog address',
        'section' => 'footer',
        'type' => 'textarea',
        'settings' => 'blog_address'
    ));
}
add_action( 'customize_register', 'themeslug_theme_customizer' );

function remove_customizer_settings( $wp_customize ){
  $wp_customize->remove_panel('nav_menus');
  $wp_customize->remove_section('static_front_page');
}
add_action( 'customize_register', 'remove_customizer_settings', 20 );

// 
function get_the_category_bytax( $id = false, $tcat = 'category' ) {
    $categories = get_the_terms( $id, $tcat );
    if ( ! $categories )
        $categories = array();
    $categories = array_values( $categories );
    foreach ( array_keys( $categories ) as $key ) {
        _make_cat_compat( $categories[$key] );
    }
    // Filter name is plural because we return alot of categories (possibly more than #13237) not just one
    return apply_filters( 'get_the_categories', $categories );
}
// 
function get_custom_field_data($key, $echo = false) {
    global $post;
    $value = get_post_meta($post->ID, $key, true);
    if($echo == false) {
        return $value;
    } else {
        echo $value;
    }
}
//
function hide_admin_bar() {
    wp_add_inline_style('admin-bar', '<style> html { margin-top: 0 !important; } </style>');
    return false;
}
add_filter( 'show_admin_bar', 'hide_admin_bar' );
//
function menu() {
  register_nav_menus(
    array(
      'header' => __( 'Header' )
    )
  );
}
add_action( 'init', 'menu' );

//

function updateNumbers() {
    global $wpdb;
    $querystr = "SELECT $wpdb->posts.* FROM $wpdb->posts WHERE $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'post' ";
    $pageposts = $wpdb->get_results($querystr, OBJECT);
    $counts = 0 ;
    if ($pageposts):
    foreach ($pageposts as $post):
    setup_postdata($post);
    $counts++;
    add_post_meta($post->ID, 'incr_number', $counts, true);
    update_post_meta($post->ID, 'incr_number', $counts);
    endforeach;
    endif;
}
 
add_action ( 'publish_post', 'updateNumbers' );
add_action ( 'deleted_post', 'updateNumbers' );
add_action ( 'edit_post', 'updateNumbers' );

// 

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 600, 600 );

// 

// if (class_exists('MultiPostThumbnails')) {
//     for ($i=1;$i<5;$i++) {
//         new MultiPostThumbnails(
//             array(
//                 'label' => 'Image '.$i,
//                 'id' => 'featured-image-'.$i,
//                 'post_type' => 'page'
//             )
//         ); 
//     }
// }

// 

update_option( 'siteurl', 'http://localhost/change-jobs-2' );
update_option( 'home', 'http://localhost/change-jobs-2' );

// 

require_once('class-tgm-plugin-activation.php');

function register_required_plugins() {
    $plugins = array(
        array(
            'name' => 'js_composer',
            'slug' => 'js_composer', 
            'source' => get_template_directory_uri() . '/plugins/js_composer', 
            'required' => true, 
            'version' => '', 
            'force_activation' => true, 
            'force_deactivation' => false, 
            'external_url' => '',
        ),
    );
    /**
    * Array of configuration settings. Amend each line as needed.
    * If you want the default strings to be available under your own theme domain,
    * leave the strings uncommented.
    * Some of the strings are added into a sprintf, so see the comments at the
    * end of each line for what each argument will be.
    */
    $config = array(
        'default_path' => '', // Default absolute path to pre-packaged plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
        'strings' => array(
        'page_title' => __( 'Install Required Plugins', 'tgmpa' ),
        'menu_title' => __( 'Install Plugins', 'tgmpa' ),
        'installing' => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
        'oops' => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
        'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
        'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
        'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
        'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
        'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
        'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
        'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
        'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
        'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
        'activate_link' => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
        'return' => __( 'Return to Required Plugins Installer', 'tgmpa' ),
        'plugin_activated' => __( 'Plugin activated successfully.', 'tgmpa' ),
        'complete' => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
        'nag_type' => 'updated' // Determines admin notice type – can only be 'updated', 'update-nag' or 'error'.
        )
    );
    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'register_required_plugins');
// 
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if(is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('nav_menu_item','post','articles');
    $query->set('post_type',$post_type);
    return $query;
    }
}
// 
function custom_pagination($numpages = '', $pagerange = '', $paged='') {
  if (empty($pagerange)) {
    $pagerange = 2;
  }
  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }
  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => False,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );
  $paginate_links = paginate_links($pagination_args);
  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      echo $paginate_links;
    echo "</nav>";
  }
}
function my_formatter($content) {
 $new_content = '';
 $pattern_full = '{(\[raw\].*?\[/raw\])}is';
 $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
 $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
 
 foreach ($pieces as $piece) {
 if (preg_match($pattern_contents, $piece, $matches)) {
 $new_content .= $matches[1];
 } else {
 $new_content .= wptexturize(wpautop($piece));
 }
 }
 
 return $new_content;
}
add_filter('the_content', 'my_formatter', 99);

// 

// Register widgetized areas
if ( ! function_exists( 'the_widgets_init' ) ) {
    function the_widgets_init() {
    if ( ! function_exists( 'register_sidebars' ) )
    return;
        register_sidebar(
        array(
        'id'            => 'search',
        'name'          => __( 'Search Sidebar' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        )
        );
        register_sidebar(
        array(
        'id'            => 'jobs',
        'name'          => __( 'Jobs Sidebar' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        )
        );
        register_sidebar(
        array(
        'id'            => 'filter',
        'name'          => __( 'Filter Sidebar' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
        )
        );
    } // End the_widgets_init()
}
add_action( 'init', 'the_widgets_init' );

?>