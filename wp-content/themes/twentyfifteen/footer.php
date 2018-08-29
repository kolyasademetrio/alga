<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

		</div><!-- site__main -->
	</div><!-- content__main -->


	<?php
	if ( !empty(trim(get_field('footer_bg', 'options'))) && is_front_page() ) :
		$footer_bg_url = get_field('footer_bg', 'options');
		$footer_bg_styles = 'background: url('.$footer_bg_url.') no-repeat center top;-webkit-background-size: 100% 100%;background-size: 100% 100%;';
	endif;
	?>
	<footer id="colophon" class="footer" role="contentinfo" style="<?php echo $footer_bg_styles; ?>">
		<div class="container footer__container">
			<div class="row footer__row">
				<div class="col-xs-12 footer__col">
					<div class="footer__inner">
						<div class="footer__item">
							<ul class="footer__menuList">
								<?php
								$footer__menu = wp_get_nav_menus(array('hide_empty' => false, 'orderby' => 'name'));
								$footer__menuList = wp_get_nav_menu_items('menu_footer_main');
								for ($i = 0; $i < count($footer__menuList); $i++) {
									?>
									<li class="footer__menuItem">
										<a href="<?php echo $footer__menuList[$i]->url; ?>" class="footer__menuItemLink" id="">
											<?php echo $footer__menuList[$i]->title; ?>
										</a>
									</li>
									<?php
								}
								?>
							</ul>
						</div>

						<div class="footer__item">
							<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="footer__itemTitleLink">Продукция</a>

							<?php //echo get_category_link( 19 ); ?>

							<?php
							$taxonomy     = 'product_cat';
							$orderby      = 'name';
							$show_count   = 0;      // 1 for yes, 0 for no
							$pad_counts   = 0;      // 1 for yes, 0 for no
							$hierarchical = 1;      // 1 for yes, 0 for no
							$title        = '';
							$empty        = 0;

							$args = array(
								'taxonomy'     => $taxonomy,
								'orderby'      => $orderby,
								'show_count'   => $show_count,
								'pad_counts'   => $pad_counts,
								'hierarchical' => $hierarchical,
								'title_li'     => $title,
								'hide_empty'   => $empty
							);
							$all_categories = get_categories( $args );
							?>
							<ul class="footer__categoryList">
								<?php
								foreach ($all_categories as $cat) :
									if($cat->category_parent == 0) :
										$category_id = $cat->term_id;
										?>
										<li class="footer__categoryItem">
											<a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="footer__categoryItemLink">
												<?php echo $cat->name; ?>
											</a>
										</li>
										<?php
									endif;
								endforeach;
								?>
							</ul>
						</div>

						<div class="footer__item">
							<?php
							$url = trim(get_field('footer_contacts_title_link', 'options'));
							$text_link = trim(get_field('footer_contacts_title', 'options'));
							$address = trim(get_field('footer_contacts_address', 'options'));
							$phone = trim(get_field('footer_contacts_phone', 'options'));
							$email = trim(get_field('footer_contacts_email', 'options'));
							?>
							<?php if ( empty($url) ) { ?>
								<div class="footer__itemTitleLink">$text_link</div>
							<?php } else { ?>
								<a href="<?php echo $url; ?>" class="footer__itemTitleLink"><?php echo $text_link; ?></a>
							<?php } ?>

							<ul class="footer__contactsList">
								<li>
									<?php echo $address; ?>
								</li>
								<li>
									<a href="tel:<?php echo str_replace( array(' ', '(', ')', '-'), '', $phone ); ?>">
										<?php echo $phone; ?>
									</a>
								</li>
								<li>
									<a href="mailto:<?php echo $email; ?>">
										<?php echo $email; ?>
									</a>
								</li>
							</ul>


						</div>

						<div class="footer__item">
							<div class="footer__itemTitleLink copyright_hidden">&nbsp;</div>
							<div class="footer__copyright">
								<div>2018. ALGA PH. Разработка сайта</div>
								<div><a href="http://www.seotm.ua/">SEOTM Digital Agency</a>.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- .site-footer -->

</div><!-- wrapper__main -->

<?php wp_footer(); ?>

</body>
</html>
