<?php

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}, 11);



function dashboard_scripts() {
    $dashboard_page = get_page_by_path( 'dashboard' );
    $dashboard_post_id = $dashboard_page->ID;
    $composite_score_data = get_field('composite_score_data', $dashboard_post_id);
    $dashboard_copy_data = get_field('dashboard_copy_data', $dashboard_post_id);

    $growth_page = get_page_by_path( 'financial-system-development' );
    $growth_post_id = $growth_page->ID;
    $competition_page = get_page_by_path( 'market-competition' );
    $competition_post_id = $competition_page->ID;
    $innovation_page = get_page_by_path( 'modern-innovation-system' );
    $innovation_post_id = $innovation_page->ID;
    $trade_page = get_page_by_path( 'trade-openness' );
    $trade_post_id = $trade_page->ID;
    $fdi_page = get_page_by_path( 'direct-investment-openness' );
    $fdi_post_id = $fdi_page->ID;
    $portfolio_page = get_page_by_path( 'portfolio-investment-openness' );
    $portfolio_post_id = $portfolio_page->ID;

    $growth_data = get_field('growth_data', $growth_post_id);
    $competition_data = get_field('competition_data', $competition_post_id);
    $innovation_data = get_field('innovation_data', $innovation_post_id);
    $trade_data = get_field('trade_data', $trade_post_id);
    $fdi_data = get_field('fdi_data', $fdi_post_id);
    $portfolio_data = get_field('portfolio_data', $portfolio_post_id);
    
    wp_enqueue_style('selectr-css', get_stylesheet_directory_uri() . '/dashboard/selectr.min.css');

    if ( is_page( 'financial-system-development' ) ) {
        $data = [
            "container" => "growth-container",
            "copy_url" => $dashboard_copy_data['url'],
            "data_url" => $growth_data['url'],
            "composite_url" => $composite_score_data['url'],
            "base_url" => get_site_url()
        ];
        wp_enqueue_script('growth-js', get_stylesheet_directory_uri() . '/dashboard/growth/bundle.js');
        wp_enqueue_style('growth-css', get_stylesheet_directory_uri() . '/dashboard/growth/bundle.css');
        wp_localize_script( "growth-js", "data_field", $data );
    } else if ( is_page( 'market-competition' ) ) {
        $data = [
            "container" => "competition-container",
            "copy_url" => $dashboard_copy_data['url'],
            "data_url" => $competition_data['url'],
            "composite_url" => $composite_score_data['url'],
            "base_url" => get_site_url()
        ];
        wp_enqueue_script('competition-js', get_stylesheet_directory_uri() . '/dashboard/competition/bundle.js');
        wp_enqueue_style('competition-css', get_stylesheet_directory_uri() . '/dashboard/competition/bundle.css');
        wp_localize_script( "competition-js", "data_field", $data );
    } else if ( is_page( 'modern-innovation-system' ) ) {
        $data = [
            "container" => "innovation-container",
            "copy_url" => $dashboard_copy_data['url'],
            "data_url" => $innovation_data['url'],
            "composite_url" => $composite_score_data['url'],
            "base_url" => get_site_url()
        ];
        wp_enqueue_script('innovation-js', get_stylesheet_directory_uri() . '/dashboard/innovation/bundle.js');
        wp_enqueue_style('innovation-css', get_stylesheet_directory_uri() . '/dashboard/innovation/bundle.css');
        wp_localize_script( "innovation-js", "data_field", $data );
    } else if ( is_page( 'trade-openness' ) ) {
        $data = [
            "container" => "trade-container",
            "copy_url" => $dashboard_copy_data['url'],
            "data_url" => $trade_data['url'],
            "composite_url" => $composite_score_data['url'],
            "base_url" => get_site_url()
        ];
        wp_enqueue_script('trade-js', get_stylesheet_directory_uri() . '/dashboard/trade/bundle.js');
        wp_enqueue_style('trade-css', get_stylesheet_directory_uri() . '/dashboard/trade/bundle.css');
        wp_localize_script( "trade-js", "data_field", $data );
    } else if ( is_page( 'direct-investment-openness' ) ) {
        $data = [
            "container" => "fdi-container",
            "copy_url" => $dashboard_copy_data['url'],
            "data_url" => $fdi_data['url'],
            "composite_url" => $composite_score_data['url'],
            "base_url" => get_site_url()
        ];
        wp_enqueue_script('fdi-js', get_stylesheet_directory_uri() . '/dashboard/fdi/bundle.js');
        wp_enqueue_style('fdi-css', get_stylesheet_directory_uri() . '/dashboard/fdi/bundle.css');
        wp_localize_script( "fdi-js", "data_field", $data );
    } else if ( is_page( 'portfolio-investment-openness' ) ) {
        $data = [
            "container" => "portfolio-container",
            "copy_url" => $dashboard_copy_data['url'],
            "data_url" => $portfolio_data['url'],
            "composite_url" => $composite_score_data['url'],
            "base_url" => get_site_url()
        ];
        wp_enqueue_script('portfolio-js', get_stylesheet_directory_uri() . '/dashboard/portfolio/bundle.js');
        wp_enqueue_style('portfolio-css', get_stylesheet_directory_uri() . '/dashboard/portfolio/bundle.css');
        wp_localize_script( "portfolio-js", "data_field", $data );
    } else {
        $data = [
            "container" => "pathfinder-dashboard-container",
            "copy_url" => $dashboard_copy_data['url'],
            "data_url" => $composite_score_data['url'],
            "base_url" => get_site_url()
        ];
        wp_enqueue_script('composite-js', get_stylesheet_directory_uri() . '/dashboard/composite/bundle.js');
        wp_enqueue_style('composite-css', get_stylesheet_directory_uri() . '/dashboard/composite/bundle.css');
        wp_localize_script( "composite-js", "data_field", $data );
    }
}
add_action( 'wp_enqueue_scripts', 'dashboard_scripts' );




?>
