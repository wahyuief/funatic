<?php defined('BASEPATH') or exit('No direct script access allowed');

class BackendController extends MY_Controller
{
    public $CI;
    protected $data = array();
    public function __construct()
    {
        parent::__construct();
        $CI =& get_instance();
    }

    protected function _render_page($view, $data) {
		$data['title'] = $this->config->item('site_title', 'ion_auth') . ($this->uri->segment(2) ? ' | ' . ucwords($this->uri->segment(2)) : '') . ($this->uri->segment(3) ?  ' - ' .ucwords($this->uri->segment(3)) : '');
		$data['user_sess'] = $this->ion_auth->user()->row();
		foreach ($this->ion_auth->get_users_groups($user->id)->result() as $group) {
			$group_name[] = $group->name;
		}
		$data['group_user_sess'] = $group_name;
		$this->load->view('administrator/header', $data);
		$this->load->view('administrator/navbar', $data);
		$this->load->view('administrator/sidebar', $data);
		$this->load->view('administrator/breadcrumb', $data);
		$this->load->view($view, $data);
		$this->load->view('administrator/footer-copyright', $data);
		$this->load->view('administrator/footer', $data);
	}
}