<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends MX_Controller
{
    public $CI;
    protected $data = array();
    public function __construct()
    {
        parent::__construct();
        $CI =& get_instance();
        date_default_timezone_set(get_option('timezone', 'Asia/Jakarta'));
    }

    protected function _get_csrf_nonce() {
		$key = unique_id('uuid');
		$value = wah_encode(unique_id(false, 8));
		$this->session->set_userdata('x_input_csrf_key', $key);
		$this->session->set_userdata('x_input_csrf_val', $value);
		return [$key => $value];
	}

	protected function _valid_csrf_nonce() {
		$csrfkey = input_post($this->session->userdata('x_input_csrf_key'));
		if (!$csrfkey && $csrfkey !== $this->session->userdata('x_input_csrf_val')) return FALSE;
		return TRUE;
	}

    public function _set_message($type = 'info', $message)
    {
        // type = success, info, warning, error
        $this->session->set_flashdata('wahtype', $type);
        $this->session->set_flashdata('wahmessage', $message);
    }

    public function _show_message($type = null, $message = null)
    {
        if ($type && $message) {
            $output = '';
            if (strpos($message, '|') !== false) {
                $message = explode('|', $message);
                $output = '<script>var notyf = new Notyf({position: {x:\'right\',y:\'top\'},dismissible:true});';
                foreach ($message as $key => $value) {
                    $value = str_replace("\n", '', $value);
                    if (!empty($value)) $output .= 'notyf.' . $type . '({message:"' . $value . '",duration:'.(5000+($key*1000)).'});';
                }
                $output .= '</script>';
            } else {
                $output = '<script>var notyf = new Notyf({position: {x:\'right\',y:\'top\'},dismissible:true});';
                $message = str_replace("\n", '', $message);
                if (!empty($message)) $output .= 'notyf.' . $type . '({message:"' . $message . '",duration:5000});';
                $output .= '</script>';
            }
            return $output;
        }

        if ($this->session->flashdata('wahtype') && $this->session->flashdata('wahmessage')) {
            $type = $this->session->flashdata('wahtype');
            $message = $this->session->flashdata('wahmessage');
            $output = '';
            if (strpos($message, '|') !== false) {
                $message = explode('|', $message);
                $output = '<script>var notyf = new Notyf({position: {x:\'right\',y:\'top\'},dismissible:true});';
                foreach ($message as $key => $value) {
                    $value = str_replace("\n", '', $value);
                    if (!empty($value)) $output .= 'notyf.' . $type . '({message:"' . $value . '",duration:'.(5000+($key*1000)).'});';
                }
                $output .= '</script>';
            } else {
                $output = '<script>var notyf = new Notyf({position: {x:\'right\',y:\'top\'},dismissible:true});';
                $message = str_replace("\n", '', $message);
                if (!empty($message)) $output .= 'notyf.' . $type . '({message:"' . $message . '",duration:5000});';
                $output .= '</script>';
            }
            return $output;
        }
    }
}

require_once(APPPATH.'core/Backend_Controller.php');
require_once(APPPATH.'core/Frontend_Controller.php');