<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends BackendController {

    public function __construct()
    {
        parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect(base_url('auth/login'), 'refresh');
		if (!$this->ion_auth->is_admin()) show_error('Sorry you do not have permission to access this page');
    }

	public function index()
	{
		$this->data['csrf'] = $this->_get_csrf_nonce();
		$this->data['message'] = $this->_show_message();
		$this->data['images'] = $this->galleries->get();
		ksort($this->data['images']);
		$this->_render_page('gallery', $this->data);
	}

	public function upload()
	{
		if (!is_dir('uploads/')) mkdir('./uploads/', 0777, TRUE);

		if (isset($_FILES['file'])) {
			$config['upload_path']		= './uploads/';
			$config['allowed_types']	= 'jpeg|jpg|png';
			$config['max_size']			= 16000;
			$config['file_ext_tolower']	= true;
			$config['encrypt_name']		= true;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('file')) {
				$this->_set_message('success', 'This file has been uploaded successfully.');
				echo $this->_resize_image($this->upload->data('file_name'));
			} else {
				$this->_set_message('error', 'Failed! Maximum file upload is 16mb.');
				echo false;
			}
		}
		echo false;
	}

	public function _resize_image($filename)
	{
		$source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $filename;
		$target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
		$config = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			'maintain_ratio' => TRUE,
			'width' => 800,
			'quality' => '100%'
		);
	
		$this->load->library('image_lib', $config);
		if (!$this->image_lib->resize()) return false;
		$this->image_lib->clear();
		return true;
	}
}
