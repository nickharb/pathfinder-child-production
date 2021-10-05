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

$composite_score_data = get_field('composite_score_data');

get_header(); ?>

    <section class="p-page">

        <div class="p-page--container row">

            <div class="o-page--content columns-12">
            
                <div class="p-page--text gta-gutenburg">

                    <?php while(have_posts()): the_post();

                        if ( is_front_page()) {

                            // Add quarterly updates logic here

                            echo "<div id='pathfinder-dashboard-container'></div>";

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
