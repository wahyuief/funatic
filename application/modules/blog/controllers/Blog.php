<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends FrontendController {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('blog_model');
    }

	public function index()
	{
		$slug = $this->uri->segment(2);

		$this->data['message'] = $this->_show_message();
		if ($slug) {
			$blog = $this->blog_model->get(['slug' => $slug]);
			if (!$blog->num_rows()) show_404();
			$this->data['blog'] = $blog->row();
			$this->_render_page('detail', $this->data);
		} else {
			$this->data['limit'] = $limit = 10;
			$this->data['page'] = $page = (input_get('page') ? input_get('page') : 1);
			$first_page = ($page > 1 ? ($page * $limit) - $limit : 0);
			$prev = $page - 1;
			$next = $page + 1;

			$this->data['count_page'] = $count_data = $this->blog_model->get(false, false, false, $search)->num_rows();
			$total_data = ceil($count_data / $limit);
			
			$search = (input_get('s') ? input_get('s') : false);
			$this->data['blogs'] = $this->blog_model->get(false, $limit, $first_page, $search)->result();
			$this->_render_page('blog', $this->data);
		}
	}
}
