<?php
/**
 * The template for displaying the contact page
 *
 * Template name: Kontakt
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */

get_header();
?>

    <div id="contact-content" class="page-content">

        <!-- **************************************************************
        ************************** CONTACT US *****************************
        *************************************************************** -->

        <section id="contact-us" class="page-section content-section light-blue">

            <div class="content-section-inner main-content clear">

                <div class="contact-info content-col content-col-left col-2">
                    <div class="content-col-inner">
                        <div class="content-col-vertical">
                            <?php
                            // Get contact details from custom post type
                            $args = array(
                                'posts_per_page'   => 1,
                                'orderby'     => 'menu_order',
                                'order'       => 'ASC',
                                'post_type'   => 'contact-details',
                                'post_status'      => 'publish',
                            );

                            $contactInfo = get_posts( $args );
                            ?>

                            <?php if ( !empty($contactInfo[0]) ) : ?>

                                <?php
                                $contactID = $contactInfo[0]->ID;

                                $contactAddressBilling = get_field('contact-info-billing-address', $contactID);
                                $contactPhone = get_field('contact-info-phone', $contactID);
                                $contactEmail = get_field('contact-info-email', $contactID);
                                ?>

                                <?php if ( !empty($contactPhone) ) : ?>
                                    <div class="contact-info-item">
                                        <h4>Ring oss</h4>
                                        <h5 class="thin">
                                            <?php echo $contactPhone; ?>
                                        </h5>
                                    </div>
                                <?php endif; ?>

                                <?php if ( !empty($contactEmail) ) : ?>
                                    <div class="contact-info-item">
                                        <h4>E-posta oss</h4>
                                        <h5 class="thin">
                                            <a class="link-hover" href="mailto:<?php echo $contactEmail; ?>"><?php echo $contactEmail; ?></a>
                                        </h5>
                                    </div>
                                <?php endif; ?>

                                <?php if ( !empty($contactAddressBilling) ) : ?>
                                    <div class="contact-info-item">
                                        <h4>Fakturera oss</h4>
                                        <h5 class="thin">
                                            <?php echo $contactAddressBilling; ?>
                                        </h5>
                                    </div>
                                <?php endif; ?>

                            <?php endif; ?>
                        </div> <!-- .content-col-vertical -->
                    </div> <!-- .content-col-inner -->
                </div> <!-- .content-col -->

                <div class="contact-form content-col content-col-right col-2">
                    <div class="content-col-inner">
                        <div class="content-col-vertical">
                            <?php
                            // Get contact form
                            $contactFormObj = get_field('contact-form');
                            ?>

                            <?php if ( $contactFormObj ) : ?>
                                <div class="contact-form-title">
                                    <h4 class="split-weight"><?php echo $contactFormObj->post_title; ?></h4>
                                </div>

                                <div class="custom-cf7">
                                    <?php
                                    // The form
                                    $contactFormShort = '[contact-form-7 id="'.$contactFormObj->ID.'" title="'.$contactFormObj->post_title.'"]';
                                    echo do_shortcode( $contactFormShort );
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div> <!-- .content-col-vertical -->
                    </div> <!-- .content-col-inner -->
                </div> <!-- .content-col -->

            </div> <!-- .content-section-inner -->

            <div class="section-scroll shift-right">
            </div>

        </section> <!-- .contact-us -->

        <!-- **************************************************************
        ************************ BOARD MEMBERS ****************************
        *************************************************************** -->

        <?php
        // Get all board members
        $args = array(
            'posts_per_page'   => -1,
            'orderby'     => 'menu_order',
            'order'       => 'ASC',
            'post_type'   => 'board-member',
            'post_status' => 'publish',
        );

        $boardMembers = get_posts( $args );
        ?>

        <?php if (!empty($boardMembers) ) : ?>
            <section id="contact-board" class="page-section light-blue">

                <div class="section-header dark-blue">
                    <div class="section-title disable-select main-content">
                        <h3>Vår <span class="thin">ledningsgrupp</span></h3>
                    </div>
                </div>

                <div class="section-content">
                    <div class="all-board-members square-list clear">
                        <?php foreach ($boardMembers as $i => $boardMember) : ?>
                            <?php
                            $memberID = $boardMember->ID;
                            $memberName = $boardMember->post_title;
                            $memberTitle = get_field('board-title', $memberID);
                            $memberPhone = get_field('board-phone', $memberID);
                            $memberEmail = get_field('board-email', $memberID);
                            $memberImage = get_field('board-image', $memberID)['sizes']['medium_large'];

                            if ( $memberImage ) :
                                $noImage = '';
                            else:
                                $noImage = 'no-image';
                            endif;
                            ?>

                            <div class="board-member touch-hover square-list-item">
                                <div class="board-member-image <?php echo $noImage; ?>" style="background-image: url('<?php echo $memberImage; ?>')">
                                </div>
                                <div class="board-member-inner">
                                    <div class="board-member-overlay">
                                    </div>

                                    <div class="board-member-content">
                                        <div class="member-details">
                                            <?php if ($memberName) : ?>
                                                <div class="board-member-name">
                                                    <h4><?php echo $memberName; ?></h4>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($memberTitle) : ?>
                                                <div class="board-member-title">
                                                    <h4 class="thin"><?php echo $memberTitle; ?></h4>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ($memberPhone || $memberEmail) : ?>
                                            <div class="member-contact">
                                                <?php if ($memberPhone) : ?>
                                                    <div class="board-member-phone">
                                                        <h5 class="thin"><?php echo $memberPhone; ?></h5>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($memberEmail) : ?>
                                                    <div class="board-member-email">
                                                        <h5 class="thin">
                                                            <a class="link-hover" href="mailto:<?php echo $memberEmail; ?>"><?php echo $memberEmail; ?></a>
                                                        </h5>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div> <!-- .board-member-content -->

                                </div> <!-- .board-member-overlay -->
                            </div> <!-- .board-member -->
                        <?php endforeach; ?>
                    </div> <!-- .all-board-members -->
                </div> <!-- .section-content -->

            </section> <!-- #contact-board -->
        <?php endif; ?>

        <!-- **************************************************************
        **************************** OFFICES ******************************
        *************************************************************** -->

        <?php
        // Get all offices
        $args = array(
            'posts_per_page'   => -1,
            'orderby'     => 'menu_order',
            'order'       => 'ASC',
            'post_type'   => 'office',
            'post_status' => 'publish',
        );

        $offices = get_posts( $args );
        ?>

        <?php if ( !empty($offices) ) : ?>
            <section id="contact-offices" class="page-section dark-blue">

                <div class="section-header dark-blue">
                    <div class="section-title disable-select main-content">
                        <h3>Våra <span class="thin">kontor</span></h3>
                    </div>
                </div>

                <div class="section-content">
                    <div class="all-offices square-list clear">
                        <?php
                        // Declare our map markers array
                        $markersArray = array();
                        $i = 0;
                        ?>
                        <?php foreach ( $offices as $office ) : ?>

                            <?php
                            $officeTargetID = 'no-map';
                            $officeName = $office->post_title;
                            $officeAddress = get_field('office-address', $office->ID);
                            $officeZip = get_field('office-zip', $office->ID);
                            $officeArea = get_field('office-area', $office->ID);
                            $location = get_field('office-map', $office->ID);
                            $mapClass = '';

                            if ( !empty($location) ) {
                                // If we have a map, declare our standard map marker object..
                                $markerObj = new stdClass();

                                $markerObj->title = $officeName;
                                $markerObj->lat = $location['lat'];
                                $markerObj->lng = $location['lng'];
                                $markerObj->address = $location['address'];

                                // ..and add it to the array
                                $markersArray[$i] = $markerObj;

                                // Only increasing and saving incase map exists to match marker number
                                $officeTargetID = $i;
                                $i++;

                                // Set hover class incase map exists
                                $mapClass = 'has-map';
                            }

                            ?>

                            <div class="office-item square-list-item <?php echo $mapClass; ?>" data-target="<?php echo $officeTargetID; ?>">
                                <div class="office-item-inner">
                                    <div class="office-title">
                                        <h4>
                                            <?php echo $officeName; ?>
                                        </h4>
                                    </div>

                                    <div class="office-address">
                                        <h5 class="thin">
                                            <?php echo $officeAddress; ?><br />
                                            <?php echo $officeZip.' '.$officeArea; ?>
                                        </h5>
                                    </div>

                                    <div class="office-marker">
                                        <?php if ( !empty($location) ) : ?>
                                            <div id="office-marker-current" class="office-marker-img">
                                            </div>
                                            <div id="office-marker-default" class="office-marker-img">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div> <!-- .office-item -->

                        <?php endforeach; ?>
                    </div>

                    <div class="map-offices">
                        <?php if ( !empty($markersArray ) ) : ?>
                            <div id="office-map" class="acf-map">
                                <?php foreach ( $markersArray as $marker ) : ?>

                                    <div class="marker" data-lat="<?php echo $marker->lat; ?>" data-lng="<?php echo $marker->lng; ?>">
                                        <div class="info-window-content">
                                            <div class="info-window-logo">
                                            </div>
                                            <h5><?php echo $marker->title; ?></h5>
                                            <h6 class="address"><?php echo $marker->address; ?></h6>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

            </section> <!-- #contact-offices -->
        <?php endif; ?>

    </div> <!-- .page-content -->

<?php get_footer(); ?>
