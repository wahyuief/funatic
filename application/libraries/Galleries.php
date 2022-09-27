<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Galleries
{
	protected $_images_uri = '/uploads';
	protected $_images_dir;
	protected $_thumbnail_dir_name = 'thumbnails';

	function __construct()
	{
		$this->ci =& get_instance();
		$this->_images_dir = rtrim(FCPATH, '/') . $this->_images_uri;
	}

	public function get($path = '')
	{
		$files = get_dir_file_info($this->_images_dir . $path);
		$images = array();
		if (is_array($files) && count($files) > 0) {
			foreach ($files as $file) {
				if (!isset($file['name'])) continue;

				if ($this->is_image($file['name'])) {
					$image = array();

					$image['full'] = $this->_images_uri . $path . '/' . $file['name'];
					$image['thumbnail'] = '';

					$thumbnail = $this->_thumbnail_file_path($path, $file['name']);

					if (file_exists($thumbnail)) $image['thumbnail'] = $this->_thumbnail_uri_path($path, $file['name']);

					$images[$file['name']] = $image;
				}
			}
		}
		return $images;
	}

	public function images_dir($file_path)
	{
		$this->_images_dir = $file_path;
	}

	public function images_uri($uri_path)
	{
		$this->_images_uri = $uri_path;
	}

	public function thumbnail_path($name)
	{
		$this->_thumbnail_dir_name = $name;
	}

	protected function _thumbnail_file_path($base_path = '', $filename)
	{
		return $this->_images_dir . $base_path . '/' . $this->_thumbnail_dir_name . '/' . $filename;
	}

	protected function _thumbnail_uri_path($base_path = '', $filename)
	{
		return $this->_images_uri . $base_path . '/' . $this->_thumbnail_dir_name . '/' . $filename;
	}

	protected function is_image($filename)
	{
		$extension = explode('.', strtolower($filename))[1];
        $whitelist_ext = array('jpeg', 'jpg', 'png');
		return in_array($extension, $whitelist_ext);
	}

}
