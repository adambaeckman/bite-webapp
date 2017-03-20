<?php
/**
 * The template for displaying the work with us page
 *
 * Template name: Jobba hos oss
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */

get_header();
?>

    <div id="work-content" class="page-content light-blue">
        <!-- Check if we have any rows -->
        <?php if( have_rows('work-links') ): ?>
            <section id="work-with-us" class="page-section clear">
                <div class="content-section-inner clear">
                    <div class="content-col col-1">
                        <!-- Set a counter and count the rows -->
                        <?php
                        $i = 0;
                        $totalRows = count(get_field('work-links'));
                        ?>
                        <!-- Loop through the rows of data -->
                        <?php while ( have_rows('work-links') ) : the_row(); ?>
                            <?php
                            $i++;

                            // Vars
                            $linkTitle = get_sub_field('work-link-title');
                            $linkSubtitle = get_sub_field('work-link-subtitle');
                            $linkObj = get_sub_field('work-link-target');
                            $linkName = $linkObj->post_title;
                            $linkUrl = get_permalink($linkObj->ID);
                            $linkReadmoreText = get_sub_field('work-link-readmore');
                            $linkImage = '';
                            $currentVacancies = '';
                            $colID = '';
                            $colClass = '';
                            $hasImage = '';
                            $hasRings = false;

                            // If no custom title, use the linked page's title
                            if (!$linkTitle) {
                                $linkTitle = $linkName;
                            }

                            // If no custom read more text, set it to a standard Read more
                            if (!$linkReadmoreText) {
                                $linkReadmoreText = 'Läs mer';
                            }

                            // Set col IDs and Classes
                            switch ($i) {
                                case 1:
                                    $colClass = '4';
                                    $colID = 'first';
                                    break;
                                case 2:
                                    $colClass = '4';
                                    break;
                                case 3:
                                    $colClass = '2';
                                    $colID = 'second';
                                    $hasRings = true;
                                    break;
                                case 4:
                                    $colClass = '4';
                                    $colID = 'third';
                                    break;
                                case 5:
                                    $colClass = '4';
                                    break;
                                default:
                                    $colClass = '';
                                    $colID = '';
                            }

                            // LAYOUT SPECIFIC VARS
                            if (get_row_layout() == 'work-link-normal') {
                                // NORMAL LAYOUT
                                $linkImage = get_sub_field('work-link-image')['sizes']['large'];

                            } elseif (get_row_layout() == 'work-link-vacancies') {
                                // VACANCIES LAYOUT
                                $linkImage = get_sub_field('work-link-image')['sizes']['desktop-medium'];

                                // Count vacancies
                                $currentVacancies = wp_count_posts( 'vacancy' )->publish;

                                // Get
                                $textVacancies = $linkSubtitle;
                                if (!$textVacancies) {
                                    $textVacancies = 'Tjänster just nu';
                                }
                            }

                            // If no image, set the no image class
                            if (!$linkImage) {
                                $hasImage = 'no-image';
                            }
                            ?>

                            <?php if ($i == 1 || $i == 3 || $i == 4) : ?>
                            <div id="work-col-<?php echo $colID; ?>" class="work-col col-<?php echo $colClass; ?>">
                            <?php endif; ?>

                                <div class="work-linkbox touch-hover <?php echo $hasImage; ?>" style="background-image: url('<?php echo $linkImage; ?>');">

                                    <?php if ($hasRings) : ?>
                                        <div class="work-rings">
                                            <div class="rings-inner">
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="work-linkbox-content">

                                        <div class="work-linkbox-content-inner">
                                            <a href="<?php echo $linkUrl; ?>">
                                                <div class="work-linkbox-title">
                                                    <?php if ($i == 3) : ?>
                                                        <h3 class="split-weight"><?php echo $linkTitle; ?></h3>
                                                    <?php else : ?>
                                                        <h4 class="split-weight"><?php echo $linkTitle; ?></h4>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="work-linkbox-text">

                                                    <?php if (get_row_layout() == 'work-link-normal') : ?>
                                                        <!-- NORMAL -->
                                                        <?php if ($linkSubtitle) : ?>
                                                            <?php if ($i == 3) : ?>
                                                                <h4 class="thin work-subtitle"><?php echo $linkSubtitle; ?></h4>
                                                            <?php else : ?>
                                                                <h5 class="thin work-subtitle"><?php echo $linkSubtitle; ?></h5>
                                                            <?php endif; ?>
                                                        <?php endif; ?>

                                                    <?php elseif (get_row_layout() == 'work-link-vacancies') : ?>
                                                        <!-- VACANCIES -->
                                                        <?php if ($currentVacancies || $currentVacancies === 0) : ?>

                                                            <?php if ($i == 3) : ?>
                                                                <h4 class="thin work-subtitle"><?php echo $textVacancies.': '.$currentVacancies; ?></h4>
                                                            <?php else : ?>
                                                                <h5 class="thin work-subtitle"><?php echo $textVacancies.': '.$currentVacancies; ?></h5>
                                                            <?php endif; ?>

                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <?php if ($i == 3) : ?>
                                                        <h4 class="link-hover"><?php echo $linkReadmoreText; ?></h4>
                                                    <?php else : ?>
                                                        <h5 class="link-hover"><?php echo $linkReadmoreText; ?></h5>
                                                    <?php endif; ?>

                                                </div> <!-- .work-linkbox-text -->
                                            </a>
                                        </div> <!-- .work-linkbox-content-inner -->

                                    </div> <!-- .work-linkbox-content -->

                                </div> <!-- .work-linkbox -->

                            <?php if ($i == 2 || $i == 3 || $i == 5 || $totalRows == $i) : ?>
                            </div> <!-- .work-col -->
                            <?php endif; ?>

                        <?php endwhile; // have_rows('page-flexible-content') ?>
                    </div> <!-- .content-col -->
                </div> <!-- .content-section-inner -->
            </section> <!-- .page-section -->
        <?php else : ?>
            <section class="page-section no-page-content content-section">
                <div class="content-section-inner main-content clear">
                    <div class="content-col col-1">
                        <div class="content-col-inner">
                            <div class="content-col-vertical">
                                <h4 class="thin">Denna sida är tyvärr tom för tillfället.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; // have_rows('page-flexible-content') ?>
    </div> <!-- .page-content -->


<?php get_footer(); ?>
