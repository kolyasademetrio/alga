<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>



	<?php
	$good_screen_show = get_field('good_screen_show', 'options');
	$good_screen_text = get_field('good_screen_text', 'options');
	$good_screen_bgcolor = get_field('good_screen_bgcolor', 'options');
	$good_screen_bgimage = get_field('good_screen_bgimage', 'options');
	$bg_color = '';

	if ( !empty($good_screen_bgcolor) ) {
		$bg_color = 'background: url(' . $good_screen_bgcolor . ') no-repeat center center;
					-webkit-background-size: cover;
					background-size: cover;';
	}
	?>

	<?php if ( $good_screen_show ) : ?>
	<div class="goodScreen" style="<?php echo $bg_color; ?>">
		<div class="container woocomm__container">
			<div class="row woocomm__row">
				<div class="col-xs-12">
					<div class="woocomm__col goodScreen__col">
						<?php if ( !empty($good_screen_bgimage) ) : ?>
							<div class="goodScreen__bgImage">
								<img src="<?php echo $good_screen_bgimage; ?>" alt="">
							</div>
						<?php endif; ?>

						<?php if ( !empty($good_screen_text) ) : ?>
							<div class="goodScreen__text">
								<?php echo $good_screen_text; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>


	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
