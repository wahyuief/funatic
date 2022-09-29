<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Fpdf\Fpdf;

class Products extends BackendController {

    public function __construct()
    {
        parent::__construct();
		if (!$this->ion_auth->logged_in()) redirect(base_url('auth/login'), 'refresh');
		if (!$this->ion_auth->is_admin()) show_error('Sorry you do not have permission to access this page');
		$this->load->model('products_model');
		$this->load->model('variations_model');
    }

	public function index()
	{
		$this->data['total'] = $this->products_model->get(false, $this->data['pagination']->limit, $this->data['pagination']->offset, input_get('q'))->num_rows();
		$this->data['pagination'] = new \yidas\data\Pagination([
			'perPageParam' => '',
			'totalCount' => $this->data['total'],
			'perPage' => 10,
		]);
		$this->data['start'] = ($this->data['total'] > 0 ? $this->data['pagination']->offset+1 : 0);
		$this->data['end'] = ($this->data['total'] > 0 ? $this->data['pagination']->offset+$this->products_model->get(false, $this->data['pagination']->limit, $this->data['pagination']->offset, input_get('q'))->num_rows() : 0);
		$products = $this->products_model->get(false, $this->data['pagination']->limit, $this->data['pagination']->offset, input_get('q'))->result();
		$data = array();
		foreach ($products as $product) {
			$product->variation_count = $this->variations_model->get(['product_id' => $product->id])->num_rows();
			$data[] = $product;
		}
		$this->data['data'] = $data;
		$this->data['message'] = $this->_show_message();

		$this->_render_page('products/list', $this->data);
	}

	public function add()
	{
		$this->form_validation->set_rules('title', 'title', 'trim|required');
		$this->form_validation->set_rules('content', 'content', 'trim|required');
		$this->form_validation->set_rules('category', 'category', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['message'] = ($this->ion_auth->errors() ? $this->_show_message('error', $this->ion_auth->errors()) : $this->_show_message('error', validation_errors()));
			$this->_render_page('products/add', $this->data);
		} else {
			if ($this->_valid_csrf_nonce() === FALSE) show_error($this->lang->line('error_csrf'));

			$user = $this->ion_auth->user()->row();
			$input = array(
				'title' => input_post('title'),
				'slug' => url_title(input_post('title'), 'dash', true),
				'content' => $this->input->post('content'),
				'category' => input_post('category'),
				'custom_field' => ($this->input->post('customfield') ? $this->input->post('customfield') : NULL),
			);

			if (isset($_FILES['featured_image'])) {
				$config['upload_path']		= './uploads/';
				$config['allowed_types']	= 'jpeg|jpg|png';
				$config['max_size']			= 2048;
				$config['file_ext_tolower']	= true;
				$config['encrypt_name']		= true;
	
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
	
				if ($this->upload->do_upload('featured_image')) {
					$input['featured_image'] = $this->upload->data('file_name');
				} else {
					$this->_set_message('error', 'Maximum image size is 2mb.');
				}
			}

			if (input_post('submit') === 'publish') {
				$input['published'] = 1;
				$input['published_at'] = date('Y-m-d H:i:s');
			}

			if ($id = $this->products_model->add($input)) {
				$this->_set_message('success', 'This product has been saved successfully.');
				redirect(base_url('administrator/products/edit/' . wah_encode($id)), 'refresh');
			} else {
				$this->_set_message('error', 'Failed to create new product.');
				redirect(base_url('administrator/products/add'), 'refresh');
			}
		}
	}

	public function edit($id)
	{
		$data = $this->products_model->get(['products.id' => wah_decode($id)]);
		if (!$data->num_rows()) redirect(base_url('administrator/products'), 'refresh');

		$this->form_validation->set_rules('title', 'title', 'trim|required');
		$this->form_validation->set_rules('content', 'content', 'trim|required');
		$this->form_validation->set_rules('category', 'category', 'trim|required');
		if ($data->custom_field) $this->form_validation->set_rules('customer_id_field', 'customer_id_field', 'trim|required');
		if (input_post('quantity_active')) $this->form_validation->set_rules('quantity_name', 'quantity_name', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['message'] = ($this->ion_auth->errors() ? $this->_show_message('error', $this->ion_auth->errors()) : $this->_show_message('error', validation_errors()));
			$this->data['data'] = $data->row();
			$this->_render_page('products/edit', $this->data);
		} else {
			if ($this->_valid_csrf_nonce() === FALSE || $data->row()->id != wah_decode(input_post('id'))) show_error($this->lang->line('error_csrf'));

			$input = array(
				'title' => input_post('title'),
				'slug' => url_title(input_post('title'), 'dash', true),
				'content' => $this->input->post('content'),
				'category' => input_post('category'),
				'quantity_active' => (input_post('quantity_active') ? input_post('quantity_active') : 0),
				'quantity_name' => input_post('quantity_name'),
				'customer_id_field' => input_post('customer_id_field'),
				'custom_field' => ($this->input->post('customfield') ? $this->input->post('customfield') : NULL),
			);

			if (isset($_FILES['featured_image'])) {
				$config['upload_path']		= './uploads/';
				$config['allowed_types']	= 'jpeg|jpg|png';
				$config['max_size']			= 2048;
				$config['file_ext_tolower']	= true;
				$config['encrypt_name']		= true;
	
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
	
				if ($this->upload->do_upload('featured_image')) {
					$input['featured_image'] = $this->upload->data('file_name');
				} else {
					$this->_set_message('error', 'Maximum image size is 2mb.');
				}
			}

			if (input_post('submit') === 'publish') {
				$input['published'] = 1;
				$input['published_at'] = ($data->row()->published_at !== null ? $data->row()->published_at : date('Y-m-d H:i:s'));
			} else {
				$input['published'] = 0;
			}

			$input['updated_at'] = date('Y-m-d H:i:s');

			if ($this->products_model->set($input, ['products.id' => $data->row()->id])) {
				$this->_set_message('success', 'This product has been updated successfully.');
			} else {
				$this->_set_message('error', 'Failed to update product.');
			}
			redirect(base_url('administrator/products/edit/' . $id), 'refresh');
		}
	}

	public function delete($id)
	{
		$data = $this->products_model->get(['products.id' => wah_decode($id)]);
		if (!$data->num_rows()) redirect(base_url('administrator/products'), 'refresh');

		if ($this->products_model->unset(['products.id' => $data->row()->id])) {
			$this->_set_message('success', 'This product has been deleted successfully.');
		} else {
			$this->_set_message('error', 'Failed to delete product.');
		}
		redirect(base_url('administrator/products'), 'refresh');
	}

	public function export_excel()
	{
		$title = 'Export Products ' . date('d M Y');
		$data = $this->products_model->get()->result();

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
		$title = 'Export Products ' . date('d M Y');
		$data = $this->products_model->get()->result();

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
