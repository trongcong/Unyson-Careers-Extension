<?php
get_header();
global $wp_query;

$yolo_sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right';

$ext_careers_instance = fw()->extensions->get( 'careers' );
$ext_careers_settings = $ext_careers_instance->get_settings();
$thumbnails           = fw_ext_careers_get_gallery_images();
$term_list            = get_the_term_list( get_the_ID(), $ext_careers_instance->get_taxonomy_name(), '', ', ' );


$prevPost = get_previous_post();
$nextPost = get_next_post();

?>
    <section class="bt-main-row <?php yolo_get_content_class( 'main', $yolo_sidebar_position ); ?>" role="main" itemprop="mainEntity" itemscope="itemscope" itemtype="http://schema.org/Blog">
    <div class="careers-wrap">
         
        <div class="container">
            <div class="row">
                <?php get_sidebar(); ?>
                <div class="bt-content-area <?php yolo_get_content_class( 'content', $yolo_sidebar_position ); ?>">  
                    <div class="bt-col-inner">
                        <?php while ( have_posts() ) : the_post();
	                        ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class( "careers careers-details" ); ?> itemscope="itemscope" itemtype="http://schema.org/careersPosting" itemprop="careersPost">
                            <div class="entry-content">
                                <div class="careers-header">
                                    <h1 class="post-title"><?php the_title(); ?></h1> 
                                    <div class="careers-params">
										<div class="col-sm-4"> 
											<?php
											echo '<p>' . __( 'Posted', 'yolo' ) . ': ' . get_the_date( 'd/m/Y' ) . '</p>';
											$career_expired = fw_get_db_post_option( get_the_ID(), 'post_career_param' )['career_expired'];
											echo ( ! empty( $career_expired ) ) ? '<p>' . __( 'Expired Time', 'yolo' ) . ': ' . $career_expired . '</p>' : '<p>' . __( 'Expired Time', 'yolo' ) . ': ' . __( 'Unlimited', 'yolo' ) . '</p>';
											?>
										</div>
										<div class="col-sm-4">
											<?php
											$career_number = fw_get_db_post_option( get_the_ID(), 'post_career_param' )['career_number'];
											echo ( ! empty( $career_number ) ) ? '<p>' . __( 'Job Number', 'yolo' ) . ': ' . $career_number . '</p>' : '<p>' . __( 'Job Number', 'yolo' ) . ': ' . __( 'Various', 'yolo' ) . '</p>';
											$career_location = fw_get_db_post_option( get_the_ID(), 'post_career_param' )['career_location'];
											echo ( ! empty( $career_location ) ) ? '<p>' . __( 'Location', 'yolo' ) . ': ' . $career_location . '</p>' : '<p>' . __( 'Location', 'yolo' ) . ': ' . __( 'Contact', 'yolo' ) . '</p>';
											?> 
										</div> 
										<div class="col-sm-4">
											<?php
											$career_exp = fw_get_db_post_option( get_the_ID(), 'post_career_param' )['career_exp'];
											echo ( ! empty( $career_exp ) ) ? '<p>' . __( 'Years’ Experience', 'yolo' ) . ': ' . $career_exp . '</p>' : '<p>' . __( 'Years’ Experience', 'yolo' ) . ': ' . __( 'All', 'yolo' ) . '</p>';
											echo '<p class="post-cat" title="' . __( 'Post in category', 'yolo' ) . '">' . $term_list . '</p>';
											?> 
										</div>
                                    </div>
                                </div> 
                                <div class="career-entry">
                                    <?php
                                    the_content();
                                    wp_link_pages( array(
	                                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'yolo' ) . '</span>',
	                                    'after'       => '</div>',
	                                    'link_before' => '<span>',
	                                    'link_after'  => '</span>',
                                    ) ); ?>
                                </div>  
                            </div>
                            </article>
	                        <?php
	                        break;
                        endwhile; ?>
	                    <?php if ( $prevPost || $nextPost ) : ?>
                            <ul class="previous-next-link">
                                <?php if ( $prevPost ) { ?>
                                    <li class="previous">
                                    <?php $prevthumbnail = get_the_post_thumbnail( $prevPost->ID, array( 80, 80 ) ); ?>
                                    <?php previous_post_link( '%link', $prevthumbnail . '<div><div class="icon"><span class="ion-ios-arrow-thin-left"></span> ' . __( 'Previous', 'yolo' ) . '</div> <div class="title">%title</div></div>' ); ?>
                                </li>
                                <?php }
                                if ( $nextPost ) { ?>
                                    <li class="next">
                                    <?php $nextthumbnail = get_the_post_thumbnail( $nextPost->ID, array( 80, 80 ) ); ?>
                                    <?php next_post_link( '%link', $nextthumbnail . '<div><div class="icon">' . __( 'Next', 'yolo' ) . ' <span class="ion-ios-arrow-thin-right"></span></div> <div class="title">%title</div></div>' ); ?>
                                </li>
                                <?php } ?>
                            </ul>
	                    <?php endif; ?>
                    </div><!-- /.bt-col-inner -->
                </div><!-- /.bt-content-area -->
            </div><!-- /.row -->
        </div><!-- /.container -->

    </div><!-- /.careers-wrap -->
</section>
<?php
// free memory
unset( $ext_careers_instance );
unset( $ext_careers_settings );
set_query_var( 'fw_careers_loop_data', '' );
get_footer();
