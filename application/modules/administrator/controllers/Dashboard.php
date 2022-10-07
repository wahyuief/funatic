<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends BackendController {

    public function __construct()
    {
        parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect(base_url('auth/login'), 'refresh');
		if (!$this->ion_auth->is_admin()) show_error('Sorry you do not have permission to access this page');
		$this->load->model('orders_model');
		$this->load->model('buyers_model');
    }

	public function index()
	{
		$this->data['message'] = $this->_show_message();
		$this->data['orders'] = $this->orders_model->get()->num_rows();
		$this->data['payment_completed'] = $this->orders_model->get(['status_payment' => '1'])->num_rows();
		$this->data['transaction_completed'] = $this->orders_model->get(['status_transaction' => '1'])->num_rows();
		$this->data['buyers'] = $this->buyers_model->count();
		$this->_render_page('dashboard', $this->data);
	}
}
