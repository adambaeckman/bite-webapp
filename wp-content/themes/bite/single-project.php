<?php
/**
 * The template for displaying all single projects.
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */

get_header(); ?>

    <?php
    // Vars
    $projectID = get_the_ID();
    $projectLocation = get_field('project-location');
    $projectClient = get_field('project-client');
    $projectYear = get_field('project-year');
    $projectDescription = get_field('project-description');
    $projectGallery = get_field('project-gallery');
    $colClass = 'content-col-full-text';

    // Check if we have a gallery and if so how many images
    if ( $projectGallery ) {
        $totalImages = count($projectGallery);
        if ( $totalImages >= 1 ) {
            $colClass = 'content-col-left';
        }
    }

    // Get project category and only save the first one
    $projectCats = wp_get_post_terms($projectID, 'project-category', array("fields" => "names"));

    if ($projectCats) :
        // FIRST PROJECT CATEGORY NAME
        $categoryName = $projectCats[0];
    else :
        $categoryName = '';
    endif;
    ?>

    <div id="project-<?php echo $projectID; ?>" class="project-single-content page-content light-blue">

        <section class="project-single content-section page-section">

            <div class="content-section-inner main-content clear">
                <!-- PROJECT INFO -->
                <div class="project-info content-col <?php echo $colClass; ?> col-2">

                    <div class="project-info-inner content-col-inner">
                        <div class="content-col-vertical">
                            <?php if ( $projectLocation || $projectClient || $projectYear || $categoryName ) : ?>
                                <div class="project-details">
                                    <?php if ( $projectLocation ) : ?>
                                        <h5>
                                            Plats: <span class="thin"><?php echo $projectLocation; ?></span>
                                        </h5>
                                    <?php endif; ?>

                                    <?php if ( $projectClient ) : ?>
                                        <h5>
                                            Kund: <span class="thin"><?php echo $projectClient; ?></span>
                                        </h5>
                                    <?php endif; ?>

                                    <?php if ( $projectYear ) : ?>
                                        <h5>
                                            Utförandeår: <span class="thin"><?php echo $projectYear; ?></span>
                                        </h5>
                                    <?php endif; ?>

                                    <?php if ( $categoryName ) : ?>
                                        <h5>
                                            Kategori: <span class="thin"><?php echo $categoryName; ?></span>
                                        </h5>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $projectDescription ) : ?>
                                <div class="project-description wysiwyg-content">
                                    <?php echo $projectDescription; ?>
                                </div>
                            <?php endif; ?>
                        </div> <!-- .content-col-inner -->
                    </div> <!-- .project-info-inner -->

                </div> <!-- .project-info -->

                <!-- PROJECT GALLERY -->
                <?php if ( $projectGallery ) : ?>
                    <div class="content-col-right content-col-image col-2">
                        <div class="content-col-image-wrap gallery-wrap touch-hover">
                            <?php if ( $totalImages > 1 ) : ?>
                                <div id="gallery-nav-prev" class="gallery-nav" data-nav="prev">
                                </div>

                                <div id="gallery-nav-next" class="gallery-nav" data-nav="next">
                                </div>
                            <?php endif; ?>

                            <?php
                            $current = 'current';
                            ?>
                            <?php foreach ( $projectGallery as $i => $projectImage ) : ?>
                                <?php
                                $i++;
                                if ($i > 1 && $current != '' ) {
                                    $current = '';
                                }
                                $imgUrl = $projectImage['sizes']['desktop-medium'];
                                ?>
                                <div id="gallery-item-<?php echo $i; ?>" class="content-col-image-item gallery-item <?php echo $current; ?>" data-item="<?php echo $i; ?>" style="background-image: url('<?php echo $imgUrl; ?>')">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>  <!-- .content-section-inner -->

        </section> <!-- .content-section -->

    </div> <!-- page-content -->

<?php get_footer(); ?>
