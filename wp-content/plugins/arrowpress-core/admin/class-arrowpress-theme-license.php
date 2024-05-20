<?php
class Arrowpress_Theme_License extends Arrowpress_Admin_Sub_Page {

	public $key_page = 'license';

	protected function __construct() {
		parent::__construct();

		add_filter( 'arrowpress_dashboard_sub_pages', array( $this, 'add_sub_page' ) );
		add_action( 'rest_api_init', array( $this, 'rest_router' ) );
	}

	public function rest_router( $request ) {
		$namespace = 'arrowpress/v1';
		$base      = 'license';

		register_rest_route(
			$namespace,
			'/' . $base . '/activate',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'activate' ),
				'permission_callback' => function() {
					return current_user_can( 'administrator' );
				},
			)
		);
		register_rest_route(
			$namespace,
			'/' . $base . '/update-personal',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'update_personal' ),
				'permission_callback' => function() {
					return current_user_can( 'administrator' );
				},
			)
		);
		register_rest_route(
			$namespace,
			'/' . $base . '/deactivate',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'deactivate' ),
				'permission_callback' => function() {
					return current_user_can( 'administrator' );
				},
			)
		);
	}

	public function activate( $request ) {
		$purchase_code = $request['purchase_code'] ? sanitize_text_field( $request['purchase_code'] ) : '';
		$personal_token = $request['personal_token'] ? sanitize_text_field( $request['personal_token'] ) : '';
		$domain        = $request['domain'] ? esc_url_raw( $request['domain'] ) : '';
		$theme         = $request['theme'] ? sanitize_text_field( $request['theme'] ) : '';
		$theme_version = $request['theme_version'] ? sanitize_text_field( $request['theme_version'] ) : '';
		$user_email    = $request['user_email'] ? sanitize_email( $request['user_email'] ) : '';
		
		try {
			// Call API to server.
			if ( empty( $purchase_code ) ) {
				throw new \Exception( 'Purchase code is empty.' );
			}

			$api_url = 'https://updates.arrowtheme.com/wp-json/arrow-market/v1/activate/';

			$args = array(
				'body' => array(
					'purchase_code' => $purchase_code,
					'personal_code' => $personal_token,
					'domain'        => $domain,
					'theme'         => $theme,
					'theme_version' => $theme_version,
					'user_email'    => $user_email,
				),
				'timeout' => 30,
			);

			$response = wp_remote_post( $api_url, $args );

			if ( is_wp_error( $response ) ) {
				throw new \Exception( $response->get_error_message() );
			}

			$response_code = wp_remote_retrieve_response_code( $response );

			if ( 200 !== $response_code ) {
				throw new \Exception( 'Error: ' . wp_remote_retrieve_response_message( $response ) );
			}

			$response_body = wp_remote_retrieve_body( $response );

			$data = json_decode( $response_body, true );

			if ( ! $data ) {
				throw new \Exception( 'Error: ' . wp_remote_retrieve_response_message( $response ) );
			}

			if ( $data['status'] !== 'success' ) {
				throw new \Exception( $data['message'] ?? 'Error: ' . wp_remote_retrieve_response_message( $response ) );
			}

			// Save purchase code to database.
			update_option( 'arrowpress_purchase_code', $purchase_code );

			if ( ! empty( $data['data']['site_code'] ) ) {
				update_option( 'arrowpress_purchase_token', $data['data']['site_code'] );
			}

			if ( ! empty( $personal_token ) ) {
				$purchase_codes = Arrowpress_Envato_API::list_all_purchase_codes( $personal_token );

				if ( ! empty( $purchase_codes ) && in_array( $purchase_code, $purchase_codes ) ) {
					update_option( 'arrowpress_personal_token', $personal_token );
				} else {
					delete_option( 'arrowpress_personal_token' );

					throw new \Exception( 'Personal token is invalid.' );
				}
			}

			return array(
				'status'  => 'success',
				'message' => 'Theme license activated.',
			);
		} catch (\Throwable $th) {
			return array(
				'status'  => 'error',
				'message' => $th->getMessage(),
			);
		}
	}

	public function deactivate( $request ) {
		try {
			// Call API to server.
			$api_url = 'https://updates.arrowtheme.com/wp-json/arrow-market/v1/deactivate/';

			$args = array(
				'body' => array(
					'site_code' => get_option( 'arrowpress_purchase_token' ),
				),
				'timeout' => 30,
			);

			$response = wp_remote_post( $api_url, $args );

			if ( is_wp_error( $response ) ) {
				throw new \Exception( $response->get_error_message() );
			}

			$response_code = wp_remote_retrieve_response_code( $response );

			if ( 200 !== $response_code ) {
				throw new \Exception( 'Error: ' . wp_remote_retrieve_response_message( $response ) );
			}

			$response_body = wp_remote_retrieve_body( $response );

			$data = json_decode( $response_body, true );

			if ( ! $data ) {
				throw new \Exception( 'Error: ' . wp_remote_retrieve_response_message( $response ) );
			}

			if ( $data['status'] !== 'success' ) {
				if ( ! empty( $data['message'] ) && $data['message'] !== 'Site code is not exist' ) {
					throw new \Exception( $data['message'] );
				}
			}

			// Save purchase code to database.
			delete_option( 'arrowpress_purchase_code' );
			delete_option( 'arrowpress_purchase_token' );
			delete_option( 'arrowpress_personal_token' );

			return array(
				'status'  => 'success',
				'message' => 'Theme license deactivated.',
			);
		} catch (\Throwable $th) {
			return array(
				'status'  => 'error',
				'message' => $th->getMessage(),
			);
		}
	}

	public function update_personal( $request ) {
		$personal_token = $request['personal_token'] ? sanitize_text_field( $request['personal_token'] ) : '';

		if ( ! empty( $personal_token ) ) {
			$purchase_codes = Arrowpress_Envato_API::list_all_purchase_codes( $personal_token );
			$purchase_code  = get_option( 'arrowpress_purchase_code' );

			if ( ! empty( $purchase_codes ) && in_array( $purchase_code, $purchase_codes ) ) {
				update_option( 'arrowpress_personal_token', $personal_token );
			} else {
				delete_option( 'arrowpress_personal_token' );

				return array(
					'status'  => 'error',
					'message' => 'Personal token is invalid.',
				);
			}

			return array(
				'status'  => 'success',
				'message' => 'Personal token updated.',
			);
		}

		return array(
			'status'  => 'error',
			'message' => 'Personal token is empty.',
		);
	}

	public function add_sub_page( $sub_pages ) {
		if ( Arrowpress_Envato_Hosted::is_envato_hosted_site() ) {
			return $sub_pages;
		}

		if ( ! current_user_can( 'administrator' ) ) {
			return $sub_pages;
		}

		$sub_pages['license'] = array(
			'title' => __( 'Theme License', 'arrowpress-core' ),
		);

		return $sub_pages;
	}
}
