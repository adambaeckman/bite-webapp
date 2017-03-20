<?php
/**
 * The template for displaying all single offices. Which shouldn't be displayed.
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */

get_header(); ?>

	<div id="single-office-content" class="page-content light-blue">
		<section class="page-section no-page-content content-section">
			<div class="content-section-inner main-content clear">
				<div class="content-col col-1">
			   		<div class="content-col-inner">
			   			<div class="content-col-vertical">
			   				<?php
			   				$officeAddress = get_field('office-address');
							$officeZip = get_field('office-zip');
							$officeArea = get_field('office-area');
			   				?>

			   				<?php if ($officeAddress || $officeZip || $officeArea) : ?>
				   				<?php if ($officeAddress) : ?>
				   					<h4><?php echo $officeAddress; ?></h4>
				   				<?php endif; ?>

				   				<?php if ($officeZip || $officeArea) : ?>
				   					<h4 class="thin"><?php echo $officeZip.' '.$officeArea; ?></h4>
				   				<?php endif; ?>
				   			<?php else: ?>
				   				<h4 class="thin">Det finns tyvärr ingen mer information om <?php the_title(); ?> för tillfället.</h4>
				   			<?php endif; ?>
			   			</div>
			   		</div>
			   	</div>
			</div>
		</section>
	</div> <!-- .page-content -->

<?php get_footer(); ?>
