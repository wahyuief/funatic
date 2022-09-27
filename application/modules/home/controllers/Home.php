<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends FrontendController {

	public function index()
	{
		$this->data['message'] = $this->_show_message();
		$this->_render_page('home', $this->data);
	}
}
