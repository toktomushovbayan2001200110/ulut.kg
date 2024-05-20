<?php

/**
 * Class Arrowpress_Self_Update
 *
 * @since 1.0.4
 */
class Arrowpress_Self_Update extends Arrowpress_Singleton {
	/**
	 * @since 1.0.4
	 *
	 * @var string
	 */
	private $slug = 'arrowpress-core';

	/**
	 * @since 1.0.4
	 *
	 * @var string
	 */
	private $plugin = 'arrowpress-core/arrowpress-core.php';

	/**
	 * @var string
	 *
	 * @since 1.0.5
	 */
	private $url_changelog = 'https://arrowtheme.github.io/arrowpress-core/changelog.html';

	/**
	 * Arrowpress_Self_Update constructor.
	 *
	 * @since 1.0.4
	 */
	protected function __construct() {
		$this->init_hooks();
	}

	/**
	 * Init hooks.
	 *
	 * @since 1.0.4
	 */
	private function init_hooks() {
		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'inject_update_plugins' ) );
		add_filter( 'pre_set_transient_update_plugins', array( $this, 'inject_update_plugins' ) );
		add_filter( 'http_request_args', array( $this, 'exclude_check_update_from_wp_org' ), 5, 2 );
		add_filter( 'plugins_api', array( $this, 'filter_plugin_information' ), 10, 3 );
		add_filter( 'arrowpress_core_list_plugins_required', array( $this, 'add_arrowpress_core_plugin' ) );
	}

	/**
	 * Add ArrowPress Core package to list plugins.
	 *
	 * @param $plugins
	 *
	 * @return array
	 * @since 1.0.0
	 *
	 */
	public function add_arrowpress_core_plugin( $plugins ) {
		$plugins[] = array(
			'name'               => 'ArrowPress Core',
			'slug'               => 'arrowpress-core',
			'icon'               => 'https://arrowtheme.github.io/demo-data/icon-plugins/logo.png', 
			'premium'            => true,
			'silent'             => true,
			'disable_deactivate' => true,
		);

		return $plugins;
	}

	/**
	 * Add filter plugin information.
	 *
	 * @param $false
	 * @param $action
	 * @param $args
	 *
	 * @return stdClass
	 * @since 0.8.5
	 *
	 */
	public function filter_plugin_information( $false, $action, $args ) {
		if ( $action != 'plugin_information' ) {
			return $false;
		}

		if ( isset( $args->slug ) && $args->slug === $this->slug ) {
			$information = new stdClass();

			$data = $this->get_plugin_information_remote();

			$information->name                    = __( 'ArrowPress Core by ArrowTheme', 'arrowpress-core' );
			$information->slug                    = $data['slug'];
			$information->author                  = $data['author'];
			$information->version                 = $data['version'];
			$information->requires                = $data['requires'];
			$information->sections['description'] = $data['short_description'];
			$information->sections['changelog']   = $this->get_changelog();
			$information->homepage                = $data['homepage'];
			$information->banners                 = (array) $data['banners'];

			return $information;
		}

		return $false;
	}

	/**
	 * Get content changelog from github.
	 *
	 * @return string
	 * @since 1.0.5
	 *
	 */
	private function get_changelog() {
		$response = wp_remote_get( $this->url_changelog );

		$code = wp_remote_retrieve_response_code( $response );

		if ( $code != 200 ) {
			return __( 'Sorry! Something went wrong. Changelog could not be loaded.', 'arrowpress-core' );
		}

		return wp_remote_retrieve_body( $response );
	}

	/**
	 * Exclude check plugin update from wp.org.
	 *
	 * @param $request
	 * @param $url
	 *
	 * @return mixed
	 * @since 1.0.4
	 *
	 */
	public function exclude_check_update_from_wp_org( $request, $url ) {
		if ( false === strpos( $url, '//api.wordpress.org/plugins/update-check' ) ) {
			return $request;
		}

		$data   = json_decode( $request['body']['plugins'] );
		$plugin = $this->plugin;

		if ( isset( $data->plugins->$plugin ) ) {
			unset( $data->plugins->$plugin );
		}

		$request['body']['plugins'] = wp_json_encode( $data );

		return $request;
	}

	/**
	 * Get check update plugin ArrowPress Core (from GitHub.io).
	 *
	 * @return array|bool
	 * @since 1.0.4
	 *
	 */
	private function get_data_check_update_plugin() {
		$api_url  = Arrowpress_Admin_Config::get( 'api_check_self_update' );
		$response = wp_remote_get( $api_url );

		if ( is_wp_error( $response ) ) {
			return false;
		}

		$body   = wp_remote_retrieve_body( $response );
		$object = json_decode( $body );
		$arr    = (array) $object;

		return ! empty( $arr ) ? $arr : false;
	}

	/**
	 * Get information plugin ArrowPress Core.
	 *
	 * @return array|bool
	 * @since 1.0.4
	 *
	 */
	private function get_plugin_information_remote() {
		$data        = get_site_transient( 'arrowpress_core_check_self_update' );
		$force_check = ! empty( $_GET['force-check'] );

		if ( empty( $data ) || $force_check ) {
			$data = $this->get_data_check_update_plugin();
			set_site_transient( 'arrowpress_core_check_self_update', $data, 600 );
		}

		$data = wp_parse_args(
			$data, array(
				'slug'              => $this->slug,
				'homepage'          => '',
				'author'            => '',
				'download_link'     => false,
				'tested'            => '4.7',
				'requires'          => '4.6',
				'version'           => false,
				'short_description' => '',
				'rating'            => 0,
				'num_ratings'       => 0,
				'banners'           => '',
			)
		);

		return $data;
	}

	/**
	 * Get current version.
	 *
	 * @return string|bool
	 * @since 1.0.4
	 *
	 */
	private function get_current_version() {
		return defined( 'ARROWPRESS_CORE_VERSION' ) ? ARROWPRESS_CORE_VERSION : false;
	}

	/**
	 * Check can update.
	 *
	 * @param $current_version
	 * @param $latest_version
	 *
	 * @return bool
	 * @since 1.0.4
	 *
	 */
	private function can_update( $current_version, $latest_version ) {
		if ( ! $current_version || ! $latest_version ) {
			return false;
		}

		return version_compare( $latest_version, $current_version, '>' );
	}

	/**
	 * Add filter update plugins.
	 *
	 * @param $value
	 *
	 * @return mixed
	 * @since 1.0.0
	 *
	 */
	public function inject_update_plugins( $value ) {
		if ( ! $this->is_support() ) {
			return $value;
		}

		$data            = $this->get_plugin_information_remote();
		$latest_version  = $data['version'];
		$current_version = $this->get_current_version();
		if ( ! $this->can_update( $current_version, $latest_version ) ) {
			return $value;
		}

		if ( ! $data['download_link'] ) {
			return $value;
		}

		$object              = new stdClass();
		$object->slug        = $this->slug;
		$object->plugin      = $this->plugin;
		$object->new_version = $latest_version;
		$object->url         = $data['homepage'];
		$object->package     = $data['download_link'];
		$object->tested      = $data['tested'];

		$value->response[$this->plugin] = $object;

		return $value;
	}

	/**
	 * Is support self update.
	 *
	 * @return mixed
	 * @since 1.0.4
	 *
	 */
	private function is_support() {
		return ( version_compare( ARROWPRESS_CORE_VERSION, '1.0.3', '>' ) );
	}
}
