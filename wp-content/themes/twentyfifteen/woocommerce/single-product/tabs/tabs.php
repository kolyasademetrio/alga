<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

    <div class="woocommerce-tabs wc-tabs-wrapper">
        <!-- Вкладки -->
        <ul class="tabs wc-tabs" role="tablist">

            <?php if ( !empty(CFS()->get('good_tabs_description_tab', get_the_ID())) ) : ?>
                <li class="description_tab" id="tab-title-description>" role="tab" aria-controls="tab-description>">
                    <a href="#tab-description">
                        <?php echo CFS()->get('good_tabs_description_tab', get_the_ID());?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ( !empty(CFS()->get('good_tabs_ingredients_tab', get_the_ID())) ) : ?>
                <li class="ingredients_tab" id="tab-title-ingredients>" role="tab" aria-controls="tab-ingredients>">
                    <a href="#tab-ingredients">
                        <?php echo CFS()->get('good_tabs_ingredients_tab', get_the_ID());?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ( !empty(CFS()->get('good_tabs_usage_tab', get_the_ID())) ) : ?>
                <li class="usage_tab" id="tab-title-usage>" role="tab" aria-controls="tab-usage>">
                    <a href="#tab-usage">
                        <?php echo CFS()->get('good_tabs_usage_tab', get_the_ID());?>
                    </a>
                </li>
            <?php endif; ?>

            <?php foreach ( $tabs as $key => $tab ) : ?>
                <li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
                    <a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <!-- Вкладки End -->


        <!-- Содержимое Вкладок -->
        <?php if ( !empty(CFS()->get('tab_bg', get_the_ID())) ) : ?>
        <?php
            $tab_bg = CFS()->get('tab_bg', get_the_ID());
            $style_bg = 'background: url('.$tab_bg.') no-repeat bottom right; min-height: 480px; background-size: auto 385px;';
        ?>
        <?php endif; ?>

        <?php if ( !empty(!empty(CFS()->get('good_tabs_description_tab', get_the_ID()))) ) : ?>

            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description" style="<?php echo $style_bg; ?>">
                <?php echo CFS()->get('good_tabs_description_content', get_the_ID());?>
            </div>

        <?php endif; ?>

        <?php if ( !empty(!empty(CFS()->get('good_tabs_ingredients_tab', get_the_ID()))) ) : ?>

            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--ingredients panel entry-content wc-tab" id="tab-ingredients" role="tabpanel" aria-labelledby="tab-title-ingredients" style="<?php echo $style_bg; ?>">
                <?php echo CFS()->get('good_tabs_ingredients_content', get_the_ID());?>
            </div>

        <?php endif; ?>

        <?php if ( !empty(!empty(CFS()->get('good_tabs_usage_tab', get_the_ID()))) ) : ?>

            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--usage panel entry-content wc-tab" id="tab-usage" role="tabpanel" aria-labelledby="tab-title-usage" style="<?php echo $style_bg; ?>">
                <?php echo CFS()->get('good_tabs_usage_content', get_the_ID());?>
            </div>

        <?php endif; ?>

        <?php foreach ( $tabs as $key => $tab ) : ?>
            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
            </div>
        <?php endforeach; ?>
        <!-- Содержимое Вкладок End -->

    </div>

<?php endif; ?>

