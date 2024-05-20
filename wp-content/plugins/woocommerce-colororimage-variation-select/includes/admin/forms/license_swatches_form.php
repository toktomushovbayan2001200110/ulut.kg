<?php 
$wcva_license_settings    = (array) get_option('wcva_license_settings');
$licensing_url               = 'https://api.envato.com/authorization?response_type=code&client_id=sysbasics-license-activation-jvykxxug&redirect_uri=https://www.sysbasics.com/verify-purchase/';
?> 

<table class="widefat wcva_options_table">

	

	<tr>
		<td><label><?php echo esc_html__('Domain Validation Token','wcva'); ?></label>
		</td>
		<td>
			<input type="text" class="wcva_license_key_input" data-toggle="toggle" data-size="xs" name="wcva_license_settings[license_key]" value="<?php if (isset($wcva_license_settings['license_key']) ) { echo $wcva_license_settings['license_key']; } ?>" size="80">


			<?php

			$license_key = '';

			if (isset($wcva_license_settings['license_key']) ) { 
				$license_key=$wcva_license_settings['license_key']; 
			}
            

			
            
			
            $input = $_SERVER['SERVER_NAME'];

   
			$input = trim($input, '/');


			if (!preg_match('#^http(s)?://#', $input)) {
				$input = 'http://' . $input;
			}

			$urlParts = parse_url($input);

			$match_found = 'no';
			$domain_status = 'inactive';


			$domain_name = preg_replace('/^www\./', '', $urlParts['host']);

			echo '<table class="widefat sysbasics-license-table">';

			

                  echo '<tr><td>'.esc_html__('Domain','wcva').'</td><td>'.$domain_name.'</td></tr>';

                  if (!isset($license_key) || ($license_key == "")) {
                  	echo '<tr><td>'.esc_html__('Activate your token to enable auto updates.Please remember that envato item purchase code is different from domain validation token.','wcva').'</td></tr>';
                  }

			$siteurl = wcva_get_siteurl();

			

			$json_url = 'https://www.sysbasics.com/wp-json/wp/v2/check-validation?domain='.$domain_name.'&code='.$license_key.'&tid=7444039&siteurl='. $siteurl.'';

			

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $json_url);
			$result = curl_exec($ch);
			curl_close($ch);

			$obj = json_decode($result);
			$match_found = $obj->match_found;

			

			if (isset($match_found) && ($match_found == "yes")) {

				$detected_domain = $obj->domain;

				$item_id = $obj->item_id;

				if (($detected_domain == $domain_name) && ($item_id == 7444039)) {

					$supported_until = $obj->supported_until;



					$supported_until = date("d M Y",strtotime($supported_until));

					echo '<tr><td>'.esc_html__('Status','wcva').'</td><td>Active</td></tr>';

					echo '<tr><td>'.esc_html__('Support Expiry','wcva').'</td><td>'.$supported_until.'</td></tr>';

					update_option('wcva_install_e','64');
				}

			} else {
				$reason = $obj->reason;

				update_option('wcva_install_e','32');

				echo '<tr><td>'.esc_html__('Error','wcva').'</td><td>'.$reason.'</td></tr>';

				echo '<tr><td>'.esc_html__('Status','wcva').'</td><td>Inactive</td></tr>';
			}







             
             echo '</table>';
			

  




			?>

			<a target="_blank" href="#" data-toggle="modal" data-target="#sysbasics_get_validation_tkn" class="sysbasics-token-page btn btn-warning"> 
				<span class="dashicons dashicons-admin-network sysbasics-manage-token"></span>              
				<?php 

				if ($domain_status == "active") {
					echo esc_html__('Manage Tokens','wcva');
				} else {
					echo esc_html__('Get Validation Token','wcva');
				}
				?>
				
			</a>
	
			
		</td>
	</tr>

</table>
<div class="modal fade" id="sysbasics_get_validation_tkn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-body">

				<p class="sysbasics_purchased_through"><?php echo esc_html__( 'Purchased from' ,'customize-my-account-for-woocommerce-pro'); ?></p>

				

				<a type="button" target="_blank" href="https://www.sysbasics.com/my-account/orders" name="submit" id="wcmamtx_frontend_link" class="btn btn-success wcmamtx_frontend_link" >
					<span class="dashicons dashicons-lock"></span>
					<?php echo esc_html__( 'SYSBASICS.com' ,'customize-my-account-for-woocommerce-pro'); ?>
				</a>
                
                <a type="button" target="_blank" href="<?php echo $licensing_url; ?>" name="submit" id="wcmamtx_frontend_link" class="btn btn-primary wcmamtx_frontend_link" >
					<span class="dashicons dashicons-lock"></span>
					<?php echo esc_html__( 'Envato Market (CodeCanyon)' ,'customize-my-account-for-woocommerce-pro'); ?>
				</a>


			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>