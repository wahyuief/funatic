<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends FrontendController {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('orders_model');
		$this->load->model('buyers_model');
    }

	public function callback()
	{
		$json = file_get_contents('php://input');
		$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';
		$signature = callback_signature($json);

		if ($callbackSignature !== $signature) {
			exit(json_encode([
				'success' => false,
				'message' => 'Invalid signature',
			]));
		}

		$data = json_decode($json);

		if (JSON_ERROR_NONE !== json_last_error()) {
			exit(json_encode([
				'success' => false,
				'message' => 'Invalid data sent by payment gateway',
			]));
		}

		if ('payment_status' !== $_SERVER['HTTP_X_CALLBACK_EVENT']) {
			exit(json_encode([
				'success' => false,
				'message' => 'Invalid callback event, no action was taken',
			]));
		}

		$uniqueRef = $db->real_escape_string($data->merchant_ref);
		$status = strtoupper((string) $data->status);
	}
}
