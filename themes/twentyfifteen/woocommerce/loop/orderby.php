<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
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
<form class="woocommerce-ordering" method="get">
    <ul name="orderby" class="orderby">
        <?php foreach ( $catalog_orderby_options as $id => $name ) :

            echo '<li><a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '?orderby=' . $id . '" >' . esc_attr( $name ) . '</a></li>';

        endforeach; ?>
    </ul>
    <input type="hidden" name="paged" value="1" />
    <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>
