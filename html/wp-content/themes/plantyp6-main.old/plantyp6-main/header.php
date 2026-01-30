<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php blankslate_schema_type(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <?php wp_head(); ?>
    <!--<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400..800&display=swap" rel="stylesheet">-->
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="wrapper" class="hfeed">
        <header id="header" class="headerp6" role="banner">
            <div id="branding">
                <a href="https://www.planty.local/"><img class="header-logo" src="https://www.planty.local/wp-content/themes/plantyp6child/images/logo.png" alt="Logo Planty"></a>
            </div>
            <nav id="menu" class="" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'blankslate' ); ?>" itemscope itemtype="https://schema.org/SiteNavigationElement">
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
            </nav>
        </header>

        <div id="container">
            <main id="content" role="main">