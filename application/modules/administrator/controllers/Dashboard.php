<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends BackendController {

    public function __construct()
    {
        parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect(base_url('auth/login'), 'refresh');
		if (!$this->ion_auth->is_admin()) show_error('Sorry you do not have permission to access this page');
    }

	public function index()
	{
		$this->data['message'] = $this->_show_message();
		$this->_render_page('dashboard', $this->data);
	}
}
