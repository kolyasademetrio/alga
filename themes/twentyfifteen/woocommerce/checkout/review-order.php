<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="checkout__table__title">
    <div class="checkout__table__titleText">Ваш заказ</div>
    <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="checkout__table__titleLink">Продолжить покупки</a>
</div>

<table class="shop_table woocommerce-checkout-review-order-table" dima>
    <tbody>
    <?php
    do_action( 'woocommerce_review_order_before_cart_contents' );

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            ?>
            <!-- ******************************************************************************************************** -->
            <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

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

                <td class="product-quantity qty_checkout" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
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
            <!-- ******************************************************************************************************** -->
            <?php
        }
    }

    do_action( 'woocommerce_review_order_after_cart_contents' );
    ?>


    </tbody>

    <?php
    global $woocommerce;
    $cart_total    = $woocommerce->cart->cart_contents_total;
    $cart_subtotal = $woocommerce->cart->get_subtotal();
    ?>
    <tfoot>
        <tr class="cart-subtotal">
            <td colspan="5">
                <div class="cart__subtotal_wrap">
                    <div class="cart__subtotal_text">
                        <?php _e( 'Сумма заказа', 'woocommerce' ); ?>
                    </div>

                    <div class="cart__subtotal_total">
                        <?php wc_cart_totals_order_total_html(); ?>
                    </div>

                    <?php
                    if (($cart_subtotal - $cart_total) > 0) {
                        ?>
                        <div class="cart__subtotal_subtotal">
                            <span class="woocommerce-Price-amount amount"><span class="line-through"><?php echo $cart_subtotal; ?></span><span class="woocommerce-Price-currencySymbol"><?php echo get_woocommerce_currency_symbol(); ?></span></span>
                            <?php /*wc_cart_totals_subtotal_html();*/ ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </td>
        </tr>

        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>



            <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <td colspan="3">
                    <span class="code__value__text">Код на скидку</span><span class="code__value"><?php echo $code; ?></span>

                    <?php /*wc_cart_totals_coupon_label( $coupon ); */?>
                </td>
                <td colspan="2">
                    <?php /*wc_cart_totals_coupon_html( $coupon );*/ ?>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php /*if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : */?><!--

                <?php /*do_action( 'woocommerce_review_order_before_shipping' ); */?>

                <?php /*wc_cart_totals_shipping_html(); */?>

                <?php /*do_action( 'woocommerce_review_order_after_shipping' ); */?>

            --><?php /*endif; */?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <tr class="fee">
                <td colspan="3"><?php echo esc_html( $fee->name ); ?></td>
                <td colspan="2"><?php wc_cart_totals_fee_html( $fee ); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
            <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                    <tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
                        <td colspan="3"><?php echo esc_html( $tax->label ); ?></td>
                        <td colspan="2"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr class="tax-total">
                    <td colspan="3"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></td>
                    <td colspan="2"><?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

       <!-- <tr class="order-total">
            <td colspan="3"><?php /*_e( 'Total', 'woocommerce' ); */?></td>
            <td colspan="2"><?php /*wc_cart_totals_order_total_html(); */?></td>
        </tr>-->

        <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

    </tfoot>
</table>