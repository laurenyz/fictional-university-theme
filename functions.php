<?php 

function university_files(){
    // arguments for scripts: dependences? version number (can make up)? want loaded before end body tag (aka in footer instead of header)
    //microtime() is ensuring on each refresh the version number is updated to whatever time it is, so the browser doens't use a cached version of the file and instead re-loads file
    //removed for hotload
    //wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    //removed for hotload
    //wp_enqueue_style('university-main-styles', get_stylesheet_uri(), NULL, microtime());
    //adjusted for hotload
    wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
}

function university_features(){
    // code for dynamic menu accessible in wp-admin.  Need to add
    // register_nav_menu('headerMenuLocation', 'Header Menu Location');
    // register_nav_menu('footerLocationOne', 'Footer Location One');
    // register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');
}

add_action('wp_enqueue_scripts','university_files');
add_action('after_setup_theme', 'university_features');

