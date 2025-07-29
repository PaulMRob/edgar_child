<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header-login" role="banner">
  <div class="site-branding-login">
    <?php
    if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
    }
    ?>
    <h1 class="login-heading">Please Login to access EDGAR data.</h1>
  </div>
</header>


