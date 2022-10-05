<?php defined('BASEPATH') or exit('No direct script access allowed');

class FrontendController extends MY_Controller
{
    public $CI;
    protected $data = array();
    public function __construct()
    {
        parent::__construct();
        $CI =& get_instance();
    }

    protected function _render_page($view, $data) {
		$data['title'] = ($this->uri->segment(2) ? ucwords(str_replace('-', ' ', $this->uri->segment(2))) . ' | ' : '') . ($this->uri->segment(1) ?  ucwords(str_replace('-', ' ', $this->uri->segment(1))) . ' - ' : '') . $this->config->item('site_title', 'ion_auth');
		$this->load->view('home/header', $data);
		$this->load->view('home/navbar', $data);
		$this->load->view('home/sidebar', $data);
		$this->load->view('home/breadcrumb', $data);
		$this->load->view($view, $data);
		$this->load->view('home/footer-widget', $data);
		$this->load->view('home/footer-copyright', $data);
		$this->load->view('home/footer', $data);
	}
}