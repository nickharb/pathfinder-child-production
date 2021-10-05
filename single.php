<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Crew_Theme
 */

get_header(); ?>

    <?php
        $postID = get_the_ID();
        if ( get_field( 'banner_type' ) == 'marquee' ) {
            $format = 'marquee';
        } else {
            $format = 'standard';
        }

        $vimeo_url = get_field( 'vimeo_url' );
        $vid_over_img = get_field( 'display_video_instead_of_image' );
        $hide_featured_vid = get_field( 'hide_featured_video_on_single_post' );
    ?>

    <section class="ac-single-post <?php echo $format; ?>">

        <div class="ac-single-post--container row">

            <div class="columns-12 column-center">

                <div class="ac-single-post--content">

                    <!-- <header>
                        <h1 class="single-post-title"><?php //the_title(); ?></h1>
                        <p class="single-post-date"><?php //echo get_the_date('D, M j, Y', $postID); ?></p>
                    </header> -->

                    <?php if ( $format == 'marquee' ) : ?>
                        <?php $hide_date = get_field( 'hide_post_date' ); ?>
                        <header class="ac-single-post--marquee">
                            <?php if ( ! $hide_date ) : ?>
                            <p class="ac-single-post--marquee--heading s-tag-button"><?php echo get_the_date('D, M j, Y', $postID); ?></p>
                            <?php endif; ?>
                            <h2 class="ac-single-post--marquee--title"><?php the_title(); ?></h2>
                            <?php
                            $cats = wp_get_post_terms( $postID, array('content-type') );
                            if ( ! $cats || empty( $cats ) ) {
                                $cats = wp_get_post_terms( $postID, array('category') );
                            }
                            $expert_author = get_field( 'expert_author', $postID, false );
                            $author_linked_expert = get_field( 'author_linked_to_expert', $postID );

                            if ( $expert_author && $author_linked_expert ) {
                                $author_alias = "";
                                $author_array = array();
                                foreach( $expert_author as $post ){
                                    setup_postdata($post);
                                    $author_array[] .= '<a class="gta-site-banner--tax--expert gta-post-site-banner--tax--expert" href="'.get_the_permalink($post).'">'. get_the_title($post).'</a>';
                                }

                                if ( count($author_array) > 0 ){
                                    $author_alias = implode(", ", $author_array);
                                }
                            } else {
                                $author_alias = '<span class="gta-embed--tax--expert gta-post-embed--tax--expert" >'.get_field( 'author_alias', $postID ).'</span>';
                            }
                            $experts = get_field( 'related_experts', $postID );
                            $author = get_the_author();

                            if ( $cats || $author || $author_alias ) :
                            ?>
                                <p class="ac-single-post--marquee--tax">
                                    <?php if ( $cats ) : ?>
                                        <span class="gta-site-banner--tax--cats gta-post-site-banner--tax--cats"><?php echo $cats[0]->name; ?></span>
                                    <?php endif; ?>
                                    <?php if ( $cats && $author_alias ) : ?>
                                        <span class="gta-site-banner--tax--connect gta-post-site-banner--tax--connect">by</span>
                                    <?php endif; ?>
                                    <?php if( $author_alias ) :?>
                                        <?php echo $author_alias; ?>
                                    <?php endif; ?>
                                </p>
                            <?php
                            endif; ?>
                            <?php
                            //simplified format for expert meta data.
                            $test1 = get_post_meta( $postID, 'expert_author', true );
                            $test2 = get_post_meta( $postID, 'related_experts', true );
                            $author_expert = get_post_meta( $postID, 'author_linked_to_expert', true );
                            $repeated_experts = false;
                            $display_experts = false;
                            // check if there repeated experts.
                            if ( $author_expert && !empty($test1) && !empty($test2) ) {
                                $repeated_experts = array_intersect($test2, $test1);
                            }

                            if ( ( $test2 && !$test1 ) || ( $test2 && !$author_expert ) ) {
                                // not author experts so display related experts
                                $display_experts = true;
                            } elseif( $repeated_experts && count($repeated_experts) != count($test2) ) {
                                // if the repeated experts are not the same number as related experts display them.
                                $display_experts = true;

                            }

                            if( $display_experts ) : ?>
                                <p class="ac-single-post--marquee--tax">
                                    <span class="gta-site-banner--tax--cats gta-post-site-banner--tax--cats">Related Experts: </span>
                                    <?php foreach ( $experts as $expert ) :
                                        // don't display expert if they're also in the author byline.
                                        if ( !empty($author_linked_expert) && !empty($test1) && !empty($test2) && in_array(  $expert->ID, $repeated_experts) ){
                                            continue;
                                        }
                                        ?>
                                        <a class="ac-single-post--marquee--tax--expert" href="<?php echo get_permalink( $expert->ID ); ?>"><?php echo get_the_title( $expert->ID ); ?><span>,</span></a>
                                    <?php endforeach; ?>
                                </p>
                            <?php endif; ?>

                            <?php
                                $terms = wp_get_post_terms( $postID, array('regions','issues','languages') );
                                if ( $terms ) :
                            ?>
                                <div class="ac-single-post--marquee--terms">
                                    <?php
                                        foreach ( $terms as $term ) :
                                            $term_link = get_term_link( $term );
                                    ?>
                                        <a class="s-pill large" href="<?php echo $term_link; ?>"><?php echo $term->name; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php
                                if ( get_field( 'banner_image' ) ) {
                                    $featured_img = get_field( 'banner_image' );
                                    $featured_caption = $featured_img['caption'];
                                } elseif ( has_post_thumbnail() ) {
                                    $featured_caption = get_the_post_thumbnail_caption( $postID );
                                }
                                if ( $featured_caption ) :
                            ?>
                                <p class="ac-single-post--marquee--caption"><?php echo $featured_caption; ?></p>
                            <?php endif; ?>


                            </header>


                    <?php endif; ?>


                    <?php if ( is_singular('post') ) : ?>
                        <?php if ( $vimeo_url && $vid_over_img && !$hide_featured_vid ) : ?>
                            <div class="ac-single-post--featured-video ac-featured-video">
                                <iframe src="<?php echo esc_url( $vimeo_url ); ?>" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                            </div>
                        <?php elseif ( has_post_thumbnail() && $format !== 'marquee' ) : ?>
                            <?php
                            $featured_img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                            $featured_caption = get_the_post_thumbnail_caption( get_the_ID() ); ?>
                            <!-- <div class="gta-site-banner--image gta-post-site-banner--image">
                                <img src="<?php echo $featured_img; ?>" alt="<?php the_title(); ?>" />
                                <?php if ( $featured_caption ) : ?>
                                    <p class="gta-site-banner--image-caption gta-post-site-banner--image-caption"><?php echo $featured_caption; ?></p>
                                <?php endif; ?>
                            </div> -->
                        <?php endif; ?>
                    <?php endif; ?>


                    <?php wp_reset_postdata(); ?>
                    <?php if ( have_rows( 'keypoints' ) ) { ?>
                        <div class="ac-single-post--key-points-wrapper row">
                            <div class="ac-single-post--key-points-title columns-3">
                                <h3><?php the_field('keypoint_title'); ?></h3>
                            </div>
                            <div class="ac-single-post--key-points columns-9">
                                <ul class="">
                        <?php
                            while( have_rows( 'keypoints' ) ) {
                                the_row();
                                echo "<li>".get_sub_field('keypoint')."</li>";
                            }
                        ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                    <?php while(have_posts()): the_post();
                        the_content();
                    endwhile; ?>

                </div>

            </div>

        </div>

    </section>

<?php get_footer();
