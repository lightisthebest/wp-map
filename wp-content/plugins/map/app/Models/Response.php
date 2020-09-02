<?php


namespace App\Model;


class Response {
	public $response = null;

	/**
	 * @param array $data
	 * @param int $status
	 * @param array $headers
	 *
	 * @return \WP_Error|\WP_REST_Response
	 */
	public function json(array $data = [], int $status = 200, array $headers = []) {

		$response = rest_ensure_response($data);
		$response->set_status($status);
		$response->set_headers($headers);

		return $response;
	}

}