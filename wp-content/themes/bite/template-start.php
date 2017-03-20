<?php
/**
 * The template for displaying the Start page
 *
 * Template name: Start
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */

get_header();
?>

    <div id="start-content" class="page-content clear">

        <!-- **************************************************************
        *********************** START REFERENCES **************************
        *************************************************************** -->

        <section id="start-references" class="start-section page-section full-section light-blue">

            <div class="section-header dark-blue">
                <div class="section-title disable-select main-content">
                    <h3>Senaste <span class="thin">referensobjekt</span></h3>
                </div>
            </div>

            <div class="section-content clear">

                <?php
                // Get the top 4 references
                $args = array(
                    'posts_per_page'   => 4,
                    'orderby'     => 'menu_order',
                    'order'       => 'ASC',
                    'post_type'   => 'project',
                    'post_status' => 'publish'
                );

                $projects = get_posts( $args );

                foreach ( $projects as $project ) :

                    // VARS
                    $projectID = $project->ID;
                    $projectName = $project->post_title;
                    $projectUrl = get_the_permalink($projectID);

                    // GET PROJECT FIRST CATEGORY
                    $projectCats = wp_get_post_terms($projectID, 'project-category', array("fields" => "names"));
                    $projectCat = '';

                    if ($projectCats) :

                        // FIRST PROJECT CATEGORY
                        $projectCat = $projectCats[0];

                    endif;

                    // GET IMAGE
                    $projectImage = get_field('project-featured-image', $projectID)['sizes']['medium_large'];

                    if ( $projectImage ) :
                        $noImage = '';
                    else:
                        $noImage = 'no-image';
                    endif;
                    ?>

                    <div class="start-ref-item col-4">
                        <div class="start-ref-img start-ref-part <?php echo $noImage; ?>" style="background-image: url('<?php echo esc_url( $projectImage ); ?>')">
                        </div>

                        <div class="start-ref-txt start-ref-part touch-hover">
                            <div class="start-ref-arrow">
                            </div>
                            <div class="start-ref-txt-inner">
                                <a href="<?php echo $projectUrl; ?>">
                                    <h4><?php echo $projectName; ?></h4>
                                    <h4 class="thin"><?php echo $projectCat; ?></h4>

                                    <div class="start-ref-link">
                                        <h5 class="link-hover">Läs mer</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php
                endforeach;

                ?>
            </div><!-- .section-content -->

            <div class="section-scroll shift-left">
            </div>

        </section> <!-- #start-references -->

        <!-- **************************************************************
        ************************* START PUFFS *****************************
        *************************************************************** -->

        <section id="start-puffs" class="page-section full-section clear">

            <?php if( have_rows('start-puffs') ): ?>
                <?php $i = 0; ?>
                <?php while( have_rows('start-puffs') ): the_row();
                    $i++;
                    // vars
                    $startPuffTitle = get_sub_field('start-puff-title');
                    $startPuffSubtitle = get_sub_field('start-puff-subtitle');
                    $startPuffLink = get_permalink( get_sub_field('start-puff-link') );
                    $startPuffImage = get_sub_field('start-puff-image')['sizes']['desktop-full'];
                    ?>

                    <div id="start-puff-item-<?php echo $i; ?>" class="start-puff-item col-2 touch-hover">
                        <div class="start-puff-txt text-on-image">
                            <a href="<?php echo esc_url( $startPuffLink ); ?>">
                                <h2><?php echo $startPuffTitle; ?></h2>
                                <h2 class="thin link-hover"><?php echo $startPuffSubtitle; ?></h2>
                            </a>
                        </div>
                        <div class="start-puff-bg" style="background-image: url('<?php echo esc_url( $startPuffImage ); ?>')">
                        </div>
                    </div>

                <?php endwhile; ?>

            <?php endif; ?>

        </section>

    </div> <!-- .page-content -->

<?php get_footer(); ?>
