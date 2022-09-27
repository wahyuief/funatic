<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends BackendController {

    public function __construct()
    {
        parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect(base_url('auth/login'), 'refresh');
		if (!$this->ion_auth->is_admin()) show_error('Sorry you do not have permission to access this page');
    }

	public function index()
	{
		$user_sess = $this->ion_auth->user()->row();
		if ($_POST['submit'] === 'security' && $_GET['tab'] === 'security') {
			$this->form_validation->set_rules('oldpass', 'old password', 'required');
			$this->form_validation->set_rules('newpass', 'new password', 'required');
			$this->form_validation->set_rules('confirmpass', 'confirm new password', 'required');
		} else {
			$this->form_validation->set_rules('fullname', 'full name', 'trim|required');
			$this->form_validation->set_rules('phone', 'phone', 'trim|required');
			$this->form_validation->set_rules('company', 'company', 'trim');
		}

		if ($this->form_validation->run() === FALSE) {
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['message'] = $this->_show_message('error', $this->ion_auth->errors());
			$this->_render_page('profile', $this->data);
		} else {
			if ($this->_valid_csrf_nonce() === FALSE) show_error($this->lang->line('error_csrf'));
			if ($_POST['submit'] === 'security' && $_GET['tab'] === 'security') {
				if ($this->ion_auth->change_password($user_sess->email, $this->input->post('oldpass'), $this->input->post('newpass'), $this->input->post('confirmpass'))) {
					$this->_set_message('success', $this->ion_auth->messages());
				} else {
					$this->_set_message('error', $this->ion_auth->errors());
				}
				redirect(base_url('administrator/profile?tab=security'), 'refresh');
			} else {
				$data = [
					'username' => $user_sess->username,
					'email' => $user_sess->email,
					'fullname' => input_post('fullname'),
					'company' => input_post('company'),
					'phone' => input_post('phone')
				];
				if ($this->ion_auth->update($user_sess->id, $data)) {
					$this->_set_message('success', $this->ion_auth->messages());
				} else {
					$this->_set_message('error', $this->ion_auth->errors());
				}
				redirect(base_url('administrator/profile?tab=general'), 'refresh');
			}
		}
	}

	public function change_avatar()
	{
		if (isset($_FILES['avatar']) && getimagesize($_FILES["avatar"]["tmp_name"])) {
			$config['upload_path']		= './assets/avatar/';
			$config['allowed_types']	= 'jpeg|jpg|png';
			$config['max_size']			= 512;
			$config['file_ext_tolower']	= true;
			$config['encrypt_name']		= true;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('avatar')) {
				$filename = $this->upload->data('file_name');
				$user_sess = $this->ion_auth->user()->row();
				$this->_set_message('success', 'Your avatar has been successfully changed.');
				if ($this->ion_auth->update($user_sess->id, ['avatar' => $filename])) return true;
			} else {
				$this->_set_message('error', 'Maximum image size is 512kb.');
				return false;
			}
		}
		$this->_set_message('error', 'Please select a jpeg, jpg or png file.');
		return false;
	}
}
