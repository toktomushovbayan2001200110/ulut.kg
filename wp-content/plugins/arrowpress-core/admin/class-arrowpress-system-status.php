<?php

/**
 * Class Arrowpress_System_Status.
 *
 * @since 0.8.5
 */
class Arrowpress_System_Status extends Arrowpress_Admin_Sub_Page {
	/**
	 * @var string
	 *
	 * @since 0.8.5
	 */
	public $key_page = 'system-status';

	/**
	 * @var array
	 *
	 * @since 1.2.0
	 */
	public static $environments = null;

	/**
	 * Arrowpress_System_Status constructor.
	 *
	 * @since 0.8.5
	 */
	protected function __construct() {
		parent::__construct();

		$this->hooks();
	}

	/**
	 * Add hooks.
	 *
	 * @since 1.2.0
	 */
	private function hooks() {
		add_filter( 'arrowpress_dashboard_sub_pages', array( $this, 'add_sub_page' ) );
 		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Add sub page.
	 *
	 * @since 0.8.5
	 * @since 1.7.9
	 *
	 *
	 * @param $sub_pages
	 *
	 * @return mixed
	 */
	public function add_sub_page( $sub_pages ) {
		if ( Arrowpress_Envato_Hosted::is_envato_hosted_site() ) {
			return $sub_pages;
		}

		if ( ! current_user_can( 'administrator' ) ) {
			return $sub_pages;
		}

		$sub_pages['system-status'] = array(
			'title' => __( 'System Status', 'arrowpress-core' ),
		);

		return $sub_pages;
	}

	/**
	 * Get arguments for template.
	 *
	 * @since 0.8.5
	 *
	 * @return null
	 */
	protected function get_template_args() {
		$args              = self::get_environment_info();
		$args['draw_text'] = self::get_draw_system_status();

		return $args;
	}

	/**
	 * Get array of environment information.
	 *
	 * @since 1.1.1
	 *
	 * @return array
	 */
	public static function get_environment_info() {
		if ( self::$environments === null ) {
			global $wpdb;
			$info = array();

			//Site
			$info['home_url']     = get_home_url();
			$info['site_url']     = get_site_url();
			$info['wp_version']   = get_bloginfo( 'version' );
			$info['is_multisite'] = is_multisite();
			$info['language']     = get_locale();

			//Theme
			$theme_data            = Arrowpress_Theme_Manager::get_metadata();
			$info['theme_name']    = $theme_data['name'];
			$info['theme_version'] = $theme_data['version'];
			$info['theme_slug']    = $theme_data['stylesheet'];

			$info['server_info'] = $_SERVER['SERVER_SOFTWARE'];
			$info['php_version'] = phpversion();

			// Figure out cURL version, if installed.
			$curl_version = '';
			if ( function_exists( 'curl_version' ) ) {
				$curl_version = curl_version();
				$curl_version = $curl_version['version'] . ', ' . $curl_version['ssl_version'];
			}
			$info['curl_version'] = $curl_version;

			// WP memory limit
			$wp_memory_limit = arrowpress_core_let_to_num( WP_MEMORY_LIMIT );
			if ( function_exists( 'memory_get_usage' ) ) {
				$wp_memory_limit = max( $wp_memory_limit, arrowpress_core_let_to_num( ini_get( 'memory_limit' ) ) );
			}
			$info['memory_limit']      = $wp_memory_limit;
			$info['memory_limit_text'] = size_format( $info['memory_limit'] );

			// Max excution time.
			$info['max_execution_time'] = ini_get( 'max_execution_time' );

			$info['post_max_size']      = arrowpress_core_let_to_num( ini_get( 'post_max_size' ) );
			$info['post_max_size_text'] = size_format( $info['post_max_size'] );

			$info['mysql_version'] = ! empty( $wpdb->is_mysql ) ? $wpdb->db_version() : '';

			$info['max_upload_size']      = wp_max_upload_size();
			$info['max_upload_size_text'] = size_format( $info['max_upload_size'] );

			// Test GET requests
			$response = arrowpress_core_test_request( 'https://api.envato.com' );
			if ( $response['return'] ) {
				$response = arrowpress_core_test_request( Arrowpress_Admin_Config::get( 'host_downloads' ) . '/ping/' );

				if ( $response['return'] ) {
					$response = arrowpress_core_test_request( Arrowpress_Admin_Config::get( 'api_check_self_update' ) );
				}
			}
			$info['remote_get_test_url']   = $response['url'];
			$info['remote_get_successful'] = $response['return'];
			$info['remote_get_response']   = $response['message'];

			// dom extension
			$info['dom_extension'] = extension_loaded( 'dom' );

			self::$environments = $info;
		}

		return self::$environments;
	}

	/**
	 * Get system status draw text.
	 *
	 * @since 1.2.0
	 *
	 * @return string
	 */
	public static function get_draw_system_status() {
		$environments = self::get_environment_info();
		$text         = "`\n";
		foreach ( $environments as $key => $environment ) {
			if ( is_string( $environment ) ) {
				$str = $environment;
			} else {
				$str = wp_json_encode( $environment );
			}
			$text .= $key . ' : ' . $str . "\n";
		}
		$text .= '`';

		return $text;
	}

	/**
	 * Enqueue script.
	 *
	 * @since 1.2.0
	 */
	public function enqueue_scripts() {
		if ( ! $this->is_myself() ) {
			return;
		}

		wp_enqueue_script( 'arrowpress-developer-access' );
		wp_enqueue_script( 'arrowpress-core-system-status', ARROWPRESS_CORE_ADMIN_URI . '/assets/js/system-status.js', array(
			'jquery',
			'arrowpress-core-clipboard'
		), ARROWPRESS_CORE_VERSION );
	}
}
