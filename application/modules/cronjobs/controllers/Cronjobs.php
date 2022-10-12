<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjobs extends FrontendController {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('orders_model');
		$this->load->model('buyers_model');
    }

	public function payment()
	{
		if (input_get('key') === 'm0mx1mc129a3701mc847a1') {
			$datas = $this->orders_model->get(['status_payment' => '0'])->result();
			foreach ($datas as $data) {
				$payment = detail_payment($data->payment_id);
				$status_payment = ($payment->status === 'PAID' ? '1' : '0');
				$this->orders_model->set(['status_payment' => $status_payment], ['id' => $data->id]);
			}
		}
	}

	public function transaction()
	{
		if (input_get('key') === '8au29u9x810321m910xm21') {
			$datas = $this->orders_model->get(['status_payment' => '1', 'status_transaction' => '0'])->result();
			foreach ($datas as $data) {
				$buyer_data = $this->buyers_model->get(['id' => $data->buyer_id])->row();
				$customer_id_field = $buyer_data->customer_id_field;
				$transaction = game_transaction($buyer_data->variation_code, $buyer_data->$customer_id_field, $buyer_data->no_invoice)['data'];
				$status_transaction = ($transaction->status === 'Sukses' ? '1' : '0');
				$this->orders_model->set(['status_transaction' => $status_transaction], ['id' => $data->id]);
			}
		}
	}
}
