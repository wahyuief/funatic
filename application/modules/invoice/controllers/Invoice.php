<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends FrontendController {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('products_model');
		$this->load->model('variations_model');
    }

	public function index()
	{
		echo json_encode(channel('ALFAMART'));die;
		$no_invoice = $this->uri->segment(2);
		$this->data['message'] = $this->_show_message();
		if ($no_invoice) $this->_render_page('invoice_data', $this->data);
		$this->_render_page('invoice_form', $this->data);
	}
}
