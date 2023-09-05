<?php
/**
 * Tweetstorm_Requests_Transport_Override class.
 *
 * @package automattic/jetpack
 */

/**
 * Helper class for loading fixtures when testing Tweetstorm external requests.
 */
class Tweetstorm_Requests_Transport_Override implements \WpOrg\Requests\Transport {
	/**
	 * Perform a request.
	 *
	 * @param string       $url URL to request.
	 * @param array        $headers Associative array of request headers.
	 * @param string|array $data Data to send either as the POST body, or as parameters in the URL for a GET/HEAD.
	 * @param array        $options Request options, see {@see Requests::response()} for documentation.
	 * @return string Raw HTTP result
	 */
	public function request( $url, $headers = array(), $data = array(), $options = array() ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis
		global $wp_filesystem;

		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();

		$filename = __DIR__ . '/fixtures/' . str_replace( array( ':', '/' ), '-', $url ) . '.html';

		$response = new \WpOrg\Requests\Response();

		$response->url     = $url;
		$response->history = array();

		// Some URLs are intended to be loaded externally.
		if ( in_array( $url, array( 'https://jetpack.me/', 'https://jetpack.com/' ), true ) ) {
			$response->status_code = 200;
			$response->success     = true;
			$response->body        = file_get_contents( $url );

			return $response;
		}

		if ( ! $wp_filesystem->exists( $filename ) ) {
			$response->status_code = 500;
			$response->success     = false;

			return $response;
		}

		$response->status_code = 200;
		$response->success     = true;
		$response->body        = $wp_filesystem->get_contents( $filename );

		return $response;
	}

	/**
	 * Send multiple requests simultaneously.
	 *
	 * @param array $requests Request data (array of 'url', 'headers', 'data', 'options') as per {@see \WpOrg\Requests\Transport::request}.
	 * @param array $options Global options, see {@see Requests::response()} for documentation.
	 * @return array Array of \WpOrg\Requests\Response objects (may contain \WpOrg\Requests\Exception or string responses as well).
	 */
	public function request_multiple( $requests, $options ) {  // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis
		$responses = array();
		foreach ( $requests as $request ) {
			$responses[] = $this->request( $request['url'] );
		}

		return $responses;
	}

	/**
	 * Self-test whether the transport can be used.
	 *
	 * @return bool
	 */
	public static function test( $capabilities = array() ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
		return true;
	}
}
