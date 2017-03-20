<?php
/**
 * The template for displaying all single vacancies.
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */

get_header(); ?>

    <?php
    // Vars
    $jobSummery = get_field('vacancy-summery', false, false);
    $jobDescription = get_field('vacancy-description');
    $jobDetails = get_field('vacancy-details');
    $jobApplicant = get_field('vacancy-applicant');
    $parentID = '';
    $summaryImage = '';
    $contactFormObj = '';
    $contactFormID = '';
    $contactFormTitle = '';
    $contactImage = '';
    $textShadow = '';

    // Get the vacancy main page by fetching the page using that template.
    $args = [
        'post_type' => 'page',
        'fields' => 'ids',
        'nopaging' => true,
        'meta_key' => '_wp_page_template',
        'meta_value' => 'template-vacancies.php'
    ];
    $vacancyParent = get_posts( $args );
    if ( !empty($vacancyParent[0]) ) {
        $parentID = $vacancyParent[0];

        // Get summmary background from vacancy parent
        $summaryImage = get_field('vacancy-summary-image', $parentID)['sizes']['desktop-full'];

        if ($summaryImage) {
            $textShadow = 'text-on-image';
        }

        // Get contact form from vacancy parent
        $contactFormObj = get_field('vacancy-contact-form', $parentID);

        if ($contactFormObj) {
            $contactFormID = $contactFormObj->ID;
            $contactFormTitle = $contactFormObj->post_title;
        }

        // Get contact image from vacancy parent
        $contactImage = get_field('vacancy-contact-image', $parentID)['sizes']['desktop-medium'];
    }
    ?>

	<div id="single-vacancy-content" class="page-content section-full-row light-blue">

        <?php if ($jobSummery || $jobDescription || $jobDetails || $jobApplicant) : ?>

            <!-- **************************************************************
            *************************** JOB SUMMARY ***************************
            *************************************************************** -->
            <?php if ($jobSummery) : ?>

                <section id="job-summary" class="page-section clear">

                    <div class="content-section-inner clear">
                        <div class="content-col content-col-full col-1 dark-blue" style="background-image: url('<?php echo $summaryImage; ?>')">
                            <div class="content-col-inner">
                                <div class="content-col-vertical main-content">
                                    <div class="wysiwyg-content <?php echo $textShadow; ?> disable-select">
                                        <h3><?php echo $jobSummery; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>

            <?php endif; ?>

            <!-- **************************************************************
            ************************ JOB DESCRIPTION **************************
            *************************************************************** -->
            <?php if ($jobDescription) : ?>

                <section id="job-description" class="page-section clear">
                    <div class="content-section-inner clear">

                        <div class="content-col no-min-height content-col-full-text">
                            <div class="content-col-inner no-center">
                                <div class="content-col-vertical main-content">
                                    <div class="wysiwyg-content">
                                        <?php echo $jobDescription; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

            <?php endif; ?>

            <!-- **************************************************************
            **************** JOB DETAILS ******* JOB APPLICANT ****************
            *************************************************************** -->
            <?php if ($jobDetails || $jobApplicant) : ?>

                <section id="job-details-applicant" class="page-section clear">
                    <div class="content-section-inner main-content clear">

                        <!-- LEFT DETAILS -->
                        <div class="content-col no-min-height content-col-left col-2">
                            <div class="content-col-inner no-center">
                                <div class="content-col-vertical">
                                    <?php if ( $jobDetails ) : ?>
                                        <div class="content-block-title">
                                            <h4>Dina <span class="thin">arbetsuppgifter</span></h4>
                                        </div>

                                        <div class="wysiwyg-content">
                                            <?php echo $jobDetails; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT APPLICANT -->
                        <div class="content-col no-min-height content-col-right col-2">
                            <div class="content-col-inner no-center">
                                <div class="content-col-vertical">
                                    <?php if ( $jobApplicant ) : ?>
                                        <div class="content-block-title">
                                            <h4>Vi <span class="thin">söker dig som har</span></h4>
                                        </div>

                                        <div class="wysiwyg-content">
                                            <?php echo $jobApplicant; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div> <!-- .content-section-inner -->
                </section>

            <?php endif; ?>

            <!-- **************************************************************
            *********** APPLICATION IMAGE ******* APPLICATION FORM ************
            *************************************************************** -->
            <?php if ($contactFormID) : ?>

                <section id="job-details-applicant" class="page-section clear">
                    <div class="content-section-inner main-content clear">

                        <!-- LEFT IMAGE -->
                        <div class="content-col content-col-image content-col-left col-2">
                            <div class="content-col-image-wrap">
                                <div class="content-col-image-item" style="background-image: url('<?php echo $contactImage; ?>')">
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT CONTACT FORM -->
                        <div class="content-col content-col-right col-2">
                            <div class="content-col-inner">
                                <div class="content-col-vertical">
                                    <div class="content-block-title">
                                        <h4 class="split-weight"><?php echo $contactFormTitle; ?></h4>
                                    </div>

                                    <div class="custom-cf7">
                                        <?php
                                        // The form
                                        $contactFormShort = '[contact-form-7 id="'.$contactFormID.'" title="'.$contactFormTitle.'"]';
                                        echo do_shortcode( $contactFormShort );
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- .content-section-inner -->
                </section>

            <?php endif; ?>

        <?php else : ?>
            <section class="page-section no-page-content content-section">
    			<div class="content-section-inner main-content clear">
    				<div class="content-col col-1">
    			   		<div class="content-col-inner">
    			   			<div class="content-col-vertical">
                                <h4 class="thin">Det finns ingen information om jobbet just nu.</h4>
    			   			</div>
    			   		</div>
    			   	</div>
    			</div>
    		</section> <!-- page-section -->
        <?php endif; ?>
	</div> <!-- .page-content -->

<?php get_footer(); ?>
