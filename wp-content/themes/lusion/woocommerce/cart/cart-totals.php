<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">
	<div class="title-hdwoo">
		<h6 class="title-cart"><?php esc_html_e('Grand total', 'lusion'); ?></h6>
		<span class="ti-angle-down"></span>
	</div>
	<div class="box-cart-total">
		<?php do_action('woocommerce_before_cart_totals'); ?>
		<table cellspacing="0" class="shop_table shop_table_responsive">
			<tr class="cart-subtotal">
				<th><?php esc_html_e('Subtotal:', 'lusion'); ?></th>
				<td data-title="<?php esc_attr_e('Subtotal:', 'lusion'); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
			</tr>
			<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
				<tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
					<th><?php echo esc_html__('Discount:','lusion'); ?></th>
					<td data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></td>
				</tr>
			<?php endforeach; ?>
			<tr class="cart-shipping">
				<th><?php esc_html_e('Shipping:', 'lusion'); ?></th>
				<td data-title="<?php esc_attr_e('Shipping:', 'lusion'); ?>">   <?php
					echo (WC()->cart->get_cart_shipping_total());
					?></td>
			</tr>
			<?php foreach (WC()->cart->get_fees() as $fee) : ?>
				<tr class="fee">
					<th><?php echo esc_html($fee->name); ?></th>
					<td data-title="<?php echo esc_attr($fee->name); ?>"><?php wc_cart_totals_fee_html($fee); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php if (wc_tax_enabled() && ! WC()->cart->display_prices_including_tax()) :
				$taxable_address = WC()->customer->get_taxable_address();
				$estimated_text = WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()
					? sprintf(' <small>(' . __('estimated for %s', 'lusion') . ')</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]])
					: '';

				if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
					<?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
						<tr class="tax-rate tax-rate-<?php echo sanitize_title($code); ?>">
							<th><?php echo esc_html($tax->label) . $estimated_text; ?></th>
							<td data-title="<?php echo esc_attr($tax->label); ?>"><?php echo wp_kses($tax->formatted_amount,'lusion_allow_html()'); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr class="tax-total">
						<th>
							<?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; ?>

						</th>
						<td data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
					</tr>
				<?php endif; ?>
			<?php endif; ?>

			<?php do_action('woocommerce_cart_totals_before_order_total'); ?>
			<tr class="order-total">
				<th><?php esc_html_e('Grand Total:', 'lusion'); ?></th>
				<?php $order_total = '<strong>' . WC()->cart->get_total() . '</strong> '; ?>
				<td data-title="<?php esc_attr_e('Total', 'lusion'); ?>"><?php echo wp_kses($order_total, lusion_allow_html()); ?></td>
			</tr>
			<?php do_action('woocommerce_cart_totals_after_order_total'); ?>
		</table>
		<div class="wc-proceed-to-checkout">
			<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
		</div>
	</div>

    <?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
