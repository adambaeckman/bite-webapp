<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "app-content" div and all content after.
 *
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */
?>

			</div><!-- .app-content -->

		</div><!-- #app -->

		<?php
		// Get contact details from custom post type
		$args = array(
			'posts_per_page'   => 1,
			'orderby'	  => 'menu_order',
			'order'       => 'ASC',
			'post_type'   => 'contact-details',
			'post_status'      => 'publish',
		);

		$footerContact = get_posts( $args );
		?>

		<?php if ( !empty($footerContact[0]) ) : ?>

			<?php
			$footerContactID = $footerContact[0]->ID;

			$footerAddressVisit = get_field('contact-info-visit-address', $footerContactID);
			$footerAddressBilling = get_field('contact-info-billing-address', $footerContactID);
			$footerPhone = get_field('contact-info-phone', $footerContactID);
			$footerEmail = get_field('contact-info-email', $footerContactID);
			$footerAccount = get_field('contact-info-bank-account', $footerContactID);
			?>

			<footer id="colophon" class="app-footer" role="contentinfo">
				<div class="footer-rings">
				</div>
				<div id="footer">
					<div id="footer-inner" class="main-content clear">
						<div class="footer-contact">
							<?php if (!empty($footerAddressVisit)) : ?>
								<div class="footer-contact-group">
									<h5>Besöksadress</h5>
									<h6><?php echo $footerAddressVisit; ?></h6>
								</div>
							<?php endif; ?>

							<?php if (!empty($footerPhone)) : ?>
								<div class="footer-contact-group">
									<h5>Telefon</h5>
									<h6><?php echo $footerPhone; ?></h6>
								</div>
							<?php endif; ?>

							<?php if (!empty($footerEmail)) : ?>
								<div class="footer-contact-group">
									<h5>E-post</h5>
									<h6>
										<a class="link-hover" href="mailto:<?php echo $footerEmail; ?>"><?php echo $footerEmail; ?></a>
									</h6>
								</div>
							<?php endif; ?>
						</div>

						<div class="footer-contact">
							<?php if (!empty($footerAddressBilling)) : ?>
								<div class="footer-contact-group">
									<h5>Faktureringsadress</h5>
									<h6><?php echo $footerAddressBilling; ?></h6>
								</div>
							<?php endif; ?>

							<?php if (!empty($footerAccount)) : ?>
								<div class="footer-contact-group">
									<h5>Bankgiro</h5>
									<h6><?php echo $footerAccount; ?></h6>
								</div>
							<?php endif; ?>
						</div>

						<div class="footer-logo">
						</div>
					</div>
				</div>
			</footer><!-- .app-footer -->

		<?php endif; ?>

		<?php wp_footer(); ?>

		<div id="mobile-indicator">
		</div>

	</body>
</html>
