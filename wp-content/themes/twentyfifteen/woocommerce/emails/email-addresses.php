<?php
/**
 * Email Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     3.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$text_align = is_rtl() ? 'right' : 'left';

?>

<?php if ( !empty( trim($order->get_billing_first_name()) ) ) : ?>
    <p style="margin:0 0 16px"><strong>Имя:</strong> <?php echo $order->get_billing_first_name(); ?></p>
<?php endif; ?>

<?php if ( !empty( trim($order->get_billing_last_name()) ) ) : ?>
    <p style="margin:0 0 16px"><strong>Фамилия:</strong> <?php echo $order->get_billing_last_name(); ?></p>
<?php endif; ?>

<?php if ( $order->get_billing_phone() ) : ?>
    <p style="margin:0 0 16px"><strong>Телефон:</strong> <?php echo esc_html( $order->get_billing_phone() ); ?></p>
<?php endif; ?>

<?php if ( $order->get_billing_email() ) : ?>
    <p style="margin:0 0 16px"><strong>E-mail:</strong> <?php echo esc_html( $order->get_billing_email() ); ?></p>
<?php endif; ?>

<?php if ( !empty( trim($order->get_billing_city()) ) ) : ?>
    <p style="margin:0 0 16px"><strong>Город:</strong> <?php echo $order->get_billing_city(); ?></p>
<?php endif; ?>

<?php if ( !empty( trim(get_post_meta( $order->get_id(), 'billing_street', true )) ) ) : ?>
    <p style="margin:0 0 16px"><strong>Улица:</strong> <?php echo get_post_meta( $order->get_id(), 'billing_street', true ); ?></p>
<?php endif; ?>

<?php if ( !empty( trim(get_post_meta( $order->get_id(), 'billing_house', true )) ) ) : ?>
    <p style="margin:0 0 16px"><strong>Дом:</strong> <?php echo get_post_meta( $order->get_id(), 'billing_house', true ); ?></p>
<?php endif; ?>

<?php if ( !empty( trim($order->get_billing_address_2()) ) ) : ?>
<p style="margin:0 0 16px"><strong>Квартира:</strong> <?php echo $order->get_billing_address_2(); ?></p>
<?php endif; ?>

<?php if ( !empty( trim(get_post_meta( $order->get_id(), 'shipping_date', true )) ) ) : ?>
    <p style="margin:0 0 16px"><strong>Желаемое время доставки:</strong> <?php echo get_post_meta( $order->get_id(), 'shipping_date', true ); ?></p>
<?php endif; ?>

<?php if(get_post_meta( $order->get_id(), 'order_feedback_allow', true )) : ?>
    <p style="margin:0 0 16px"><strong>Мне можно не звонить для подтверждения заказа</strong></p>
<?php endif; ?>


