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
			$order = $this->orders_model->get(['no_invoice' => $no_invoice])->row();
			$buyer = $this->buyers_model->get(['id' => $order->buyer_id])->row();
			$buyer_data = json_decode($buyer->buyer_data);
			if (!$order) exit(json_encode(['success' => false]));
			if ($order->status_payment) exit(json_encode(['success' => true]));
			if ($data['status'] === 'PAID') {
				if (empty($order->transaction_id)) {
					$customer_id_field = $buyer_data->customer_id_field;
					game_transaction($buyer_data->variation_code, $buyer_data->$customer_id_field, $buyer_data->no_invoice);
				}
				$input['transaction_id'] = unique_id('uuid');
				$input['status_payment'] = 1;
				$this->orders_model->set($input, ['id' => $order->id]);
				notif_sent(2, 1, $buyer->phone, 'Pembayaran berhasil untuk invoice '. $no_invoice);
				exit(json_encode([
					'success' => true,
				]));
			}
		}
	}

	public function transaction()
	{
		$json = file_get_contents('php://input');
		$data = json_decode($json, TRUE)['data'];
		if (is_array($data)) {
			$no_invoice = $data['ref_id'];
			$order = $this->orders_model->get(['no_invoice' => $no_invoice])->row();
			$buyer = $this->buyers_model->get(['id' => $order->buyer_id])->row();
			if (!$order) exit(json_encode(['success' => false]));
			if ($order->status_transaction) exit(json_encode(['success' => true]));
			$input['transaction_id'] = $data['trx_id'];
			$input['status_transaction'] = 0;
			$input['keterangan'] = $data['sn'];
			if ($data['status'] === 'Sukses') $input['status_transaction'] = 1;
			$this->orders_model->set($input, ['id' => $order->id]);
			notif_sent(2, 1, $buyer->phone, 'Transaksi berhasil untuk invoice '. $order->no_invoice);
			exit(json_encode([
				'success' => true,
			]));
		}
	}
}
