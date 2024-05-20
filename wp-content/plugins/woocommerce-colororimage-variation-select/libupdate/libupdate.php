<?php
/**
 * Plugin Update Checker Library 5.3
 * http://w-shadow.com/
 *
 * Copyright 2022 Janis Elsts
 * Released under the MIT license. See license.txt for details.
 */

require dirname(__FILE__) . '/load-v5p3.php';

$wcva_act_date = get_option('wcva_act_date');

$wcva_install_e = get_option('wcva_install_e');


$date_today = date("Ymd");

if (!isset($wcva_act_date) || ($wcva_act_date == "")) {
	update_option('wcva_act_date',$date_today);
}

if (!isset($wcva_install_e) || ($wcva_install_e == "")) {
	update_option('wcva_install_e','32');
}

$wcva_check_done_one = get_option('wcva_check_done_one','no');

if ($wcva_check_done_one == "no") {
	$wcva_license_settings    = (array) get_option('wcva_license_settings');

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


	$domain_name = preg_replace('/^www\./', '', $urlParts['host']);


	$siteurl = wcva_get_siteurl();



	$json_url = 'https://www.sysbasics.com/wp-json/wp/v2/check-validation?domain='.$domain_name.'&code='.$license_key.'&tid=7444039&siteurl='. $siteurl.'&act='.$wcva_act_date.'';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $json_url);
	$result = curl_exec($ch);
	curl_close($ch);

	update_option('wcva_check_done_one','yes');
}