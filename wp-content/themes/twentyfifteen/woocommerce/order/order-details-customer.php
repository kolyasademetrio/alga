<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details">

    <h4>Дополнительная информация</h4>
    <table style="width: 100%;">
        <?php if ( !empty( trim($order->get_billing_first_name()) ) ) : ?>
            <tr>
                <th>Имя:</th>
                <td><?php echo $order->get_billing_first_name(); ?></td>
            </tr>
        <?php endif; ?>

        <?php if ( !empty( trim($order->get_billing_last_name()) ) ) : ?>
            <tr>
                <th>Фамилия:</th>
                <td><?php echo $order->get_billing_last_name(); ?></td>
            </tr>
        <?php endif; ?>

        <?php if ( $order->get_billing_phone() ) : ?>
            <tr>
                <th>Телефон:</th>
                <td><?php echo esc_html( $order->get_billing_phone() ); ?></td>
            </tr>
        <?php endif; ?>

        <?php if ( $order->get_billing_email() ) : ?>
            <tr>
                <th>E-mail:</th>
                <td><?php echo esc_html( $order->get_billing_email() ); ?></td>
            </tr>
        <?php endif; ?>

        <?php if ( !empty( trim($order->get_billing_city()) ) ) : ?>
            <tr>
                <th>Город:</th>
                <td><?php echo $order->get_billing_city(); ?></td>
            </tr>
        <?php endif; ?>

        <?php if ( !empty( trim(get_post_meta( $order->get_id(), 'billing_street', true )) ) ) : ?>
            <tr>
                <th>Улица:</th>
                <td><?php echo get_post_meta( $order->get_id(), 'billing_street', true ); ?></td>
            </tr>
        <?php endif; ?>

        <?php if ( !empty( trim(get_post_meta( $order->get_id(), 'billing_house', true )) ) ) : ?>
            <tr>
                <th>Дом:</th>
                <td><?php echo get_post_meta( $order->get_id(), 'billing_house', true ); ?></td>
            </tr>
        <?php endif; ?>

        <?php if ( !empty( trim($order->get_billing_address_2()) ) ) : ?>
            <tr>
                <th>Квартира:</th>
                <td><?php echo $order->get_billing_address_2(); ?></td>
            </tr>
        <?php endif; ?>

        <?php if ( !empty( trim(get_post_meta( $order->get_id(), 'shipping_date', true )) ) ) : ?>
            <tr>
                <th>Желаемое время доставки:</th>
                <td><?php echo get_post_meta( $order->get_id(), 'shipping_date', true ); ?></td>
            </tr>
        <?php endif; ?>
    </table>




    <?php /*if ( !empty( trim($order->get_billing_first_name()) ) ) : */?><!--
        <p style="margin:0 0 16px"><strong>Имя:</strong> <?php /*echo $order->get_billing_first_name(); */?></p>
    <?php /*endif; */?>

    <?php /*if ( !empty( trim($order->get_billing_last_name()) ) ) : */?>
        <p style="margin:0 0 16px"><strong>Фамилия:</strong> <?php /*echo $order->get_billing_last_name(); */?></p>
    <?php /*endif; */?>

    <?php /*if ( $order->get_billing_phone() ) : */?>
        <p style="margin:0 0 16px"><strong>Телефон:</strong> <?php /*echo esc_html( $order->get_billing_phone() ); */?></p>
    <?php /*endif; */?>

    <?php /*if ( $order->get_billing_email() ) : */?>
        <p style="margin:0 0 16px"><strong>E-mail:</strong> <?php /*echo esc_html( $order->get_billing_email() ); */?></p>
    <?php /*endif; */?>

    <?php /*if ( !empty( trim($order->get_billing_city()) ) ) : */?>
        <p style="margin:0 0 16px"><strong>Город:</strong> <?php /*echo $order->get_billing_city(); */?></p>
    <?php /*endif; */?>

    <?php /*if ( !empty( trim(get_post_meta( $order->get_id(), 'billing_street', true )) ) ) : */?>
        <p style="margin:0 0 16px"><strong>Улица:</strong> <?php /*echo get_post_meta( $order->get_id(), 'billing_street', true ); */?></p>
    <?php /*endif; */?>

    <?php /*if ( !empty( trim(get_post_meta( $order->get_id(), 'billing_house', true )) ) ) : */?>
        <p style="margin:0 0 16px"><strong>Дом:</strong> <?php /*echo get_post_meta( $order->get_id(), 'billing_house', true ); */?></p>
    <?php /*endif; */?>

    <?php /*if ( !empty( trim($order->get_billing_address_2()) ) ) : */?>
        <p style="margin:0 0 16px"><strong>Квартира:</strong> <?php /*echo $order->get_billing_address_2(); */?></p>
    <?php /*endif; */?>

    <?php /*if ( !empty( trim(get_post_meta( $order->get_id(), 'shipping_date', true )) ) ) : */?>
        <p style="margin:0 0 16px"><strong>Желаемое время доставки:</strong> <?php /*echo get_post_meta( $order->get_id(), 'shipping_date', true ); */?></p>
    --><?php /*endif; */?>


    <?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</section>
