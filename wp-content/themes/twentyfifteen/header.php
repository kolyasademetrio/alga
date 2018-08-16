<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="wrapper__main">
	<div class="content__main">

		<!--header-->
		<header class="header" id="header">
			<div class="header__top">
				<div class="container headerTop__container">
					<div class="row headerTop__row">
						<div class="col-xs-12 headerTop__col">
							<div class="headerTop__inner">
								<div class="headerTop__menu">
									<ul class="headerTop__menuList">
									<?php
										$headerTop__menu = wp_get_nav_menus(array('hide_empty' => false, 'orderby' => 'name'));
										$headerTop__menuList = wp_get_nav_menu_items('menu_header_top');
										for ($i = 0; $i < count($headerTop__menuList); $i++) {
											?>
											<li class="headerTop__menuItem">
												<a href="<?php echo $headerTop__menuList[$i]->url; ?>" class="headerTop__menuItemLink" id="">
													<?php echo $headerTop__menuList[$i]->title; ?>
												</a>
											</li>
										<?php
										}
									?>
									</ul>
								</div>

								<div class="headerTop__right">
									<div class="headerTop__search">
										<a href="#headerTop__searchPopup" class="headerTop__searchLink"></a>
										<div class="headerTop__searchPopup mfp-hide" id="headerTop__searchPopup">
											<form action="<?php bloginfo( 'url' ); ?>" method="get">
												<input  type="text" name="s" placeholder="Поиск по товарам..." value="<?php if(!empty($_GET['s'])){echo $_GET['s'];}?>"/>
												<button type="submit"></button>
											</form>
										</div>
									</div>

									<div class="headerTop__myaccount">
										<?php if ( is_user_logged_in() ) { ?>
											<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Мой аккаунт','woothemes'); ?>"><?php _e('Мой аккаунт','woothemes'); ?></a>
										<?php }
										else { ?>
											<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a>
										<?php } ?>
									</div>

									<div class="headerTop__cart">
										<?php global $woocommerce; ?>
										<div class="headerTop__cartQtyWrap">
											<img class="headerTop__cartQtyImg" src="<?php bloginfo('template_directory') ?>/images/myicons/cart.png" alt="Cart Icon">
											<span class="headerTop__cartQty"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></span>
										</div>
										<div class="headerTop__cartTotalWrap">
											<span class="headerTop__cartTotalInner">
												<span class="headerTop__cartTotalDivider">&ndash;</span>
												<a class="headerTop__cartTotalLink" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
													<span class="headerTop__cartTotal">
														<?php echo $woocommerce->cart->cart_contents_total; ?>
													</span>
													<span class="headerTop__cartTotalCurrency">
														<?php echo get_woocommerce_currency_symbol(); ?>
													</span>
												</a>
											</span>
										</div>
									</div>
								</div>
								

							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="header__middle">
				<a href="#headerBottom__menu" class="headerMiddle__humburger"></a>
				<div class="container headerMiddle__container">
					<div class="row headerMiddle__row">
						<div class="col-xs-12 headerMiddle__col">
							<div class="headerMiddle__inner">
								<div class="headerMiddle__logo">
									<?php
									$headerMiddle__logoImg = get_field('headerMiddle__logoImg', 'option');
									$headerMiddle__logoText = get_field('headerMiddle__logoText', 'option');

									if ( is_front_page() ) { ?>
										<div class="headerMiddle__logoLink">
											<img src="<?php echo $headerMiddle__logoImg; ?>" alt="logo" class="headerMiddle__img">
										</div>
										<?php
									} else {
										?>
										<a href="<?php echo esc_url(home_url('/')); ?>" class="headerMiddle__logoLink">
											<img src="<?php echo $headerMiddle__logoImg; ?>" alt="logo" class="headerMiddle__img">
										</a>
										<?php
									}
									?>



									<?php if ( !empty($headerMiddle__logoText) ) : ?>
										<div class="headerMiddle__logoText">
											<span>
												<?php echo $headerMiddle__logoText; ?>
											</span>
										</div>
									<?php endif; ?>
								</div>

								<div class="headerMiddle__points">
									<?php
									$issue_point_marker = get_field('issue_point_marker', 'option');
									$issue_point_qty_text = get_field('issue_point_qty_text', 'option');
									$issue_point_popup_title = get_field('issue_point_popup_title', 'option');
									$issue_point_popup_town_title = get_field('issue_point_popup_town_title', 'option');
									$issue_point_popup_phone_title = get_field('issue_point_popup_phone_title', 'option');
									$issue_point_popup_address_title = get_field('issue_point_popup_address_title', 'option');
									$issue_points = get_field('issue_points', 'option');
									?>
									<div class="headerMiddle__pointsLeft">

									</div>
									<div class="headerMiddle__pointsMiddle">
										<img src="<?php echo $issue_point_marker; ?>" alt="img" class="headerMiddle__pointsMarker">
									</div>
									<div class="headerMiddle__pointsRight">
										<a href="#headerMiddle__pointsPopup" class="headerMiddle__pointsLink">
											<?php echo count($issue_points).' '.$issue_point_qty_text;  ?>
										</a>
									</div>
									<!-- .headerMiddle__pointsPopup -->
									<div class="headerMiddle__pointsPopup mfp-hide" id="headerMiddle__pointsPopup">
										<div class="headerMiddle__pointsPopupHeader">
											<?php echo $issue_point_popup_title; ?>
										</div>
										<div class="headerMiddle__pointsPopupMarkerWrap">
											<img src="<?php echo $issue_point_marker; ?>" alt="" class="headerMiddle__pointsPopupMarker">
										</div>
										<div class="headerMiddle__pointsPopupContent">
											<div class="headerMiddle__pointsPopupTable">
												<div class="headerMiddle__pointsPopupTr">
													<div class="headerMiddle__pointsPopupTh">
														<?php echo $issue_point_popup_town_title; ?>
													</div>
													<div class="headerMiddle__pointsPopupTh">
														<?php echo $issue_point_popup_phone_title; ?>
													</div>
													<div class="headerMiddle__pointsPopupTh">
														<?php echo $issue_point_popup_address_title; ?>
													</div>
												</div>

												<?php if( !empty( $issue_points ) ) : ?>
														<?php
														$issue_i = 1;
														for ( $issue_i; $issue_i < count($issue_points); $issue_i++ ) { ?>

															<div class="headerMiddle__pointsPopupTr">
																<div class="headerMiddle__pointsPopupTd">
																	<?php echo $issue_points[$issue_i]['point_town']; ?>
																</div>
																<div class="headerMiddle__pointsPopupTd">
																	<?php echo $issue_points[$issue_i]['point_phone']; ?>
																</div>
																<div class="headerMiddle__pointsPopupTd">
																	<?php echo $issue_points[$issue_i]['point_address']; ?>
																</div>
															</div>
														<?php }; ?>
												<?php endif; ?>
												<!--<div class="headerMiddle__pointsPopupTr">

													<div class="headerMiddle__pointsPopupTd">

													</div>
													<div class="headerMiddle__pointsPopupThd">

													</div>
													<div class="headerMiddle__pointsPopupTd">

													</div>
												</div>-->
											</div>
										</div>
									</div><!-- headerMiddle__pointsPopup End -->
								</div>

								<div class="headerMiddle__infoWrap">
									<div class="headerMiddle__info">
										<?php
										$headerMiddle__phone = get_field('headerMiddle__phone', 'options');
										$headerMiddle__infoFeedbackText = get_field('headerMiddle__infoFeedbackText', 'options');
										$headerMiddle__infoSchedule = get_field('headerMiddle__infoSchedule', 'options');
										?>
										<a href="tel:<?php echo str_replace( array(' ', '(', ')', '-'), '', $headerMiddle__phone ); ?>" class="headerMiddle__infoPhone">
											<?php echo $headerMiddle__phone; ?>
										</a>
										<a href="#headerMiddle__infoFeedbackPopup" class="headerMiddle__infoFeedback">
											<?php echo $headerMiddle__infoFeedbackText; ?>
										</a>
										<div class="headerMiddle__infoSchedule">
											<?php echo $headerMiddle__infoSchedule; ?>
										</div>
										<!-- headerMiddle__infoFeedbackPopup -->
										<div class="headerMiddle__infoFeedbackPopup mfp-hide" id="headerMiddle__infoFeedbackPopup">
											<?php echo do_shortcode( '[contact-form-7 id="55" title="Заказать звонок"]' ); ?>
										</div><!-- headerMiddle__infoFeedbackPopup End -->

									</div>

									<div class="headerMiddle__socQstns">
										<?php
										$headerMiddle_socialList = get_field('headerMiddle_socialList', 'options');
										$headerMiddle_askText = get_field('headerMiddle_askText', 'options');
										?>
										<?php if ( !empty( $headerMiddle_socialList ) ) : ?>
											<div class="headerMiddle__soc">
												<ul>
												<?php foreach ( $headerMiddle_socialList as $headerMiddle_soc ) : ?>
													<li>
														<a href="<?php echo $headerMiddle_soc['link']; ?>" target="_blank">
															<img src="<?php echo $headerMiddle_soc['img']; ?>" alt="social">
														</a>
													</li>
												<?php endforeach; ?>
												</ul>
											</div>
										<?php endif; ?>

										<?php if ( !empty( $headerMiddle_askText ) ) : ?>
											<div class="headerMiddle_ask">
												<a href="#" class="headerMiddle_askText">
													<?php echo $headerMiddle_askText; ?>
												</a>
											</div>
										<?php endif; ?>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="header__bottom">
				<div class="container headerMiddle__container">
					<div class="row headerMiddle__row">
						<div class="col-xs-12 headerMiddle__col">
							<div class="headerMiddle__inner">

								<div class="headerBottom__menu" id="headerBottom__menu">
									<ul class="headerBottom__menuList">
										<?php
										$headerBottom__menu = wp_get_nav_menus(array('hide_empty' => false, 'orderby' => 'name'));
										$headerBottom__menuList = wp_get_nav_menu_items('menu_header_bottom');

										$current_page_ID = get_the_ID();

										$request_uri =  $_SERVER['REQUEST_URI'];

										for ($i = 0; $i < count($headerBottom__menuList); $i++) {

											/*echo '<pre>';
											var_dump($headerBottom__menuList[$i]->url);
											var_dump($request_uri);
											echo '</pre>';*/

											$list_page_ID = get_post_meta( $headerBottom__menuList[$i]->ID, '_menu_item_object_id', true );

											$woocomm_shop_page_id = get_option( 'woocommerce_shop_page_id' );

											if ( $current_page_ID == $list_page_ID ) {
												$class_name = ' active';
											} else if ( is_shop() && $list_page_ID == $woocomm_shop_page_id ) {
												$class_name = ' active';
											} else if ( is_product_category() && $list_page_ID == $woocomm_shop_page_id ) {
												$class_name = ' active';
											} else if ( is_product_taxonomy() && $list_page_ID == $woocomm_shop_page_id ) {
												$class_name = ' active';
											} else if ( is_product() && $list_page_ID == $woocomm_shop_page_id ) {
												$class_name = ' active';
											} else if ( is_post_type_archive( 'movies' ) && strpos($headerBottom__menuList[$i]->url, 'videotip') ) {
												$class_name = ' active';
											} else if ( is_singular( 'movies' ) && strpos($headerBottom__menuList[$i]->url, 'videotip') ) {
												$class_name = ' active';
											} else if ( is_post_type_archive( 'usersfeedback' ) && strpos($headerBottom__menuList[$i]->url, 'feedback') ) {
												$class_name = ' active';
											} else if ( is_singular( 'usersfeedback' ) && strpos($headerBottom__menuList[$i]->url, 'feedback') ) {
												$class_name = ' active';
											}else {
												$class_name = '';
											}
											?>
											<li class="headerBottom__menuItem">
												<a href="<?php echo $headerBottom__menuList[$i]->url; ?>" class="headerBottom__menuItemLink<?php echo $class_name; ?>" id="">
													<?php echo $headerBottom__menuList[$i]->title; ?>
												</a>
											</li>
											<?php
										}
										?>
									</ul>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div id="main" class="site__main">
