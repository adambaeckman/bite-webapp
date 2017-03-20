<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "app-content" div.
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="HandheldFriendly" content="True" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="Raccoon">
    <meta name="description" content="BITE Mark och Anläggning. Vår affärsidé är enkel — att med hög kvalitet och service, sköta entreprenad, markskötsel och anläggningsarbeten till ett konkurrenskraftigt pris.">
    <meta name="keywords" content="bite, mark, anläggning">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/appicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/appicons/android-icon-192x192.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/appicons/ms-icon-144x144.png">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/appicons/favicon.ico">

    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div id="page-loader">
    </div>

    <div id="app" class="site">

        <nav id="app-navigation" class="main-navigation" role="navigation">
            <div id="primary-nav-outer">
                <div id="primary-nav-inner" class="main-content clear">
                    <a id="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div id="nav-logo">
                        </div>
                    </a>

                    <div id="mobile-nav-toggle">
                    </div>

                    <div id="primary-nav">
                        <?php
                        // Primary navigation menu.
                        wp_nav_menu( array(
                            'menu_class'     => 'nav-menu',
                            'theme_location' => 'primary',
                            'depth'          => 2,
                            'link_before'    => '<span class="link-hover">',
                            'link_after'     => '</span>',
                            'after'          => '<div class="sub-menu-toggle"></div>'
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </nav><!-- .main-navigation -->

        <?php
        $pageTitle = get_field('page-title');

        if ( $pageTitle ) :
            $pageTitle = $pageTitle;
        else :
            $pageTitle = get_the_title();
        endif;
        ?>

        <header id="masthead" class="app-header" role="banner">
            <?php if ( is_front_page() ) : ?>
                <!-- FRONT PAGE HEADER -->
                <?php
                $headerImageUrl = get_field('start-header-image')['sizes']['desktop-full'];
                ?>
                <div id="front-header" style="background-image: url('<?php echo $headerImageUrl; ?>')">
                    <div class="front-header-content main-content">
                        <?php if ( $pageTitle ) :?>
                            <div class="front-header-text text-on-image disable-select">
                                <h1 class="split-weight"><?php echo $pageTitle; ?></h1>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="front-header-rings">
                        <div class="rings-inner">
                        </div>
                    </div>

                    <div class="section-scroll shift-left">
                    </div>
                </div>
            <?php else: ?>
                <!-- OTHER PAGE HEADER -->
                <div id="page-header-top" class="page-header section-header dark-blue">
                    <div class="section-title main-content disable-select">
                        <h3 class="split-weight"><?php echo $pageTitle; ?></h3>
                    </div>

                    <!-- PROJECT PAGE FILTERS -->
                    <?php if ( is_page_template( 'template-projects.php' ) ) : ?>

                        <?php
                        $projectCats = get_terms( array(
                            'taxonomy' => 'project-category',
                            'hide_empty' => true,
                        ) );
                        ?>

                        <?php if ( count($projectCats) > 0 ) : ?>
                            <div class="page-header-sub">
                                <div class="header-sub-mobile-toggle">
                                </div>
                                <div id="project-filter" class="header-sublist">
                                    <div class="header-sublist-inner">
                                        <div class="filter-item sublist-item-wrap current" data-group="all">
                                            <div class="sublist-item link-hover">
                                                <h5 class="thin">Alla</h5>
                                            </div>
                                        </div>
                                        <?php foreach ( $projectCats as $projectCat) : ?>
                                            <div class="filter-item sublist-item-wrap" data-group="<?php echo $projectCat->slug; ?>">
                                                <div class="sublist-item link-hover">
                                                    <h5 class="thin"><?php echo $projectCat->name; ?></h5>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>

                    <!-- SINGULAR PROJECT BACK LINK -->
                    <?php if ( is_singular( 'project' ) ) : ?>
                        <?php
                        // Get the project main page by fetching the page using that template.
                        $args = [
                            'post_type' => 'page',
                            'fields' => 'ids',
                            'nopaging' => true,
                            'meta_key' => '_wp_page_template',
                            'meta_value' => 'template-projects.php'
                        ];
                        $projectParent = get_posts( $args );
                        ?>

                        <?php if ( !empty($projectParent[0]) ) : ?>
                            <div class="page-header-sub">
                                <div class="header-sub-mobile-toggle">
                                </div>
                                <div class="header-sublist">
                                    <div class="header-sublist-inner">
                                        <div class="sublist-item-wrap">
                                            <div class="sublist-item">
                                                <h5 class="thin">
                                                    <a href="<?php echo get_the_permalink($projectParent[0]); ?>">&lt; <span class="link-hover">Alla referenser</span></a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>

                    <!-- VACANCIES PAGE TO APPLICATION LINK -->
                    <?php if ( is_page_template( 'template-vacancies.php' ) ) : ?>

                        <?php
                        // Get the application page by fetching the page using that template.
                        $args = [
                            'post_type' => 'page',
                            'fields' => 'ids',
                            'nopaging' => true,
                            'meta_key' => '_wp_page_template',
                            'meta_value' => 'template-application.php'
                        ];
                        $applicationPage = get_posts( $args );

                        if ( !empty($applicationPage[0]) ) {
                            $applicationPageID = $applicationPage[0];
                        }
                        ?>

                        <?php if ( $applicationPageID ) : ?>
                            <div class="page-header-sub">
                                <div class="header-sub-mobile-toggle">
                                </div>
                                <div class="header-sublist">
                                    <div class="header-sublist-inner">
                                        <div class="sublist-item-wrap">
                                            <div class="sublist-item">
                                                <h5 class="thin">
                                                    <a href="<?php echo get_the_permalink($applicationPageID); ?>"><span class="link-hover">Skicka ansökan</span>&gt;</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>

                    <!-- SINGULAR VACANCY BACK AND FORWARD LINKS -->
                    <?php if ( is_singular( 'vacancy' ) ) : ?>
                        <?php
                        // Get the vacancy main page by fetching the page using that template.
                        $argsVacancy = [
                            'post_type' => 'page',
                            'fields' => 'ids',
                            'nopaging' => true,
                            'meta_key' => '_wp_page_template',
                            'meta_value' => 'template-vacancies.php'
                        ];
                        $vacancyParent = get_posts( $argsVacancy );

                        if ( !empty($vacancyParent[0]) ) {
                            $vacancyParentID = $vacancyParent[0];
                            $applicationPageID = get_field('vacancy-application-page', $vacancyParentID);
                        }

                        // Get the application page by fetching the page using that template.
                        $argsApplication = [
                            'post_type' => 'page',
                            'fields' => 'ids',
                            'nopaging' => true,
                            'meta_key' => '_wp_page_template',
                            'meta_value' => 'template-application.php'
                        ];
                        $applicationPage = get_posts( $argsApplication );

                        if ( !empty($applicationPage[0]) ) {
                            $applicationPageID = $applicationPage[0];
                        }
                        ?>

                        <?php if ( $vacancyParentID || $applicationPageID ) : ?>
                            <div class="page-header-sub">
                                <div class="header-sub-mobile-toggle">
                                </div>
                                <div class="header-sublist">
                                    <div class="header-sublist-inner">
                                        <?php if ( $vacancyParentID ) : ?>
                                            <div class="sublist-item-wrap">
                                                <div class="sublist-item">
                                                    <h5 class="thin">
                                                        <a href="<?php echo get_the_permalink($vacancyParentID); ?>">&lt; <span class="link-hover">Alla lediga jobb</span></a>
                                                    </h5>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ( $applicationPageID ) : ?>
                                            <div class="sublist-item-wrap">
                                                <div class="sublist-item">
                                                    <h5 class="thin">
                                                        <a href="<?php echo get_the_permalink($applicationPageID); ?>"><span class="link-hover">Skicka ansökan</span>&nbsp;&gt;</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>

                    <!-- SEND APPLICATION PAGE BACK TO VACANCIES LINK -->
                    <?php if ( is_page_template( 'template-application.php' ) ) : ?>

                        <?php
                        // Get the vacancy main page by fetching the page using that template.
                        $args = [
                            'post_type' => 'page',
                            'fields' => 'ids',
                            'nopaging' => true,
                            'meta_key' => '_wp_page_template',
                            'meta_value' => 'template-vacancies.php'
                        ];
                        $vacancyParent = get_posts( $args );

                        if ( !empty($vacancyParent[0]) ) {
                            $vacancyParentID = $vacancyParent[0];
                            $applicationPageID = get_field('vacancy-application-page', $vacancyParentID);
                        }
                        ?>

                        <?php if ( $vacancyParentID ) : ?>
                            <div class="page-header-sub">
                                <div class="header-sub-mobile-toggle">
                                </div>
                                <div class="header-sublist">
                                    <div class="header-sublist-inner">
                                        <?php if ( $vacancyParentID ) : ?>
                                            <div class="sublist-item-wrap">
                                                <div class="sublist-item">
                                                    <h5 class="thin">
                                                        <a href="<?php echo get_the_permalink($vacancyParentID); ?>">&lt; <span class="link-hover">Alla lediga jobb</span></a>
                                                    </h5>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>

                </div> <!-- .page-header -->
            <?php endif; ?>
        </header><!-- .site-header -->

        <div id="content" class="app-content clear">
