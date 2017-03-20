<?php
/**
 * The template for displaying the project references
 *
 * Template name: Referensobjekt
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */

get_header();
?>

    <div id="projects-content" class="page-content square-list light-blue">

        <section id="all-projects" class="page-section clear">

            <?php
            // Get all projects
            $args = array(
                'posts_per_page'   => -1,
                'orderby'     => 'menu_order',
                'order'       => 'ASC',
                'post_type'   => 'project',
                'post_status' => 'publish'
            );

            $projects = get_posts( $args );
            ?>

            <?php foreach ( $projects as $project ) : ?>
                <?php
                // VARS
                $projectID = $project->ID;
                $projectName = $project->post_title;
                $projectUrl = get_the_permalink($projectID);

                // GET PROJECT CATEGORIES
                $categorySlugs = '"all"';
                $categoryName = '';
                $projectCats = wp_get_post_terms($projectID, 'project-category', array("fields" => "all"));

                if ($projectCats) :
                    foreach ($projectCats as $projectCat) :
                        $categorySlugs .= ', "'.$projectCat->slug.'"';
                    endforeach;

                    // FIRST PROJECT CATEGORY NAME
                    $categoryName = $projectCats[0]->name;
                endif;

                // GET IMAGE
                $projectImage = get_field('project-featured-image', $projectID)['sizes']['large'];

                if ( $projectImage ) :
                    $noImage = '';
                else:
                    $noImage = 'no-image';
                endif;
                ?>

                <div class="project-item touch-hover square-list-item" data-groups='[<?php echo $categorySlugs; ?>]'>
                    <div class="project-item-inner <?php echo $noImage; ?>" style="background-image: url('<?php echo $projectImage; ?>');">
                        <div class="project-item-content">
                            <div class="project-item-content-inner">
                                <a href="<?php echo $projectUrl; ?>">
                                    <div class="project-item-title">
                                        <h4><?php echo $projectName; ?></h4>
                                    </div>
                                    <div class="project-item-text">
                                        <?php if ($categoryName) : ?>
                                            <h5 class="thin project-category"><?php echo $categoryName; ?></h5>
                                        <?php endif; ?>
                                        <h5 class="link-hover">Läs mer</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </section>

    </div> <!-- .page-content -->

<?php get_footer(); ?>
