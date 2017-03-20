<?php
/**
 * The template for displaying the current vacancies in a jQuery Datatable
 *
 * Template name: Lediga jobb
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */

get_header();
?>

    <div id="projects-content" class="page-content light-blue">

        <?php
        // Get all vacancies
        $args = array(
            'posts_per_page'   => -1,
            'orderby'     => 'title',
            'order'       => 'ASC',
            'post_type'   => 'vacancy',
            'post_status' => 'publish'
        );

        $vacancies = get_posts( $args );

        //var_dump($vacancies);
        ?>

        <?php if (!empty($vacancies)) : ?>

            <?php
            // Vars
            $jobID = '';
            $jobTitle = '';
            $jobLocation = '';
            $jobType = '';
            $jobLink = '';
            ?>

            <section id="all-vacancies" class="page-section clear">
                <div class="custom-datatable">
                    <table id="vacancies-table" class="display" width="100%" cellspacing="0">
                        <thead class="disable-select">
                            <tr>
                                <th class="filler-left filler"></th>
                                <th>Tjänst</th>
                                <th>Plats</th>
                                <th class="last">Typ</th>
                                <th class="filler-right filler"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($vacancies as $vacancy) : ?>

                                <?php
                                $jobID = $vacancy->ID;
                                $jobTitle = $vacancy->post_title;
                                $jobLink = get_permalink($jobID);

                                // Get job location from taxonomy
                                $jobLocation = wp_get_post_terms($jobID, 'job-location', array("fields" => "names"));

                                if ($jobLocation) :
                                    // Only use the first one
                                    $jobLocation = $jobLocation[0];
                                else :
                                    $jobLocation = 'Ospecificerad';
                                endif;

                                // Get job type from taxonomy
                                $jobType = wp_get_post_terms($jobID, 'job-type', array("fields" => "names"));

                                if ($jobType) :
                                    // Only use the first one
                                    $jobType = $jobType[0];
                                else :
                                    $jobType = 'Ospecificerad';
                                endif;
                                ?>
                                <tr class="has-link" data-href="<?php echo $jobLink; ?>">
                                    <td class="filler-left filler"></td>
                                    <td><?php echo $jobTitle; ?></td>
                                    <td><?php echo $jobLocation; ?></td>
                                    <td><?php echo $jobType; ?></td>
                                    <td class="filler-right filler"></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div> <!-- .custom-datatable -->
            </section>

        <?php else : ?>

            <section class="page-section no-page-content content-section">
                <div class="content-section-inner main-content clear">
                    <div class="content-col col-1">
                        <div class="content-col-inner">
                            <div class="content-col-vertical">
                                <h4 class="thin">Det finns inga lediga jobb just nu tyvärr, men kom gärna tillbaka senare.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>

    </div> <!-- .page-content -->

<?php get_footer(); ?>
