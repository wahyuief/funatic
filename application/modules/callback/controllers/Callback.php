<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends FrontendController {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('orders_model');
		$this->load->model('buyers_model');
    }

	public function payment()
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

		$data = json_decode($json, TRUE);

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

		if (is_array($data)) {
			$no_invoice = $data['merchant_ref'];
			if ($data['status'] === 'PAID') {
				$input['status_payment'] = 1;
				$this->orders_model->set($input, ['no_invoice' => $no_invoice]);
				exit(json_encode([
					'success' => true,
				]));
			}
		}
	}

	public function transaction()
	{
		$json = file_get_contents('php://input');
		$data = json_decode($json, TRUE);
		if (is_array($data)) {
			$transaction_id = $data['idtrx'];
			$input['status_transaction'] = 0;
			$input['keterangan'] = $data['note'];
			if ($data['status']) $input['status_transaction'] = 1;
			$this->orders_model->set($input, ['transaction_id' => $transaction_id]);
			exit(json_encode([
				'success' => true,
			]));
		}
	}
}
