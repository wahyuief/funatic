<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Fpdf\Fpdf;

class Blog extends BackendController {

    public function __construct()
    {
        parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect(base_url('auth/login'), 'refresh');
		if (!$this->ion_auth->is_admin()) show_error('Sorry you do not have permission to access this page');
		$this->load->model('blog_model');
    }

	public function index()
	{
		$this->data['total'] = $this->blog_model->get(false, $this->data['pagination']->limit, $this->data['pagination']->offset, input_get('q'))->num_rows();
		$this->data['pagination'] = new \yidas\data\Pagination([
			'perPageParam' => '',
			'totalCount' => $this->data['total'],
			'perPage' => 10,
		]);
		$this->data['start'] = ($this->data['total'] > 0 ? $this->data['pagination']->offset+1 : 0);
		$this->data['end'] = ($this->data['total'] > 0 ? $this->data['pagination']->offset+$this->blog_model->get(false, $this->data['pagination']->limit, $this->data['pagination']->offset, input_get('q'))->num_rows() : 0);
		$this->data['data'] = $this->blog_model->get(false, $this->data['pagination']->limit, $this->data['pagination']->offset, input_get('q'))->result();
		$this->data['message'] = $this->_show_message();

		$this->_render_page('blog/list', $this->data);
	}

	public function add()
	{
		$this->form_validation->set_rules('title', 'title', 'trim|required');
		$this->form_validation->set_rules('content', 'content', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['message'] = ($this->ion_auth->errors() ? $this->_show_message('error', $this->ion_auth->errors()) : $this->_show_message('error', validation_errors()));
			$this->_render_page('blog/add', $this->data);
		} else {
			if ($this->_valid_csrf_nonce() === FALSE) show_error($this->lang->line('error_csrf'));

			$user = $this->ion_auth->user()->row();
			$input = array(
				'author_id' => $user->id,
				'title' => input_post('title'),
				'slug' => url_title(input_post('title'), 'dash', true),
				'content' => $this->input->post('content'),
				'category' => input_post('category'),
				'tags' => ($this->input->post('tags') ? implode(', ', $this->input->post('tags')) : ''),
				'meta_title' => (input_post('meta_title') ? input_post('meta_title') : input_post('title')),
				'meta_description' => (input_post('meta_description') ? input_post('meta_description') : wordwrap(input_post('content'), 30)),
			);

			if (input_post('submit') === 'publish') {
				$input['published'] = 1;
				$input['published_at'] = date('Y-m-d H:i:s');
			}

			if ($this->blog_model->add($input)) {
				$this->_set_message('success', 'This article has been published successfully.');
				redirect(base_url('administrator/blog'), 'refresh');
			} else {
				$this->_set_message('error', 'Failed to create new article.');
				redirect(base_url('administrator/blog/add'), 'refresh');
			}
		}
	}

	public function edit($id)
	{
		$data = $this->blog_model->get(['blog.id' => wah_decode($id)]);
		if (!$data->num_rows()) redirect(base_url('administrator/blog'), 'refresh');

		$this->form_validation->set_rules('title', 'title', 'trim|required');
		$this->form_validation->set_rules('content', 'content', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['message'] = ($this->ion_auth->errors() ? $this->_show_message('error', $this->ion_auth->errors()) : $this->_show_message('error', validation_errors()));
			$this->data['data'] = $data->row();
			$this->_render_page('blog/edit', $this->data);
		} else {
			if ($this->_valid_csrf_nonce() === FALSE || $data->row()->id != wah_decode(input_post('id'))) show_error($this->lang->line('error_csrf'));

			$input = array(
				'title' => input_post('title'),
				'slug' => url_title(input_post('title'), 'dash', true),
				'content' => $this->input->post('content'),
				'category' => input_post('category'),
				'tags' => ($this->input->post('tags') ? implode(', ', $this->input->post('tags')) : ''),
				'meta_title' => (input_post('meta_title') ? input_post('meta_title') : input_post('title')),
				'meta_description' => (input_post('meta_description') ? input_post('meta_description') : wordwrap(input_post('content'), 30)),
			);

			if (input_post('submit') === 'publish') {
				$input['published'] = 1;
				$input['published_at'] = ($data->row()->published_at !== null ? $data->row()->published_at : date('Y-m-d H:i:s'));
			} else {
				$input['published'] = 0;
			}

			$input['updated_at'] = date('Y-m-d H:i:s');

			if ($this->blog_model->set($input, ['blog.id' => $data->row()->id])) {
				$this->_set_message('success', 'This article has been updated successfully.');
			} else {
				$this->_set_message('error', 'Failed to update article.');
			}
			redirect(base_url('administrator/blog/edit/' . $id), 'refresh');
		}
	}

	public function delete($id)
	{
		$data = $this->blog_model->get(['blog.id' => wah_decode($id)]);
		if (!$data->num_rows()) redirect(base_url('administrator/blog'), 'refresh');

		if ($this->blog_model->unset(['blog.id' => $data->row()->id])) {
			$this->_set_message('success', 'This article has been deleted successfully.');
		} else {
			$this->_set_message('error', 'Failed to delete article.');
		}
		redirect(base_url('administrator/blog'), 'refresh');
	}

	public function export_excel()
	{
		$title = 'Export Blog ' . date('d M Y');
		$data = $this->blog_model->get()->result();

		$spreadsheet = new Spreadsheet();
		foreach(range('A','E') as $columnID) $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
		$spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DDDDDD');

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Title')
			->setCellValue('B1', 'Category')
			->setCellValue('C1', 'Author')
			->setCellValue('D1', 'Created')
			->setCellValue('E1', 'Published');

		$i=2;
		foreach($data as $row) {
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $row->title)
				->setCellValue('B'.$i, $row->category)
				->setCellValue('C'.$i, $row->fullname)
				->setCellValue('D'.$i, date('d-M-Y, H:i', strtotime($row->created_at)))
				->setCellValue('E'.$i, ($row->published === '1' ? 'Yes' : 'No'));
			$i++;
		}

		$spreadsheet->getActiveSheet()->setTitle($title);
		$spreadsheet->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$title.'.xlsx"');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}

	public function export_pdf()
	{
		$title = 'Export Blog ' . date('d M Y');
		$data = $this->blog_model->get()->result();

		$pdf = new Fpdf();
		$headers = array('Title', 'Category', 'Author', 'Created', 'Published');
		$pdf->SetFont('Arial', '', 12);
		$pdf->AddPage();

		$pdf->SetFillColor(220, 220, 220);
		$pdf->SetTextColor(0);
		$pdf->SetLineWidth(0);
		$pdf->SetFont('', 'B');
		$width = array(40, 40, 40, 40, 30);
		for ($i = 0; $i < count($headers); $i++)
        	$pdf->Cell($width[$i], 7, $headers[$i], 0, 0, 'L', true);
		$pdf->Ln();
		$pdf->SetFillColor(245, 245, 245);
		$pdf->SetTextColor(0);
		$pdf->SetFont('', '', 10);
		$fill = false;
		foreach ($data as $row) {
			$pdf->Cell($width[0], 6, $row->title, 0, 0, 'L', $fill);
			$pdf->Cell($width[1], 6, $row->category, 0, 0, 'L', $fill);
			$pdf->Cell($width[2], 6, $row->fullname, 0, 0, 'L', $fill);
			$pdf->Cell($width[3], 6, date('d-M-Y, H:i', strtotime($row->created_at)), 0, 0, 'L', $fill);
			$pdf->Cell($width[4], 6, ($row->published === '1' ? 'Yes' : 'No'), 0, 0, 'L', $fill);
			$pdf->Ln();
			$fill = !$fill;
		}

		$pdf->Output();
	}
}
