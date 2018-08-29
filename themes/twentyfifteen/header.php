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
												<a class="headerTop__cartTotalLink" href="#cart__popup" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
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
			<div id="cart__popup" class="mfp-hide cart__popup">
				<div class="entry-title">Корзина</div>
				<?php
				do_action( 'woocommerce_before_cart' ); ?>

				<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
					<?php do_action( 'woocommerce_before_cart_table' ); ?>

					<div class="cart__popup__tableWrap">
						<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
							<thead>
							<tr>
								<th class="product-remove">&nbsp;</th>
								<th class="product-thumbnail">&nbsp;</th>
								<th class="product-name"><?php esc_html_e( 'Название', 'woocommerce' ); ?></th>
								<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
								<!--							<th class="product-price">--><?php //esc_html_e( 'Price', 'woocommerce' ); ?><!--</th>-->
								<th class="product-subtotal"><?php esc_html_e( 'Сумма', 'woocommerce' ); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php do_action( 'woocommerce_before_cart_contents' ); ?>

							<?php
							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
								$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
									$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
									?>
									<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

										<td class="product-remove">
											<?php
											// @codingStandardsIgnoreLine
											echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
												'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
												esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
												__( 'Remove this item', 'woocommerce' ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											), $cart_item_key );
											?>
										</td>

										<td class="product-thumbnail">
											<?php
											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

											if ( ! $product_permalink ) {
												echo wp_kses_post( $thumbnail );
											} else {
												printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
											}
											?>
										</td>

										<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
											<?php
											if ( ! $product_permalink ) {
												echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<div class="cart__good__title">%s</div>', $_product->get_name() ), $cart_item, $cart_item_key ) );

												if ( !empty(trim(CFS()->get('good_excerpt', $product_id))) ) {
													echo '<div class="cart__good__exerpt">' . CFS()->get('good_excerpt', $product_id) . '</div>';
												}
											} else {
												echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="cart__good__title">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );

												if ( !empty(trim(CFS()->get('good_excerpt', $product_id))) ) {
													echo '<div class="cart__good__exerpt">' . CFS()->get('good_excerpt', $product_id) . '</div>';
												}
											}

											do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

											// Meta data.
											echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

											// Backorder notification.
											if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
												echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>' ) );
											}
											?>
										</td>

										<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
											<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
											} else {
												$product_quantity = woocommerce_quantity_input( array(
													'input_name'   => "cart[{$cart_item_key}][qty]",
													'input_value'  => $cart_item['quantity'],
													'max_value'    => $_product->get_max_purchase_quantity(),
													'min_value'    => '0',
													'product_name' => $_product->get_name(),
												), $_product, false );
											}
											?>
											<div class="quantity__wrap">
												<?php echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok. ?>
											</div>
										</td>

										<!--<td class="product-price" data-title="<?php /*esc_attr_e( 'Price', 'woocommerce' ); */?>">
										<?php
										/*										echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                                                */?>
									</td>-->

										<td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
											<?php
											echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
											?>
										</td>
									</tr>
									<?php
								}
							}
							?>

							<?php do_action( 'woocommerce_cart_contents' ); ?>
							</tbody>
						</table>

						<div class="actions">
							<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

							<?php do_action( 'woocommerce_cart_actions' ); ?>

							<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
						</div>

						<?php do_action( 'woocommerce_after_cart_contents' ); ?>
					</div>

					<div class="cart__popup__tableBottom">
						<div class="cart__popup__tableBottomText">Сумма заказа: </div>
						<div class="cart__popup__tableBottomSumm">
							<span class="cart__popup__cartTotal">
								<?php echo $woocommerce->cart->cart_contents_total; ?>
							</span>
							<span class="cart__popup__cartTotalCurrency">
								<?php echo get_woocommerce_currency_symbol(); ?>
							</span>
						</div>
					</div>

					<div class="cart__popup__tableBtnWrap">
						<a href="/checkout/" class="cart__popup__btn__checkout">Оформить заказ</a>
					</div>

					<div class="cart__popup__tableFooter">
						<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="checkout-button button alt wc-forward cart__popup__btn__forward">Продолжить покупки</a>
						<?php if ( wc_coupons_enabled() ) { ?>
							<div class="coupon">
								<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
								<?php do_action( 'woocommerce_cart_coupon' ); ?>
							</div>
						<?php } ?>
					</div>

					<?php do_action( 'woocommerce_after_cart_table' ); ?>
				</form>



				<?php do_action( 'woocommerce_after_cart' ); ?>
			</div>
