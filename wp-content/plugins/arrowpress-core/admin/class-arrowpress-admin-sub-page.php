<?php

/**
 * Class Arrowpress_Admin_Sub_Page
 *
 * @since 0.8.5
 */
abstract class Arrowpress_Admin_Sub_Page extends Arrowpress_Singleton {
	/**
	 * Get template in dashboard.
	 *
	 * @since 0.8.5
	 *
	 * @param $template
	 * @param null $args
	 *
	 * @return bool
	 */
	public static function get_template( $template, $args = null ) {
		return Arrowpress_Dashboard::get_template( $template, $args );
	}

	/**
	 * @var null
	 *
	 * @since 0.8.5
	 */
	public $key_page = null;

	/**
	 * @return bool
	 *
	 * @since 0.8.5
	 */
	protected function is_myself() {
		return $this->is_page( $this->key_page );
	}

	/**
	 * Get link page myself.
	 *
	 * @since 0.8.9
	 *
	 * @return string
	 */
	protected function get_link_myself() {
		return Arrowpress_Dashboard::get_link_page_by_slug( $this->key_page );
	}

	/**
	 * Is page?
	 *
	 * @since 0.8.5
	 *
	 * @param $key_page
	 *
	 * @return bool
	 */
	protected function is_page( $key_page ) {
		$current_page = Arrowpress_Dashboard::get_current_page_key();

		if ( $current_page == $key_page ) {
			return true;
		}

		return false;
	}

	/**
	 * Arrowpress_Admin_Sub_Page constructor.
	 *
	 * @since 0.8.5
	 */
	protected function __construct() {
		if ( is_null( $this->key_page ) ) {
			wp_die( __( 'variable <strong>key_page</strong> must be over-ridden in a sub-class.', 'arrowpress-core' ) );
		}

		$this->hooks();
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 0.8.5
	 */
	private function hooks() {
		add_action( "arrowpress_dashboard_main_page_$this->key_page", array( $this, 'main_template' ) );
	}

	/**
	 * Main template for this page.
	 *
	 * @since 0.8.5
	 */
	public function main_template() {
		$file_template = "$this->key_page.php";

		self::get_template( $file_template, $this->get_template_args() );
	}

	/**
	 * Get arguments for template.
	 *
	 * @since 0.8.5
	 *
	 * @return null
	 */
	protected function get_template_args() {
		return null;
	}
}