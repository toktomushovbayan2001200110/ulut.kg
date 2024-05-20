<?php 

    

    $shop_settings    = (array) get_option( 'wcva_shop_settings' );
	$shop_settings    = array_merge( array(), $shop_settings );


    if (isset($shop_settings['woocommerce_shop_swatch_height'])) {
    	$woocommerce_shop_swatch_height  = $shop_settings['woocommerce_shop_swatch_height'];
    } else {
    	$woocommerce_shop_swatch_height  = get_option('woocommerce_shop_swatch_height');
    }

    $woocommerce_shop_swatch_height = isset($woocommerce_shop_swatch_height) && ($woocommerce_shop_swatch_height != "") ? $woocommerce_shop_swatch_height : 32;

    if (isset($shop_settings['woocommerce_shop_swatch_width'])) {
    	$woocommerce_shop_swatch_width  = $shop_settings['woocommerce_shop_swatch_width'];
    } else {
    	$woocommerce_shop_swatch_width  = get_option('woocommerce_shop_swatch_width');
    }

    $woocommerce_shop_swatch_width = isset($woocommerce_shop_swatch_width) && ($woocommerce_shop_swatch_width != "") ? $woocommerce_shop_swatch_width : 32;

    if (isset($shop_settings['woocommerce_shop_swatch_link'])) {
    	$woocommerce_shop_swatch_link  = $shop_settings['woocommerce_shop_swatch_link'];
    } else {
    	$woocommerce_shop_swatch_link  = get_option('woocommerce_shop_swatch_link');
    }

    if (isset($shop_settings['woocommerce_wcva_disable_mobile_hover'])) {
    	$woocommerce_wcva_disable_mobile_hover  = $shop_settings['woocommerce_wcva_disable_mobile_hover'];
    } else {
    	$woocommerce_wcva_disable_mobile_hover  = get_option('woocommerce_wcva_disable_mobile_hover');
    }

    if (isset($shop_settings['woocommerce_enable_shop_slider'])) {
    	$woocommerce_enable_shop_slider  = $shop_settings['woocommerce_enable_shop_slider'];
    } else {
    	$woocommerce_enable_shop_slider  = get_option('woocommerce_enable_shop_slider');
    }


    if (isset($shop_settings['woocommerce_shop_slider_number'])) {
    	$woocommerce_shop_slider_number  = $shop_settings['woocommerce_shop_slider_number'];
    } else {
    	$woocommerce_shop_slider_number  = get_option('woocommerce_shop_slider_number');
    }

    $woocommerce_shop_slider_number = isset($woocommerce_shop_slider_number) ? $woocommerce_shop_slider_number : 4;

    if (isset($shop_settings['woocommerce_shop_swatches_display'])) {
    	$woocommerce_shop_swatches_display  = $shop_settings['woocommerce_shop_swatches_display'];
    } else {
    	$woocommerce_shop_swatches_display  = get_option('woocommerce_shop_swatches_display');
    }

    $woocommerce_shop_swatches_display = isset($woocommerce_shop_swatches_display) ? $woocommerce_shop_swatches_display : 01;

    if (isset($shop_settings['woocommerce_hover_imaga_size'])) {
    	$woocommerce_hover_imaga_size  = $shop_settings['woocommerce_hover_imaga_size'];
    } else {
    	$woocommerce_hover_imaga_size  = get_option('woocommerce_hover_imaga_size');
    }

    $woocommerce_hover_imaga_size = isset($woocommerce_hover_imaga_size) ? $woocommerce_hover_imaga_size : "shop_catalog";

    $include_texonomy = 'product';

    $include_texonomy = apply_filters('wcva_include_texonomy_list',$include_texonomy);

    $terms = get_object_taxonomies($include_texonomy);

        

    $tax_array = array();



    $exclude_texonomy = 'product_type,product_visibility,product_shipping_class';

    $exclude_texonomy = apply_filters('wcva_exclude_texonomy_list',$exclude_texonomy);

    if (isset($terms) && (!empty($terms))) {

    	foreach ($terms as $tkey=>$tvalue) {

    		if (!str_contains($exclude_texonomy, $tvalue) && (!wcva_startsWith($tvalue,"pa_"))) {
    			$tax_array[$tvalue] = $tvalue;
    		}

    	}
    }


    $default_texonomy = array(
    	'product_cat' => esc_html__( 'product_cat', 'wcva' ),
    	'product_tag' => esc_html__( 'product_tag', 'wcva' )
    );


    if (isset($shop_settings['woocommerce_wcva_custom_texonomies'])) {
    	$woocommerce_wcva_custom_texonomies  = $shop_settings['woocommerce_wcva_custom_texonomies'];
    } else {
    	$woocommerce_wcva_custom_texonomies  = (array) get_option('woocommerce_wcva_custom_texonomies');
    }

    

        $woocommerce_wcva_custom_texonomies = (isset($woocommerce_wcva_custom_texonomies) && (!empty($woocommerce_wcva_custom_texonomies)) && (sizeof($woocommerce_wcva_custom_texonomies) > 1)) ? $woocommerce_wcva_custom_texonomies : $default_texonomy;


    
    
    
?>
         
<table class="table">

	<tr>
		<td width="30%">
			<label><?php  echo esc_html__('Texonomy support for shop swatches','wcva'); ?></label> 
		</td>
		<td width="70%">
			<select multiple="multiple" class="woocommerce_wcva_custom_texonomies_input" name="<?php  echo esc_html__($this->wcva_shop_settings); ?>[woocommerce_wcva_custom_texonomies][]">
				<?php
				    foreach ($tax_array as $tkey=>$tvalue) { ?>
                        <option value="<?php echo $tkey; ?>" <?php if ( in_array( $tvalue ,$woocommerce_wcva_custom_texonomies ) ) { echo 'selected'; } ?>>
                         	<?php echo ucfirst($tvalue); ?>
                        </option>  
				    <?php }
				?>
			</select>
			<p><?php  echo esc_html__('Add your custom Texonomy here.By default product category and product tag pages are included.Shop swatches will work on chosen texonomies only.','wcva'); ?></p>
		</td>
	</tr>

	<tr>
		<td width="50%">
			<label><?php  echo esc_html__('Shop swatches height','wcva'); ?></label> 
		</td>
		<td width="50%">
			<input type="number" class="woocommerce_shop_swatch_height_input" name="<?php  echo esc_html__($this->wcva_shop_settings); ?>[woocommerce_shop_swatch_height]" value="<?php if (isset($woocommerce_shop_swatch_height) && ($woocommerce_shop_swatch_width != "")) { echo $woocommerce_shop_swatch_height; } else { echo 32; } ?>" >
			<span><?php  echo esc_html__('px','wcva'); ?></span>
		</td>
	</tr>

	<tr>
		<td width="50%">
			<label><?php  echo esc_html__('Shop swatches width','wcva'); ?></label> 
		</td>
		<td width="50%">
			<input type="number" class="woocommerce_shop_swatch_width_input" name="<?php  echo esc_html__($this->wcva_shop_settings); ?>[woocommerce_shop_swatch_width]" value="<?php if (isset($woocommerce_shop_swatch_width) && ($woocommerce_shop_swatch_width != "")) { echo $woocommerce_shop_swatch_width; } else { echo 32; } ?>" >
			<span><?php  echo esc_html__('px','wcva'); ?></span>
		</td>
	</tr>

	<tr>
		<td width="30%">
			<label><?php  echo esc_html__('Enable direct variation link','wcva'); ?></label> 
		</td>
		<td width="70%">
			<input type="hidden" class="woocommerce_shop_swatch_link_input" name="<?php  echo esc_html__($this->wcva_shop_settings); ?>[woocommerce_shop_swatch_link]" value="no">
			<input type="checkbox" class="woocommerce_shop_swatch_link_input" data-toggle="toggle" data-size="sm" name="<?php  echo esc_html__($this->wcva_shop_settings); ?>[woocommerce_shop_swatch_link]" value="yes" <?php if (isset($woocommerce_shop_swatch_link) && ($woocommerce_shop_swatch_link == "yes")) { echo 'checked'; } ?>>
		</td>
	</tr>

	<tr>
		<td width="30%">
			<label><?php  echo esc_html__('Replace hover with click on mobile devices','wcva'); ?></label> 
		</td>
		<td width="70%">
			<input type="hidden" class="woocommerce_wcva_disable_mobile_hover_input" name="<?php  echo esc_html__($this->wcva_shop_settings); ?>[woocommerce_wcva_disable_mobile_hover]" value="no">
			<input type="checkbox" class="woocommerce_wcva_disable_mobile_hover_input" data-toggle="toggle" data-size="sm" name="<?php  echo esc_html__($this->wcva_shop_settings); ?>[woocommerce_wcva_disable_mobile_hover]" value="yes" <?php if (isset($woocommerce_wcva_disable_mobile_hover) && ($woocommerce_wcva_disable_mobile_hover == "yes")) { echo 'checked'; } ?>>
		</td>
	</tr>

	<tr>
		<td width="30%">
			<label><?php  echo esc_html__('Enable shop swatches slider','wcva'); ?></label> 
		</td>
		<td width="70%">
			<input type="hidden" class="woocommerce_enable_shop_slider_input" name="<?php  echo esc_html__($this->wcva_shop_settings); ?>[woocommerce_enable_shop_slider]" value="no">
			<input type="checkbox" class="woocommerce_enable_shop_slider_input" data-toggle="toggle" data-size="sm" name="<?php  echo esc_html__($this->wcva_shop_settings); ?>[woocommerce_enable_shop_slider]" value="yes" <?php if (isset($woocommerce_enable_shop_slider) && ($woocommerce_enable_shop_slider == "yes")) { echo 'checked'; } ?>>
		</td>
	</tr>

	<tr style="<?php if (isset($woocommerce_enable_shop_slider) && ($woocommerce_enable_shop_slider == "no")) { echo 'display:none;'; } else { echo 'display:table-row;'; } ?>" >
		<td width="50%">
			<label>
				<?php  echo esc_html__('Number of swatches to show in shop slider','wcva'); ?>
			</label> 
		</td>
		<td width="50%">
			<input type="number" class="woocommerce_shop_slider_number_input" name="<?php  echo esc_html__($this->wcva_shop_settings); ?>[woocommerce_shop_slider_number]" value="<?php if (isset($woocommerce_shop_slider_number)) { echo $woocommerce_shop_slider_number; } ?>" >
		</td>
	</tr>


	<tr>
		<td width="30%">
			<label><?php  echo esc_html__('Shop swatches location','wcva'); ?></label> 
		</td>
		<td width="70%">
			<select class="woocommerce_shop_swatches_display_input" name="<?php  echo esc_html__($this->wcva_shop_settings); ?>[woocommerce_shop_swatches_display]">
				<option value="01" <?php if (isset($woocommerce_shop_swatches_display) && (($woocommerce_shop_swatches_display == 01))) { echo 'selected';}  ?>>
					<?php  echo esc_html__('After item title and price','wcva'); ?>						
				</option>
				<option value="02" <?php if (isset($woocommerce_shop_swatches_display) && (($woocommerce_shop_swatches_display == 02))) { echo 'selected';}  ?>>
					<?php  echo esc_html__('Before item title and price','wcva'); ?>
				</option>
				<option value="03" <?php if (isset($woocommerce_shop_swatches_display) && (($woocommerce_shop_swatches_display == 03))) { echo 'selected';}  ?>>
					<?php  echo esc_html__('After select options button','wcva'); ?>
				</option>
			</select>		
		</td>
	</tr>


	<tr>
		<td width="30%">
			<label><?php  echo esc_html__('Shop hover image size','wcva'); ?></label> 
		</td>
		<td width="70%">
			<select class="woocommerce_hover_imaga_size_input" name="<?php  echo esc_html__($this->wcva_shop_settings); ?>[woocommerce_hover_imaga_size]">
				<option value="shop_catalog" <?php if (isset($woocommerce_hover_imaga_size) && (($woocommerce_hover_imaga_size == "shop_catalog"))) { echo 'selected';}  ?>>
					<?php  echo esc_html__('Shop catalog size','wcva'); ?>						
				</option>
				<option value="thumbnail" <?php if (isset($woocommerce_hover_imaga_size) && (($woocommerce_hover_imaga_size == "thumbnail"))) { echo 'selected';}  ?>>
					<?php  echo esc_html__('Thumbnail size','wcva'); ?>
				</option>
				<option value="medium" <?php if (isset($woocommerce_hover_imaga_size) && (($woocommerce_hover_imaga_size == "medium"))) { echo 'selected';}  ?>>
					<?php  echo esc_html__('Medium Size','wcva'); ?>
				</option>
				<option value="large" <?php if (isset($woocommerce_hover_imaga_size) && (($woocommerce_hover_imaga_size == "large"))) { echo 'selected';}  ?>>
					<?php  echo esc_html__('Full Size','wcva'); ?>
				</option>
			</select>
			<p><?php  echo esc_html__('This controls size of hover image on shop/category/archive pages.','wcva'); ?></p>
		</td>
	</tr>

</table>