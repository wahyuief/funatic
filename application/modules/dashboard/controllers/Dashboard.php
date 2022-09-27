<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends BackendController {

    public function __construct()
    {
        parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect(base_url('auth/login'), 'refresh');
    }

	public function index()
	{
		$this->load->view('dashboard');
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect(base_url('auth/login'), 'refresh');
	}
}
