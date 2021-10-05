<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crew_Theme
 */

get_header(); ?>

    <section class="p-page">

        <div class="p-page--container row">

            <div class="o-page--content columns-12">
            
                <div class="p-page--text gta-gutenburg">

                    <?php while(have_posts()): the_post();

                        if ( is_page( 'financial-system-development' ) ) {

                            echo "<div id='growth-container'></div>";

                            the_content();

                        } else if ( is_page( 'market-competition' ) ) {

                            echo "<div id='competition-container'></div>";

                            the_content();

                        } else if ( is_page( 'modern-innovation-system' ) ) {

                            echo "<div id='innovation-container'></div>";

                            the_content();

                        } else if ( is_page( 'trade-openness' ) ) {

                            echo "<div id='trade-container'></div>";

                            the_content();

                        } else if ( is_page( 'direct-investment-openness' ) ) {

                            echo "<div id='fdi-container'></div>";

                            the_content();

                        } else if ( is_page( 'portfolio-investment-openness' ) ) {

                            echo "<div id='portfolio-container'></div>";

                            the_content();

                        } else {

                            the_content();

                        }

                    endwhile; ?>

                </div>

            </div>

        </div>

    </section>

<?php get_footer();
