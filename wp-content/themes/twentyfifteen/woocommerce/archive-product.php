<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//echo 'befoRe';

do_action( 'woocommerce_before_main_content' );

//echo 'aFter';

?>
<?php
if ( woocommerce_product_loop() ) {

    /**
     * Hook: woocommerce_before_shop_loop.
     *
     * @hooked wc_print_notices - 10
     * @hooked woocommerce_result_count - 20
     * @hooked woocommerce_catalog_ordering - 30
     */
    do_action( 'woocommerce_before_shop_loop' );
    ?>
    <div class="products__wrapper">
        <div class="products__sidebar">
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
            <div class="products__categories">
                <div class="products__categoryHeader">
                    <div class="products__categoryTitle">
                        Ассортимент продуктов
                    </div>
                    <a href="#products__categoryList" class="products__categoryMenuBtn"></a>
                </div>

                <ul class="products__categoryList" id="products__categoryList">
                    <li class="products__categoryItem">
                        <a href="/shop" class="products__categoryItemLink all__categories<?php echo is_shop() ? ' active' : ''; ?>">
                            Весь ассортимент
                        </a>
                    </li>
                    <?php
                    $current_category_id = '';
                    if ( is_product_category() ) {
                        $category = get_queried_object();
                        $current_category_id = $category->term_id;
                    }

                    foreach ($all_categories as $cat) :
                        if($cat->category_parent == 0) :
                            $category_id = $cat->term_id;
                            $class_name = ( ($category_id === $current_category_id) ) ? ' active' : '';
                            ?>
                            <li class="products__categoryItem">
                                <a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="products__categoryItemLink<?php echo $class_name; ?>">
                                    <?php echo $cat->name; ?>
                                </a>
                            </li>
                            <?php
                        endif;
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>

        <div class="products__content">
            <div class="products__contentHeader">
                <div class="products__contentHeaderTitle">
                    <?php
                    if ( is_shop() ) {
                        ?>
                        Весь ассортимент
                        <?php
                    } else if ( is_product_category() ) {
                       echo single_cat_title();
                    }
                    ?>

                </div>

                <div class="products__contentHeaderFilter">
                    <span class="products__contentHeaderFilterText">Сортировать по: Цене</span>
                    <span class="products__contentHeaderFilterLinks">
                        <?php //woocommerce_catalog_ordering(); ?>
                        <?php global $wp; ?>
                        <ul name="orderby" class="orderby">
                            <li>
                                <a href="<?php echo home_url($wp->request); ?>/?orderby=price"></a>
                            </li>
                            <li>
                                <a href="<?php echo home_url($wp->request); ?>/?orderby=price-desc"></a>
                            </li>
                        </ul>


                    </span>
                </div>
            </div>



    <?php
   woocommerce_product_loop_start();

    if ( wc_get_loop_prop( 'total' ) ) {
        while ( have_posts() ) {
            the_post();

            /**
             * Hook: woocommerce_shop_loop.
             *
             * @hooked WC_Structured_Data::generate_product_data() - 10
             */
            do_action( 'woocommerce_shop_loop' );

            wc_get_template_part( 'content', 'product' );
        }
    }

    woocommerce_product_loop_end();


    /**
     * Hook: woocommerce_after_shop_loop.
     *
     * @hooked woocommerce_pagination - 10
     */
    do_action( 'woocommerce_after_shop_loop' );
    ?>
        </div><!-- products__content End -->
    </div><!-- products__wrapper End -->
    <?php
} else {
    /**
     * Hook: woocommerce_no_products_found.
     *
     * @hooked wc_no_products_found - 10
     */
    do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
