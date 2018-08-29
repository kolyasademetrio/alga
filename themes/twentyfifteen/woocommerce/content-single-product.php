<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>

    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */

    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
    do_action( 'woocommerce_before_single_product_summary' );
    ?>

    <div class="good_gallery">
        <div class="good_galleryWrap">
            <?php
            global $product;
            $post_thumbnail_id = $product->get_image_id();
            $attachment_ids = $product->get_gallery_image_ids();
            ?>

            <?php if ( has_post_thumbnail() || !empty($attachment_ids) ) : ?>
                <div class="good__gallerySlider<?php echo empty($attachment_ids) ? ' single__slider' : ''; ?>">
                    <?php if( has_post_thumbnail() ) : ?>
                        <a href="<?php echo esc_url(wp_get_attachment_image_src( $post_thumbnail_id, 'full' )[0]); ?>" class="good__gallerySliderItem image" data-type="image">
                            <img src="<?php echo esc_url(wp_get_attachment_image_src( $post_thumbnail_id, 'full' )[0]); ?>" alt="" class="good__gallerySliderFeaturedImg">
                        </a>
                    <?php endif; ?>

                    <?php if( !empty($attachment_ids) ) :
                        foreach( $attachment_ids as $attachment_id ) :
                        ?>
                            <a href="<?php echo esc_url(wp_get_attachment_image_src( $attachment_id, 'full' )[0]); ?>" class="good__gallerySliderItem image" data-type="image">
                                <img src="<?php echo esc_url(wp_get_attachment_image_src( $attachment_id, 'full' )[0]); ?>" alt="" class="good__gallerySliderFeaturedImg">
                            </a>
                        <?php
                        endforeach;
                    endif; ?>

                    <?php
                    $good_video_link = CFS()->get('good_video_link', get_the_ID());
                    $good_video_preview = CFS()->get('good_video_preview', get_the_ID());
                    ?>

                    <?php if( !empty(trim($good_video_link)) && trim($good_video_link) !== '/' && trim($good_video_link) !== '#' ) : ?>
                        <a href="<?php echo trim($good_video_link); ?>" class="good__gallerySliderItem video" data-type="video">
                            <img src="<?php echo trim($good_video_preview); ?>" alt="" class="good__gallerySliderFeaturedImg video" video="<?php echo trim($good_video_link); ?>">
                        </a>
                    <?php endif; ?>
                </div>

                <?php if( !empty($attachment_ids) ) : ?>

                    <div class="good__gallerySliderNav">
                        <?php if( has_post_thumbnail() ) : ?>
                            <div class="good__gallerySliderItemNav">
                                <img src="<?php echo esc_url(wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' )[0]); ?>" alt="" class="good__gallerySliderFeaturedImgNav">
                            </div>
                        <?php endif; ?>

                        <?php foreach( $attachment_ids as $attachment_id ) : ?>
                            <div class="good__gallerySliderItemNav">
                                <img src="<?php echo esc_url(wp_get_attachment_image_src( $attachment_id, 'thumbnail' )[0]); ?>" alt="" class="good__gallerySliderFeaturedImgNav">
                            </div>
                        <?php endforeach; ?>

                        <?php if( !empty(trim($good_video_link)) ) : ?>
                            <div class="good__gallerySliderItemNav">
                                <img src="<?php echo trim($good_video_preview); ?>" alt="" class="good__gallerySliderFeaturedImgNav">
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div><!-- good_galleryWrap End -->
    </div><!-- good_gallery End -->

    <div class="summary entry-summary">
        <?php $product = wc_get_product( get_the_ID() ); ?>

        <?php the_title( '<h1 class="product_title entry-title">', '</h1>' ); ?>

        <div class="goodSingle__excerpt">
            <?php echo CFS()->get('good_excerpt', get_the_ID()); ?>
        </div>

        <div class="goodSingle__descr">
            <?php echo CFS()->get('good__descr', get_the_ID()); ?>
        </div>

        <div class="goodSingle__table">
            <div class="tr">
                <div class="th">Цена</div>
                <div class="th">Количество</div>
                <div class="th">Доставка</div>
            </div>
            <div class="tr">
                <div class="td">
                    <?php
                    echo '<div class="price">';
                    echo $product->get_price_html();
                    echo '</div>';
                    ?>
                </div>
                <div class="td">
                    <?php
                    echo '<form action="' . esc_url( $product->add_to_cart_url() ) .'" class="cart" method="post" enctype="multipart/form-data">';
                    echo '<div class="quantity__wrap">';
                    woocommerce_quantity_input();
                    echo '</div>';
                    ?>
                </div class=td"">
                <div class="td terms">
                    Условия доставки
                </div>
            </div>
            <div class="tr">
                <div class="td">&nbsp;</div>
                <div class="td">
                    <button type="submit" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="ss" data-quantity="1" class="button product_type_simple">В корзину</button>
                    </form>
                </div>
                <div class="td">&nbsp;</div>
            </div>
        </div>



        <?php
        /**
         * Hook: woocommerce_single_product_summary.
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_rating - 10
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         * @hooked WC_Structured_Data::generate_product_data() - 60
         */
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

        //add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 9 );


        /*add_action( 'woocommerce_single_product_summary', 'show_product_info', 11 );
        add_action( 'woocommerce_single_product_summary', 'show_shipping_class', 12 );*/


        do_action( 'woocommerce_single_product_summary' );
        ?>
    </div>

    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


    do_action( 'woocommerce_after_single_product_summary' );
    ?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
