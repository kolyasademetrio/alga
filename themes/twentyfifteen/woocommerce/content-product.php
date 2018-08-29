<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>


<div class="good__item">
    <div class="good__itemInner">
        <div class="good__itemContent">
            <div class="good__itemHeader">
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'medium' );?>
                <img class="good__itemImage" src="<?php  echo $image[0]; ?>" data-id="<?php echo $product->get_id(); ?>">
            </div>

            <div class="good__itemTitle">
                <?php echo the_title(); ?>
            </div>

            <div class="good__itemExcerpt">
                <?php echo CFS()->get('good_excerpt', $product->get_id()); ?>
            </div>

            <div class="good__itemDescr">
                <?php if ( !empty(trim(get_the_title())) ) : ?>
                    <a href="<?php echo $product->get_permalink(); ?>" class="good__itemDescrTitle">
                        <?php echo get_the_title(); ?>
                    </a>
                <?php endif; ?>

                <a href="<?php echo $product->get_permalink(); ?>" class="good__itemDescrText">
                    <?php echo CFS()->get('good__descr', $product->get_id()); ?>
                </a>

                <?php if ( !empty( CFS()->get('good_soc_feed_link', $product->get_id()) ) ) : ?>
                    <a class="good__socFeed" href="<?php echo CFS()->get('good_soc_feed_link', $product->get_id()); ?>" target="_blank">
                        <img class="good__socFeedImg" src="<?php echo CFS()->get('good_soc_feed_img', $product->get_id()); ?>" data-id="<?php echo $product->get_id(); ?>">
                    <span class="good__socFeedText">
                        <?php echo CFS()->get('good_soc_feed_text', $product->get_id()); ?>
                    </span>
                    </a>
                <?php endif; ?>

                <?php if ( !empty( CFS()->get('good_video_link', $product->get_id()) ) ) : ?>
                    <a class="good__video" href="<?php echo CFS()->get('good_video_link', $product->get_id()); ?>" target="_blank">
                        <img class="good__videoImg" src="<?php echo CFS()->get('good_video_img', $product->get_id()); ?>" data-id="<?php echo $product->get_id(); ?>">
                    <span class="good__videoText">
                        <?php echo CFS()->get('good_video_text', $product->get_id()); ?>
                    </span>
                    </a>
                <?php endif; ?>
            </div>

            <?php if ( !empty( CFS()->get('good_label', $product->get_id()) ) ) : ?>
                <img class="good__itemImageLabel" src="<?php echo CFS()->get('good_label', $product->get_id()); ?>" data-id="<?php echo $product->get_id(); ?>">
            <?php endif; ?>

            <div class="good__itemPrices">
                <?php if ( !empty(trim($product->get_sale_price())) ) : ?>
                    <span class="good__itemSalePrice">
                        <?php echo $product->get_sale_price() . get_woocommerce_currency_symbol(); ?>
                    </span>
                <?php endif; ?>
                <span class="good__itemRegularPrice">
                    <?php echo $product->get_regular_price() . get_woocommerce_currency_symbol(); ?>
                </span>
            </div>
        </div>

        <div class="good__itemFooter">
            <a href="checkout/?add-to-cart=<?php echo $product->get_id(); ?>" data-quantity="1" class="good__item__add__to__cart button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product->get_id(); ?>" data-product_sku="" rel="nofollow">В корзину</a>
        </div>
    </div>
</div>


