<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends FrontendController {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->data['message'] = $this->_show_message();
		$this->_render_page('contact', $this->data);
	}
}
