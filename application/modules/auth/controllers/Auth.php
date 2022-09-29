<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends FrontendController
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		if ($this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) redirect(base_url('dashboard'), 'refresh');
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) redirect(base_url('administrator/dashboard'), 'refresh');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
	}

	public function index()
	{
		redirect(base_url('auth/login'), 'refresh');
	}

	public function login()
	{
		$this->data['title'] = 'Login to system';

		$this->form_validation->set_rules('email', 'email address', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['message'] = $this->_show_message('error', validation_errors());
			$this->data['jsauth'] = 'jsauth';
			$this->_render_page('login', $this->data);
		} else {
			if ($this->_valid_csrf_nonce() === FALSE) show_error($this->lang->line('error_csrf'));
			if ($this->ion_auth->login(input_post('email'), input_post('password'), (bool)input_post('remember'))) {
				$this->_set_message('success', $this->ion_auth->messages());
				if ($this->ion_auth->is_admin()) redirect(base_url('administrator/dashboard'), 'refresh');
				redirect(base_url('dashboard'), 'refresh');
			} else {
				$this->_set_message('error', $this->ion_auth->errors());
				redirect(base_url('auth/login'), 'refresh');
			}
		}
	}

	public function forgot_password()
	{
		$this->data['title'] = $this->lang->line('forgot_password_heading');
		
		$this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email');
		if ($this->form_validation->run() === FALSE) {
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['message'] = $this->_show_message('error', validation_errors());
			$this->data['jsauth'] = 'jsauth';
			$this->_render_page('forgot_password', $this->data);
		} else {
			if ($this->_valid_csrf_nonce() === FALSE) show_error($this->lang->line('error_csrf'));
			$identity = $this->ion_auth->where('email', input_post('email'))->users()->row();

			if (empty($identity)) {
				$this->ion_auth->set_error('forgot_password_email_not_found');

				$this->_set_message('error', $this->ion_auth->errors());
				redirect(base_url('auth/password/forgot'), 'refresh');
			}

			$forgotten = $this->ion_auth->forgotten_password($identity->email);

			if ($forgotten) {
				$this->_set_message('success', $this->ion_auth->messages());
			} else {
				$this->_set_message('error', $this->ion_auth->errors());
			}
			redirect(base_url('auth/password/forgot'), 'refresh');
		}
	}

	public function reset_password($code)
	{
		if (!$code) show_404();
		$this->data['title'] = $this->lang->line('reset_password_heading');
		$user = $this->ion_auth->forgotten_password_check($code);
		if ($user) {
			$this->form_validation->set_rules('password', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('password_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() === FALSE) {
				$this->data['message'] = $this->_show_message('error', validation_errors());

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['user_id'] = [
					'name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
				];
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				$this->data['jsauth'] = 'jsauth';
				$this->_render_page('reset_password', $this->data);
			} else {
				$identity = $user->email;

				if ($this->_valid_csrf_nonce() === FALSE || $user->id != input_post('user_id')) {
					$this->ion_auth->clear_forgotten_password_code($identity);
					show_error($this->lang->line('error_csrf'));
				} else {
					if ($this->ion_auth->reset_password($identity, input_post('password'))) {
						$this->_set_message('success', $this->ion_auth->messages());
						redirect(base_url('auth/login'), 'refresh');
					} else {
						$this->_set_message('error', $this->ion_auth->errors());
						redirect(base_url('auth/password/reset/' . $code), 'refresh');
					}
				}
			}
		} else {
			$this->_set_message('error', $this->ion_auth->errors());
			redirect(base_url('auth/password/forgot'), 'refresh');
		}
	}

	public function activate($id, $code)
	{
		if (!$code) show_404();
		if ($this->ion_auth->activate($id, $code)) {
			$this->_set_message('success', $this->ion_auth->messages());
			redirect(base_url('auth/login'), 'refresh');
		} else {
			$this->_set_message('error', $this->ion_auth->errors());
			redirect(base_url('auth/password/forgot'), 'refresh');
		}
	}
}