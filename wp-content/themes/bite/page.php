<?php
/**
 * The template for displaying the default template.
 *
 * This is the template that displays all pages by default.
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */

get_header(); ?>

    <div id="standard-content" class="page-content light-blue">

        <!-- Check if we have any rows -->
        <?php if( have_rows('page-flexible-content') ): ?>

            <!-- Set a counter and count the rows -->
            <?php
            $i = 0;
            $totalRows = count(get_field('page-flexible-content'));
            ?>
            <!-- Loop through the rows of data -->
            <?php while ( have_rows('page-flexible-content') ) : the_row(); ?>
                <?php
                $i++;

                // Vars
                $sectionType = '';
                $sectionTitle = '';
                $leftTitle = '';
                $leftText = '';
                $leftImage = '';
                $rightTitle = '';
                $rightText = '';
                $rightImage = '';
                $rightContact = '';
                $fullTextTitle = '';
                $fullTextContent = '';
                $fullBackground = '';
                $fullText = '';
                $fullImage = '';
                $textShadow = '';
                ?>

                <?php if( get_row_layout() == 'page-row-header' ): ?>
                <!-- **************************************************************
                ************************* SECTION HEADER **************************
                *************************************************************** -->

                    <?php
                    // Vars
                    $sectionType = 'section-row-header';
                    $sectionTitle = get_sub_field('page-row-header-title');
                    ?>

                    <section id="page-section-<?php echo $i; ?>" class="page-section <?php echo $sectionType; ?> dark-blue">
                        <div class="section-header dark-blue">
                            <div class="section-title disable-select main-content">
                                <h3 class="split-weight"><?php echo $sectionTitle; ?></h3>
                            </div>
                        </div>
                    </section>

                <?php elseif( get_row_layout() == 'page-row-text-image' ): ?>
                <!-- **************************************************************
                ***************** TEXT LEFT ******** IMAGE RIGHT ******************
                *************************************************************** -->

                    <?php
                    // Vars
                    $sectionType = 'section-text-image';
                    $leftTitle = get_sub_field('page-row-left-title');
                    $leftText = get_sub_field('page-row-left-text');
                    $rightImage = get_sub_field('page-row-right-image')['sizes']['desktop-medium'];
                    ?>

                    <section id="page-section-<?php echo $i; ?>" class="page-section <?php echo $sectionType; ?> clear">
                        <div class="content-section-inner main-content clear">

                            <!-- LEFT TEXT -->
                            <div class="content-col content-col-left col-2">
                                <div class="content-col-inner">
                                    <div class="content-col-vertical">
                                        <?php if ($leftTitle) : ?>
                                            <div class="content-block-title">
                                                <h4 class="split-weight"><?php echo $leftTitle; ?></h4>
                                            </div>
                                        <?php endif; ?>
                                        <div class="wysiwyg-content">
                                            <?php echo $leftText; ?>

                                            <!-- Check for left block PDF uploads -->
                                            <?php if( have_rows('page-row-left-files') ): ?>
                                                <ul class="file-list">
                                                <?php while ( have_rows('page-row-left-files') ) : the_row(); ?>
                                                    <li class="file-list-item">
                                                        <a target="_blank" href="<?php the_sub_field('page-row-file-link'); ?>"><?php the_sub_field('page-row-file-name'); ?></a>
                                                    </li>
                                                <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- RIGHT IMAGE -->
                            <div class="content-col content-col-image content-col-right col-2">
                                <div class="content-col-image-wrap">
                                    <div class="content-col-image-item" style="background-image: url('<?php echo $rightImage; ?>')">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <?php if ($i === 1 && $totalRows > 1) : ?>
                            <!-- Section scroll for the first section if we have more rows -->
                            <div class="section-scroll shift-right">
                            </div>
                        <?php endif; ?>
                    </section>

                <?php elseif( get_row_layout() == 'page-row-image-text' ): ?>
                <!-- **************************************************************
                ***************** IMAGE LEFT ******** TEXT RIGHT ******************
                *************************************************************** -->

                    <?php
                    // Vars
                    $sectionType = 'section-image-text';
                    $leftImage = get_sub_field('page-row-left-image')['sizes']['desktop-medium'];
                    $rightTitle = get_sub_field('page-row-right-title');
                    $rightText = get_sub_field('page-row-right-text');
                    ?>

                    <section id="page-section-<?php echo $i; ?>" class="page-section <?php echo $sectionType; ?> clear">
                        <div class="content-section-inner main-content clear">

                            <!-- LEFT IMAGE -->
                            <div class="content-col content-col-image content-col-left col-2">
                                <div class="content-col-image-wrap">
                                    <div class="content-col-image-item" style="background-image: url('<?php echo $leftImage; ?>')">
                                    </div>
                                </div>
                            </div>

                            <!-- RIGHT TEXT -->
                            <div class="content-col content-col-right col-2">
                                <div class="content-col-inner">
                                    <div class="content-col-vertical">
                                        <?php if ($rightTitle) : ?>
                                            <div class="content-block-title">
                                                <h4 class="split-weight"><?php echo $rightTitle; ?></h4>
                                            </div>
                                        <?php endif; ?>
                                        <div class="wysiwyg-content">
                                            <?php echo $rightText; ?>

                                            <!-- Check for right block PDF uploads -->
                                            <?php if( have_rows('page-row-right-files') ): ?>
                                                <ul class="file-list">
                                                <?php while ( have_rows('page-row-right-files') ) : the_row(); ?>
                                                    <li class="file-list-item">
                                                        <a target="_blank" href="<?php the_sub_field('page-row-file-link'); ?>"><?php the_sub_field('page-row-file-name'); ?></a>
                                                    </li>
                                                <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- .content-section-inner -->

                        <?php if ($i === 1 && $totalRows > 1) : ?>
                            <!-- Section scroll for the first section if we have more rows -->
                            <div class="section-scroll shift-right">
                            </div>
                        <?php endif; ?>
                    </section>

                <?php elseif( get_row_layout() == 'page-row-text-text' ): ?>
                <!-- **************************************************************
                ****************** TEXT LEFT ******** TEXT RIGHT ******************
                *************************************************************** -->

                    <?php
                    // Vars
                    $sectionType = 'section-text-text';
                    $leftTitle = get_sub_field('page-row-left-title');
                    $leftText = get_sub_field('page-row-left-text');
                    $rightTitle = get_sub_field('page-row-right-title');
                    $rightText = get_sub_field('page-row-right-text');
                    ?>

                    <section id="page-section-<?php echo $i; ?>" class="page-section <?php echo $sectionType; ?> clear">
                        <div class="content-section-inner main-content clear">

                            <!-- LEFT TEXT -->
                            <div class="content-col no-min-height content-col-left col-2">
                                <div class="content-col-inner no-center">
                                    <div class="content-col-vertical">
                                        <?php if ($leftTitle) : ?>
                                            <div class="content-block-title">
                                                <h4 class="split-weight"><?php echo $leftTitle; ?></h4>
                                            </div>
                                        <?php endif; ?>
                                        <div class="wysiwyg-content">
                                            <?php echo $leftText; ?>

                                            <!-- Check for left block PDF uploads -->
                                            <?php if( have_rows('page-row-left-files') ): ?>
                                                <ul class="file-list">
                                                <?php while ( have_rows('page-row-left-files') ) : the_row(); ?>
                                                    <li class="file-list-item">
                                                        <a target="_blank" href="<?php the_sub_field('page-row-file-link'); ?>"><?php the_sub_field('page-row-file-name'); ?></a>
                                                    </li>
                                                <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- RIGHT TEXT -->
                            <div class="content-col no-min-height content-col-right col-2">
                                <div class="content-col-inner no-center">
                                    <div class="content-col-vertical">
                                        <?php if ($rightTitle) : ?>
                                            <div class="content-block-title">
                                                <h4 class="split-weight"><?php echo $rightTitle; ?></h4>
                                            </div>
                                        <?php endif; ?>
                                        <div class="wysiwyg-content">
                                            <?php echo $rightText; ?>

                                            <!-- Check for right block PDF uploads -->
                                            <?php if( have_rows('page-row-right-files') ): ?>
                                                <ul class="file-list">
                                                <?php while ( have_rows('page-row-right-files') ) : the_row(); ?>
                                                    <li class="file-list-item">
                                                        <a target="_blank" href="<?php the_sub_field('page-row-file-link'); ?>"><?php the_sub_field('page-row-file-name'); ?></a>
                                                    </li>
                                                <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- .content-section-inner -->

                        <?php if ($i === 1 && $totalRows > 1) : ?>
                            <!-- Section scroll for the first section if we have more rows -->
                            <div class="section-scroll shift-right">
                            </div>
                        <?php endif; ?>
                    </section>

                <?php elseif( get_row_layout() == 'page-row-text-contact' ): ?>
                <!-- **************************************************************
                **************** TEXT LEFT ******** CONTACT RIGHT *****************
                *************************************************************** -->

                    <?php
                    // Vars
                    $sectionType = 'section-text-contact';
                    $leftTitle = get_sub_field('page-row-left-title');
                    $leftText = get_sub_field('page-row-left-text');
                    $rightContact = get_sub_field('page-row-right-contact');
                    ?>

                    <section id="page-section-<?php echo $i; ?>" class="page-section <?php echo $sectionType; ?> clear">
                        <div class="content-section-inner main-content clear">

                            <!-- LEFT TEXT -->
                            <div class="content-col no-min-height content-col-left col-2">
                                <div class="content-col-inner no-center">
                                    <div class="content-col-vertical">
                                        <?php if ($leftTitle) : ?>
                                            <div class="content-block-title">
                                                <h4 class="split-weight"><?php echo $leftTitle; ?></h4>
                                            </div>
                                        <?php endif; ?>
                                        <div class="wysiwyg-content">
                                            <?php echo $leftText; ?>

                                            <!-- Check for left block PDF uploads -->
                                            <?php if( have_rows('page-row-left-files') ): ?>
                                                <ul class="file-list">
                                                <?php while ( have_rows('page-row-left-files') ) : the_row(); ?>
                                                    <li class="file-list-item">
                                                        <a target="_blank" href="<?php the_sub_field('page-row-file-link'); ?>"><?php the_sub_field('page-row-file-name'); ?></a>
                                                    </li>
                                                <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- RIGHT CONTACT -->
                            <div class="content-col no-min-height content-col-right col-2">
                                <div class="content-col-inner no-center">
                                    <div class="content-col-vertical">
                                        <?php if ( $rightContact ) : ?>
                                            <div class="content-block-title">
                                                <h4 class="split-weight"><?php echo $rightContact->post_title; ?></h4>
                                            </div>

                                            <div class="custom-cf7">
                                                <?php
                                                // The form
                                                $contactFormShort = '[contact-form-7 id="'.$rightContact->ID.'" title="'.$rightContact->post_title.'"]';
                                                echo do_shortcode( $contactFormShort );
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- .content-section-inner -->

                        <?php if ($i === 1 && $totalRows > 1) : ?>
                            <!-- Section scroll for the first section if we have more rows -->
                            <div class="section-scroll shift-right">
                            </div>
                        <?php endif; ?>
                    </section>

                <?php elseif( get_row_layout() == 'page-row-full-text' ): ?>
                <!-- **************************************************************
                ************************** FULL TEXT ROW **************************
                *************************************************************** -->

                    <?php
                    // Vars
                    $sectionType = 'section-full-text-row';
                    $fullTextTitle = get_sub_field('page-row-full-text-title');
                    $fullTextContent = get_sub_field('page-row-full-text-content');
                    $minHeight = 'no-min-height';
                    $verticalCenter = 'no-center';
                    if ($i === 1) {
                        $minHeight = '';
                        $verticalCenter = '';
                    }
                    ?>

                    <section id="page-section-<?php echo $i; ?>" class="page-section <?php echo $sectionType; ?> clear">
                        <div class="content-section-inner clear">

                            <!-- FULL TEXT -->
                            <div class="content-col <?php echo $minHeight; ?> content-col-full-text">
                                <div class="content-col-inner <?php echo $verticalCenter; ?>">
                                    <div class="content-col-vertical main-content">
                                        <?php if ($fullTextTitle) : ?>
                                            <div class="content-block-title">
                                                <h4 class="split-weight"><?php echo $fullTextTitle; ?></h4>
                                            </div>
                                        <?php endif; ?>
                                        <div class="wysiwyg-content">
                                            <?php echo $fullTextContent; ?>

                                            <!-- Check for right block PDF uploads -->
                                            <?php if( have_rows('page-row-full-text-files') ): ?>
                                                <ul class="file-list">
                                                <?php while ( have_rows('page-row-full-text-files') ) : the_row(); ?>
                                                    <li class="file-list-item">
                                                        <a target="_blank" href="<?php the_sub_field('page-row-file-link'); ?>"><?php the_sub_field('page-row-file-name'); ?></a>
                                                    </li>
                                                <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- .content-section-inner -->

                        <?php if ($i === 1 && $totalRows > 2) : ?>
                            <!-- Section scroll for the first section if we have more rows -->
                            <div class="section-scroll shift-right">
                            </div>
                        <?php endif; ?>
                    </section>

                <?php elseif( get_row_layout() == 'page-row-full' ): ?>
                <!-- **************************************************************
                ************************** FULL WIDTH ROW *************************
                *************************************************************** -->

                    <?php
                    // Vars
                    $sectionType = 'section-full-row';
                    $fullBackground = get_sub_field('page-row-full-background');
                    $fullText = get_sub_field('page-row-full-text', false, false);
                    $fullImage = get_sub_field('page-row-full-image')['sizes']['desktop-full'];

                    if ($fullImage) {
                        $textShadow = 'text-on-image';
                    }
                    ?>

                    <section id="page-section-<?php echo $i; ?>" class="page-section <?php echo $sectionType; ?> clear">
                        <!-- FULL ROW -->
                        <div class="content-section-inner clear">
                            <div class="content-col content-col-full col-1 <?php echo $fullBackground; ?>" style="background-image: url('<?php echo $fullImage; ?>')">
                                <div class="content-col-inner">
                                    <div class="content-col-vertical main-content">
                                        <div class="wysiwyg-content <?php echo $textShadow; ?> disable-select">
                                            <h3><?php echo $fullText; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if ($i === 1 && $totalRows > 2) : ?>
                            <!-- Section scroll for the first section if we have more rows -->
                            <div class="section-scroll shift-right">
                            </div>
                        <?php endif; ?>
                    </section>

                <?php endif; // get_row_layout() ?>

            <?php endwhile; // have_rows('page-flexible-content') ?>

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
