<?php
// Enqueue parent styles
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', ['parent-style'] );
}, 10 );


// Redirect unauthenticated users away from all pages except login/register
add_action( 'template_redirect', function() {
    if (
        ! is_user_logged_in() &&
        ! is_page(['login', 'register']) &&
        ! is_admin() &&
        ! wp_doing_ajax()
    ) {
        wp_redirect( home_url('/login/') );
        exit;
    }
});
// redirect users to home page after login
add_filter('login_redirect', function($redirect_to, $request, $user) {
    return home_url('/');
}, 10, 3);

//redirect users to login page after logout
add_action('wp_logout', function() {
    wp_redirect(home_url('/login/'));
    exit;
});

//force template for specific pages
add_filter( 'template_include', function( $template ) {
    if ( is_page( 'login' ) ) {
        $custom = get_stylesheet_directory() . '/page-login.php';
        if ( file_exists( $custom ) ) {
            return $custom;
        }
    }
    return $template;
});

// Redirect login failures back to /login 
add_action( 'wp_login_failed', function( $username ) {
    wp_redirect( home_url( '/login/?login=failed' ) );
    exit;
});

// Intercept empty username/password
add_filter( 'authenticate', function( $user, $username, $password ) {
    if ( empty( $username ) || empty( $password ) ) {
        wp_redirect( home_url( '/login/?login=empty' ) );
        exit;
    }
    return $user;
}, 30, 3 );

add_action('template_redirect', function() {
    if ( is_page('register') && is_user_logged_in() ) {
        wp_redirect(home_url('/'));
        exit;
    }
});

add_action( 'loop_start', function() {
    if ( is_category( 'research' ) && ! is_paged() ) { 
        echo '<p class="category-disclaimer" style="background: #f9f9f9; padding: 10px; border: 1px solid #ddd;">
                Animal Research Disclaimer: We are committed to the ethical and responsible use of animals in medical research. All studies involving animals are conducted in full compliance with applicable animal care and use guidelines, including those established by the U.S. Public Health Service Policy on Humane Care and Use of Laboratory Animals and the European Directive 2010/63/EU. Our protocols are reviewed and approved by institutional animal care and use committees (IACUCs) or equivalent bodies to ensure the highest standards of animal welfare.
              </p>';
    }
});
