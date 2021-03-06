<?php 

function university_files(){
    // arguments for scripts: dependences? version number (can make up)? want loaded before end body tag (aka in footer instead of header)
    //microtime() is ensuring on each refresh the version number is updated to whatever time it is, so the browser doens't use a cached version of the file and instead re-loads file
    //removed for hotload
    //wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    //removed and adjust below for hotload
    //wp_enqueue_style('university-main-styles', get_stylesheet_uri(), NULL, microtime());
    if(strstr($_SERVER['SERVER_NAME'],'fictional-university.local')){
        //for development
        wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
    } else {
        //for production
        wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.b0eb6430f760590e2b68.js'), NULL, '1.0', true);
        wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.65ac0aa29638b2e23e6c.js'), NULL, '1.0', true);
        wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.65ac0aa29638b2e23e6c.css'));
    }
   
}
add_action('wp_enqueue_scripts','university_files');

function university_features(){
    // code for dynamic menu accessible in wp-admin.  Need to add
    // register_nav_menu('headerMenuLocation', 'Header Menu Location');
    // register_nav_menu('footerLocationOne', 'Footer Location One');
    // register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'university_features');

function university_adjust_queries($query){
    $today = date('Ymd');
    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){ //only if not in the admin
        $query->set('meta_key','event_date');
        $query->set('orderby','meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key'=> 'event_date',  //only show posts where the event_date is greater >= today's date. specify numberic to make sure type matches
                'compare' => '>=',
                'value' => $today,
                'type'=> 'numeric'
              )
            ));
    }
}
add_action('pre_get_posts', 'university_adjust_queries');


// added new post types in mu-plugins folder outside of theme