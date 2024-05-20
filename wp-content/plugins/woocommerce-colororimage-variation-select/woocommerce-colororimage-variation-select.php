<?php
/*
  Plugin Name: WooCommerce Color or Image Variation Swatches
  Plugin URI: https://www.sysbasics.com
  Description: Convert Your existing woocommerce product dropdown select into nicely looking color/image/text swatches and also replace product image on swatch hover on shop page.
  Version: 3.9.26
  Author: sysbasics
  Author URI: https://www.sysbasics.com
  Requires at least: 3.3
  Tested up to: 6.4.1
  WC requires at least: 3.0.0
  WC tested up to: 8.2.2
  Text Domain: wcva
  Domain Path: /languages
  
*/
    /**
     * Global Variable wcva_PLUGIN_URL
     */
    if( !defined( 'wcva_PLUGIN_URL' ) )
          define( 'wcva_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	  
    /**
     * Global Variable wcva_base_url
     */
    if( !defined( 'wcva_base_url' ) )
          define( 'wcva_base_url', plugin_basename(__FILE__) );

    if( !defined( 'wcva_PLUGIN_URL' ) )
        define( 'wcva_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

    if( !defined( 'wcva_PLUGIN_name' ) )
        define( 'wcva_PLUGIN_name', esc_html__( 'WooSwatches' ,'wcva') );


    if( !defined( 'wcva_plugin_slug' ) )
        define( 'wcva_plugin_slug', 'wcva' );

    add_action( 'before_woocommerce_init', function() {
    	if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
    		\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    	}
    } );
	  
	
	/*
	 * localization
	 */
    load_plugin_textdomain( 'wcva', false, basename( dirname(__FILE__) ).'/languages' );


    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    
	/**
	 * Check if quick view plugin is enabled
	 */
   	if (is_plugin_active( 'yith-woocommerce-quick-view/init.php' ) ) {
	   
	   define( 'wcva_quick_view_mode', 'on' );
	
	} else {
		
	   define( 'wcva_quick_view_mode', 'off' );
	   
	}
	
   /**
    * check weather woocommerce is active or not
    */

    if (is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
 
          
        require 'includes/class_create_variations_metabox.php';
		require 'includes/class_override_woocommerce_variable_tamplate.php';
		require 'includes/class_wcva_register_scripts_styles.php';
		require 'includes/class_attribute_global_values.php';
		require 'includes/class_shop_page_swatchs.php';
		require 'includes/wcva_common_functions.php';
		require 'includes/wcva_swatch_form_fields.php';
		require 'includes/wcva_direct_variation_link.php';
		require 'includes/wcva_add_layered_navigation_widget.php';
		require 'includes/admin/admin_settings.php';
		require 'lib/sysbasics/plugin-deactivation-survey/deactivate-feedback-form.php';
		  
 
    } else {
    
    /**
	 * Display Notice if woocommerce is not installed
	 */
     
        function wcva_installation_notice() {
         echo '<div class="updated" style="padding:15px; position:relative;"><a href="http://wordpress.org/plugins/woocommerce/">'.esc_html__('Woocommerce','wcva').'</a>  must be installed and activated before using this plugin. </div>';
        }

        add_action('admin_notices', 'wcva_installation_notice');
        
        return;

    }
	
	

	 
    /*
	 * Gets absolute path for plugin
	 */
    function wcva_plugin_path() {
  
       return untrailingslashit( plugin_dir_path( __FILE__ ) );
    }
    
	/*
	 * Get woocommerce version 
	 */
	function wcva_get_woo_version_number() {
       
	   if ( ! function_exists( 'get_plugins' ) )
		 require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
       
	   $plugin_folder = get_plugins( '/' . 'woocommerce' );
	   $plugin_file = 'woocommerce.php';
	
	
	   if ( isset( $plugin_folder[$plugin_file]['Version'] ) ) {
		  return $plugin_folder[$plugin_file]['Version'];

	   } else {
	
		return NULL;
	   }
    }
	



add_filter('sysbasics_deactivate_feedback_form_plugins', function($plugins) {

    $plugins[] = (object)array(
        'slug'      => wcva_plugin_slug,
        'version'   => wcva_get_plugin_version_number()
    );

    return $plugins;

});




/**
 * Get woocommerce version 
 */

if (!function_exists('wcva_get_plugin_version_number')) {

    function wcva_get_plugin_version_number() {
       
       if ( ! function_exists( 'get_plugins' ) )
         require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    
       
       $plugin_folder = get_plugins( '/' . ''.wcva_plugin_slug.'' );
       $plugin_file = ''.wcva_plugin_slug.'.php';
    
    
       if ( isset( $plugin_folder[$plugin_file]['Version'] ) ) {
          return $plugin_folder[$plugin_file]['Version'];

       } else {
    
        return NULL;
       }
    }
}


require 'libupdate/libupdate.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://www.sysbasics.com/updates2/?action=get_metadata&slug=woocommerce-colororimage-variation-select',
    __FILE__, //Full path to the main plugin file or functions.php.
    'woocommerce-colororimage-variation-select',
    48
);




$myUpdateChecker->addFilter('pre_inject_update', function($metadata) { 

    $wcva_install_e = get_option('wcva_install_e');

    

    if (isset($wcva_install_e) && ($wcva_install_e == "64")) {

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


        
        $metadata->download_url = 'https://www.sysbasics.com/updates2/?action=download&slug=woocommerce-colororimage-variation-select&domain='.$domain_name.'&code='.$license_key.'&siteurl='.$siteurl.'';

        

        return $metadata;
    } else {
        $metadata->download_url = '';
        return $metadata; 
    }


    return $metadata; 

}
);


/**
 * Add settings links
 */
add_filter( 'plugin_action_links_' . wcva_base_url , 'wcva_add_action_links' );

function wcva_add_action_links ( $links ) {
	$mylinks = array(
		'<a target="_blank" href="' . admin_url( '/admin.php?page=wcva_product_settings' ) . '">'.esc_html__( 'Settings ', 'wcva' ).'</a>'
		
	);
	return array_merge( $links, $mylinks );
}

 
function wcva_plugin_row_meta( $links, $file ) {    
    if ( plugin_basename( __FILE__ ) == $file ) {
        $row_meta = array(
          'docs'    => '<a href="' . esc_url( 'https://woomatrix.com/knowledge-base/category/woocommerce-color-or-image-variation-swatches/' ) . '" target="_blank" aria-label="' . esc_html__( 'Docs', 'wcva' ) . '" style="color:green;">' . esc_html__( 'Docs', 'wcva' ) . '</a>',
          'support'    => '<a href="' . esc_url( 'https://woomatrix.com/support/' ) . '" target="_blank" aria-label="' . esc_html__( 'Support', 'wcva' ) . '" style="color:green;">' . esc_html__( 'Support', 'wcva' ) . '</a>'
        );

 
        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}

add_filter( 'plugin_row_meta', 'wcva_plugin_row_meta', 10, 2 );

?>