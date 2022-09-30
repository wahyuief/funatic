<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends FrontendController {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('products_model');
    }

	public function index()
	{
		$this->data['message'] = $this->_show_message();
		$this->data['products'] = $this->products_model->get()->result();
		$this->_render_page('home', $this->data);
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect(base_url('auth/login'), 'refresh');
	}
}
