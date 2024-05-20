	<?php
	    $attribute_taxonomies = wc_get_attribute_taxonomies();
	   

	    $global_settings      =   (array) get_option( 'wcva_global_settings' ); 

        if (isset($global_settings['wcva_woocommerce_global_activation'])) {
    	    $global_activation = $global_settings['wcva_woocommerce_global_activation'];
        } else {
    	    $global_activation = get_option('wcva_woocommerce_global_activation');
        }

        if (isset($global_settings['values'])) {
        	$wcva_global_values = $global_settings['values'];
        } else {
        	$wcva_global_values = get_option('wcva_global');
        }
	   
	    
	    


	?>
	<tr valign="top" style="<?php if (isset($global_activation) && ($global_activation == "yes")) { echo 'display:;'; } else {echo 'display:none;';} ?>">
		
		<td width="30%">
			<label><?php  echo esc_html__('Default attribute options','wcva'); ?></label>
		</td>
		<td width="70%" class="forminp">
			<table class="widefat wp-list-table" cellspacing="0">
				<thead>
					<tr>
						<th width="15%" class="name">&emsp;<?php echo esc_html__( 'Attribute', 'wcva' ); ?></th>
						<th>&emsp;<?php echo esc_html__( 'Display Type', 'wcva' ); ?></th>
						<th width="40%">&emsp;<?php echo esc_html__( 'Size', 'wcva' ); ?></th>
						<th>&emsp;<?php echo esc_html__( 'Show Name', 'wcva' ); ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php if ((!empty($attribute_taxonomies)) && (sizeof($attribute_taxonomies) >0)) : ?>
					<?php foreach ($attribute_taxonomies as $value) : ?>
						<?php $value           = json_decode(json_encode($value), True); ?>
						<?php $attribute_name  = $value['attribute_name']; ?>
						<?php $global_attribute_name  = 'pa_'.$value['attribute_name'].''; ?>
						<tr>
							<td width="15%" class="name">&emsp;
								<span class="name"><?php echo $attribute_name; ?></span>
							</td>
							<td class="status">
								<select name="wcva_global_settings[values][pa_<?php echo $attribute_name; ?>][display_type]">
									<option value="none"><span class="wcvaformfield"><?php echo esc_html__('Dropdown Select','wcva'); ?></span></option>
									<option value="colororimage" <?php if ((isset($wcva_global_values[$global_attribute_name]['display_type'])) && ($wcva_global_values[$global_attribute_name]['display_type'] == "colororimage")) {echo "selected";} ?>><span class="wcvaformfield"><?php echo esc_html__('Color or Image','wcva'); ?></span></option>
									<?php echo apply_filters('wcva_global_attribute_display_type', $global_attribute_name ); ?>
								</select>
							</td>
							<td width="40%">
								<select name="wcva_global_settings[values][pa_<?php echo $attribute_name; ?>][size]">
									<option value="small"  <?php if ((isset($wcva_global_values[$global_attribute_name]['size'])) && ($wcva_global_values[$global_attribute_name]['size'] == "small")) {echo "selected";} ?>><span class="wcvaformfield"><?php echo esc_html__('Small (32px * 32px)','wcva'); ?></span></option>

									<option value="extrasmall" <?php if ((isset($wcva_global_values[$global_attribute_name]['size'])) && ($wcva_global_values[$global_attribute_name]['size'] == "extrasmall")) {echo "selected";} ?>><span class="wcvaformfield"><?php echo esc_html__('Extra Small (22px * 22px)','wcva'); ?></span></option>

									<option value="medium" <?php if ((isset($wcva_global_values[$global_attribute_name]['size'])) && ($wcva_global_values[$global_attribute_name]['size'] == "medium")) {echo "selected";} ?>><span class="wcvaformfield"><?php echo esc_html__('Middle (40px * 40px)','wcva'); ?></span></option>

									<option value="big" <?php if ((isset($wcva_global_values[$global_attribute_name]['size'])) && ($wcva_global_values[$global_attribute_name]['size'] == "big")) {echo "selected";} ?>><span class="wcvaformfield"><?php echo esc_html__('Big (60px * 60px)','wcva'); ?></span></option>

									<option value="extrabig" <?php if ((isset($wcva_global_values[$global_attribute_name]['size'])) && ($wcva_global_values[$global_attribute_name]['size'] == "extrabig")) {echo "selected";} ?>><span class="wcvaformfield"><?php echo esc_html__('Extra Big (90px * 90px)','wcva'); ?></span></option>

									<option value="custom" <?php if ((isset($wcva_global_values[$global_attribute_name]['size'])) && ($wcva_global_values[$global_attribute_name]['size'] == "custom")) {echo "selected";} ?>><span class="wcvaformfield"><?php echo esc_html__('Custom','wcva'); ?></span></option>
									<?php echo apply_filters('wcva_global_attribute_display_size', $global_attribute_name ); ?>
								</select>
								<select name="wcva_global_settings[values][pa_<?php echo $attribute_name; ?>][displaytype]">

									<option value="square" <?php if ((isset($wcva_global_values[$global_attribute_name]['displaytype'])) && ($wcva_global_values[$global_attribute_name]['displaytype'] == "square")) {echo "selected";} ?>><span class="wcvaformfield"><?php echo esc_html__('Square','wcva'); ?></span></option>

									<option value="round" <?php if ((isset($wcva_global_values[$global_attribute_name]['displaytype'])) && ($wcva_global_values[$global_attribute_name]['displaytype'] == "round")) {echo "selected";} ?>><span class="wcvaformfield"><?php echo esc_html__('Round','wcva'); ?></span></option>

									<?php echo apply_filters('wcva_global_attribute_display_displaytype', $global_attribute_name ); ?>
								</select>
							</td>
							<td>
								<select name="wcva_global_settings[values][pa_<?php echo $attribute_name; ?>][show_name]" class="wcvadisplaytype">
									<option value="no" <?php if ((isset($wcva_global_values[$global_attribute_name]['show_name'])) && ($wcva_global_values[$global_attribute_name]['show_name'] == "no")) {echo "selected";} ?>><span class="wcvaformfield"><?php echo esc_html__('No','wcva'); ?></span></option>
									<option value="yes" <?php if ((isset($wcva_global_values[$global_attribute_name]['show_name'])) && ($wcva_global_values[$global_attribute_name]['show_name'] == "yes")) {echo "selected";} ?>><span class="wcvaformfield"><?php echo esc_html__('Yes','wcva'); ?></span></option>
								</select>
							</td>
							<td>
								<a target="_blank" href="edit-tags.php?taxonomy=<?php echo wc_attribute_taxonomy_name($attribute_name); ?>&amp;post_type=product" class="button alignright configure-terms"><?php echo esc_html__('Set color/images','wcva'); ?></a>
							</td>

						</tr>
					<?php endforeach; ?>
				<?php endif;?>
			</tbody>

		</table>
	</td>
</tr>