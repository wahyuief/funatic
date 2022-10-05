<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends FrontendController {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('orders_model');
		$this->load->model('buyers_model');
		$this->load->model('variations_model');
		$this->load->model('products_model');
    }

	public function index()
	{
		// echo json_encode(mlbb_validator(1572280492241));die;
		if ($no = input_post('no')) redirect(base_url('invoice/' . $no),'refresh');

		$no_invoice = $this->uri->segment(2);
		$this->data['message'] = $this->_show_message();
		if ($no_invoice) {
			$invoice = $this->orders_model->get(['no_invoice' => $no_invoice]);
			if (!$invoice->num_rows()) show_404();
			$this->data['invoice'] = $invoice->row();
			$this->_confirm_payment($this->data['invoice']->payment_id);
			$this->data['variation'] = $variation = $this->variations_model->get(['id' => $this->data['invoice']->variation_id])->row();
			$this->data['product'] = $product = $this->products_model->get(['id' => $variation->product_id])->row();
			$this->data['buyer'] = $buyer = $this->buyers_model->get(['id' => $this->data['invoice']->buyer_id])->row();
			$this->data['data'] = json_decode($buyer->buyer_data);
			$this->_render_page('invoice_data', $this->data);
		} else {
			$this->_render_page('invoice_form', $this->data);
		}
	}

	function _confirm_payment($payment_id)
	{
		$transaction = detail_transaction($payment_id);
		if ($transaction['status'] === 'PAID') $this->orders_model->set(['status_payment' => 1], ['payment_id' => $payment_id]);
	}
}
