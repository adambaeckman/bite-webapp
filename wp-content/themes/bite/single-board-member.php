<?php
/**
 * The template for displaying all single board members. Which shouldn't be displayed.
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */

get_header(); ?>

	<div id="single-board-member-content" class="page-content light-blue">
		<section class="page-section no-page-content content-section">
			<div class="content-section-inner main-content clear">
				<div class="content-col col-1">
			   		<div class="content-col-inner">
			   			<div class="content-col-vertical">
			   				<?php
			   				$memberTitle = get_field('board-title');
							$memberPhone = get_field('board-phone');
							$memberEmail = get_field('board-email');
			   				?>

			   				<?php if ($memberTitle || $memberPhone || $memberEmail) : ?>
				   				<?php if ($memberTitle) : ?>
				   					<h3><?php echo $memberTitle; ?></h3>
				   				<?php endif; ?>

				   				<?php if ($memberPhone) : ?>
				   					<h4 class="thin"><?php echo $memberPhone; ?></h4>
				   				<?php endif; ?>

				   				<?php if ($memberEmail) : ?>
				   					<h4 class="thin">
				   						<a class="hover-link" href="<?php echo $memberEmail; ?>"><?php echo $memberEmail; ?></a>
				   					</h4>
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
