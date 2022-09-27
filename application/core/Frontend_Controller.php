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

    protected function _render_page($view, $data = NULL, $returnhtml = FALSE) {
		$data['title'] = $this->config->item('site_title', 'ion_auth') . ($this->uri->segment(2) ? ' | ' . ucwords($this->uri->segment(2)) : '') . ($this->uri->segment(3) ?  ' - ' .ucwords($this->uri->segment(3)) : '');
		$viewdata = (empty($data)) ? $this->data : $data;
		$view_html = $this->load->view($view, $viewdata, $returnhtml);
		if ($returnhtml) return $view_html;
	}
}