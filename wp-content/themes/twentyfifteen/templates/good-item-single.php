<?php if (CFS()->get('good_show_in_reccomended', $good->ID)) : ?>
<div class="good__item">
    <div class="good__itemInner">
        <div class="good__itemContent">
            <div class="good__itemHeader">
                <img class="good__itemImage" src="<?php echo $good_image[0]; ?>" data-id="<?php echo $good->ID; ?>">
            </div>

            <div class="good__itemTitle">
                <?php echo $good->post_title; ?>
            </div>

            <div class="good__itemExcerpt">
                <?php echo CFS()->get('good_excerpt', $good->ID); ?>
            </div>

            <div class="good__itemDescr">
                <?php if ( !empty(trim($good->post_title)) ) : ?>
                <a href="<?php echo $good->guid; ?>" class="good__itemDescrTitle">
                    <?php echo $good->post_title; ?>
                </a>
                <?php endif; ?>

                <a href="<?php echo $good->guid; ?>" class="good__itemDescrText">
                    <?php echo CFS()->get('good__descr', $good->ID); ?>
                </a>

                <?php if ( !empty( CFS()->get('good_soc_feed_link', $good->ID) ) ) : ?>
                    <a class="good__socFeed" href="<?php echo CFS()->get('good_soc_feed_link', $good->ID); ?>" target="_blank">
                        <img class="good__socFeedImg" src="<?php echo CFS()->get('good_soc_feed_img', $good->ID); ?>" data-id="<?php echo $good->ID; ?>">
                    <span class="good__socFeedText">
                        <?php echo CFS()->get('good_soc_feed_text', $good->ID); ?>
                    </span>
                    </a>
                <?php endif; ?>

                <?php if ( !empty( CFS()->get('good_video_link', $good->ID) ) ) : ?>
                    <a class="good__video" href="<?php echo CFS()->get('good_video_link', $good->ID); ?>" target="_blank">
                        <img class="good__videoImg" src="<?php echo CFS()->get('good_video_img', $good->ID); ?>" data-id="<?php echo $good->ID; ?>">
                    <span class="good__videoText">
                        <?php echo CFS()->get('good_video_text', $good->ID); ?>
                    </span>
                    </a>
                <?php endif; ?>
            </div>

            <?php if ( !empty( CFS()->get('good_label', $good->ID) ) ) : ?>
                <img class="good__itemImageLabel" src="<?php echo CFS()->get('good_label', $good->ID); ?>" data-id="<?php echo $good->ID; ?>">
            <?php endif; ?>

            <div class="good__itemPrices">
                <?php if ( empty(trim($_product->get_sale_price())) ) : ?>
                    <span class="good__itemRegularPrice">
                        <span class="good__itemRegularPriceValue"><?php echo $_product->get_regular_price() ?></span><span class="good__itemRegularPriceCur"><?php echo get_woocommerce_currency_symbol(); ?></span>
                    </span>
                <?php else : ?>
                    <span class="good__itemSalePrice">
                        <span><?php echo $_product->get_regular_price(); ?></span><span><?php echo get_woocommerce_currency_symbol(); ?></span>
                    </span>
                    <span class="good__itemRegularPrice">
                        <span class="good__itemRegularPriceValue"><?php echo $_product->get_sale_price() ?></span><span class="good__itemRegularPriceCur"><?php echo get_woocommerce_currency_symbol(); ?></span>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="good__itemFooter">
            <a href="checkout/?add-to-cart=<?php echo $good->ID; ?>" data-quantity="1" class="good__item__add__to__cart button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $good->ID; ?>" data-product_sku="" rel="nofollow">В корзину</a>
        </div>
    </div>
</div>
<?php endif; ?>