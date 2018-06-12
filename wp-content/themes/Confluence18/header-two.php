<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head();
    $site_logo = cws_theme_get_option( 'cws_theme_logo' );
    $site_phone = cws_theme_get_option( 'cws_theme_phone' );
    $site_email = cws_theme_get_option( 'cws_theme_email' );
    //echo $site_logo;
    ?>
</head>
<body <?php body_class(); ?>>

<a href="#" class="back-to-top" title="Back to top">
    <i class="icon-arrow-up"></i>
</a>

<header class="header-type-2">
    <div class="container-fluid">
        <div class="row ph-90">
            <div class="col-md-12 border-bottom" style="">
                <div class="header-navigation">
                    <div class="logo-top">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?= $site_logo; ?>" alt="logo" class="img-responsive">
                        </a>
                    </div>
                    <div class="main-menu">
                        <nav class="main-nav">
                            <div class="collapse2 navbar-collapse2 nav-primary" id="navbar">
                                <?php
                                wp_nav_menu( array(
                                        'menu'              => 'primary',
                                        'theme_location'    => 'primary',
                                        'depth'             => 2,
                                        'container'         => 'div',
                                        'container_class'   => 'collapse navbar-collapse',
                                        'container_id'      => 'navbar2',
                                        'menu_class'        => 'jetmenu blue',
                                        'echo'            => true,
                                        'items_wrap'      => '<ul id="%1$s" class="%2$s list">%3$s</ul>',
                                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                        'walker'            => new wp_bootstrap_navwalker())
                                );
                                ?>
                            </div>
                        </nav> <!-- End Menu -->
                    </div>
                </div>
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
        <div id="portfolio_filters" class="row ph-90">
            <div id="portfolio-page" class="container col-xs-12">
                <ul class="nav navbar-nav navbar-right filter-nav" id="filters" style="">
                    <?php
                    $terms2 = get_terms('category');
                    $count = count($terms2);
                    echo '<li><a href="javascript:void(0)" title="" data-filter=".all" data-groupid="-1" class="active filter-all-btn filter-btn">All</a></li>';
                    if ( $count > 0 ){
                        foreach ( $terms2 as $term ) {
                            //$termname = strtolower($term->name);
                            $termname = $term->name;
                            $termname = str_replace('&amp; ', '', $termname);
                            $termname = str_replace('&', '-', $termname);
                            $termname = str_replace(' ', '-', $termname);
                            echo '<li style="list-style:inline;"><a href="javascript:void(0)" title="" class="filter-btn" data-groupid="'.$termname.'" data-filter=".'.$termname.'">'.$term->name.'</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div><!--  .row -->

    </div> <!-- /.container -->
    <div class="KW_progressContainer">
        <div class="KW_progressBar">

        </div>
    </div>
</header> <!-- /.header-type-1 -->

