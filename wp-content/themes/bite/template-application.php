<?php
/**
 * The template for displaying the application page
 *
 * Template name: Skicka ansökan
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */

get_header();
?>

    <?php
    // Vars
    $applicationTitle = get_field('send-application-title');
    $applicationText = get_field('send-application-text');
    $applicationFormObj = get_field('send-application-form');

    if ($applicationFormObj) {
        $applicationFormID = $applicationFormObj->ID;
        $applicationFormTitle = $applicationFormObj->post_title;
    }
    ?>

    <div id="application-content" class="page-content light-blue">

        <?php if ($applicationTitle || $applicationText || $applicationFormObj) : ?>

            <section id="send-application" class="page-section clear">

                <div class="content-section-inner main-content clear">

                    <!-- LEFT TEXT -->
                    <div class="content-col no-min-height content-col-left col-2">
                        <div class="content-col-inner no-center">
                            <div class="content-col-vertical">
                                <?php if ($applicationTitle) : ?>
                                    <div class="content-block-title">
                                        <h4 class="split-weight"><?php echo $applicationTitle; ?></h4>
                                    </div>
                                <?php endif; ?>
                                <div class="wysiwyg-content">
                                    <?php echo $applicationText; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT CONTACT -->
                    <div class="content-col no-min-height content-col-right col-2">
                        <div class="content-col-inner no-center">
                            <div class="content-col-vertical">
                                <?php if ( $applicationFormObj ) : ?>
                                    <div class="content-block-title">
                                        <h4 class="split-weight"><?php echo $applicationFormTitle; ?></h4>
                                    </div>

                                    <div class="custom-cf7">
                                        <?php
                                        // The form
                                        $contactFormShort = '[contact-form-7 id="'.$applicationFormID.'" title="'.$applicationFormTitle.'"]';
                                        echo do_shortcode( $contactFormShort );
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div> <!-- .content-section-inner -->

            </section> <!-- .page-section -->

        <?php else : ?>

            <section class="page-section no-page-content content-section">
                <div class="content-section-inner main-content clear">
                    <div class="content-col col-1">
                        <div class="content-col-inner">
                            <div class="content-col-vertical">
                                <h4 class="thin">Vi tar inte emot ansökningar just nu.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!-- page-section -->

        <?php endif; ?>

    </div> <!-- .page-content -->

<?php get_footer(); ?>
