<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Fpdf\Fpdf;

class Variations extends BackendController {

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
		if(!$id = input_get('id')) show_404();
		$id = wah_decode($id);
		if($this->products_model->get(['id' => $id])->row() < 1) show_404();
		$this->data['total'] = $this->variations_model->get(['product_id' => $id], $this->data['pagination']->limit, $this->data['pagination']->offset, input_get('q'))->num_rows();
		$this->data['pagination'] = new \yidas\data\Pagination([
			'perPageParam' => '',
			'totalCount' => $this->data['total'],
			'perPage' => 10,
		]);
		$this->data['start'] = ($this->data['total'] > 0 ? $this->data['pagination']->offset+1 : 0);
		$this->data['end'] = ($this->data['total'] > 0 ? $this->data['pagination']->offset+$this->variations_model->get(['product_id' => $id], $this->data['pagination']->limit, $this->data['pagination']->offset, input_get('q'))->num_rows() : 0);
		$this->data['data'] = $this->variations_model->get(['product_id' => $id], $this->data['pagination']->limit, $this->data['pagination']->offset, input_get('q'))->result();
		$this->data['message'] = $this->_show_message();

		$this->_render_page('variations/list', $this->data);
	}

	public function add()
	{
		if(!$id = input_get('id')) show_404();
		$id = wah_decode($id);
		if($this->products_model->get(['id' => $id])->row() < 1) show_404();

		if (!$this->input->post()) {
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['message'] = ($this->ion_auth->errors() ? $this->_show_message('error', $this->ion_auth->errors()) : $this->_show_message('error', validation_errors()));
			$this->_render_page('variations/add', $this->data);
		} else {
			if ($this->_valid_csrf_nonce() === FALSE) show_error($this->lang->line('error_csrf'));

			$input = array(
				'variation_code' => $this->input->post('variation_code[]'),
				'variation_name' => $this->input->post('variation_name[]'),
				'variation_price' => $this->input->post('variation_price[]'),
				'additional_price' => $this->input->post('additional_price[]'),
				'fromwhere' => $this->input->post('fromwhere[]'),
				'status' => $this->input->post('status[]'),
			);
			
			$field = array();
			foreach ($input as $key => $value) {
				foreach ($value as $k => $v) {
					$field[$k]['product_id'] = $id;
					$field[$k][$key] = $v;
				}
			}

			$save = 0;
			foreach ($field as $data) {
				$this->variations_model->add($data);
				$save++;
			}
			
			if ($save > 0) {
				$this->_set_message('success', 'This variation has been published successfully.');
				redirect(base_url('administrator/variations/?id='.wah_encode($id)), 'refresh');
			} else {
				$this->_set_message('error', 'Failed to create new variation.');
				redirect(base_url('administrator/variations/add'), 'refresh');
			}
		}
	}

	public function edit($id)
	{
		if ($id === 'all') {
			$data = $this->variations_model->get(['product_variations.product_id' => wah_decode(input_get('id'))]);
			if (!$data->num_rows()) redirect(base_url('administrator/variations'), 'refresh');
			$data = $data->result();
		} else {
			$data = $this->variations_model->get(['product_variations.id' => wah_decode($id)]);
			if (!$data->num_rows()) redirect(base_url('administrator/variations'), 'refresh');
			$data = $data->row();
		}

		if (!$this->input->post()) {
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['message'] = ($this->ion_auth->errors() ? $this->_show_message('error', $this->ion_auth->errors()) : $this->_show_message('error', validation_errors()));
			$this->data['data'] = $data;
			$this->_render_page('variations/edit', $this->data);
		} else {
			if ($this->_valid_csrf_nonce() === FALSE) show_error($this->lang->line('error_csrf'));

			$input = array(
				'id' => $this->input->post('id[]'),
				'variation_code' => $this->input->post('variation_code[]'),
				'variation_name' => $this->input->post('variation_name[]'),
				'variation_price' => $this->input->post('variation_price[]'),
				'additional_price' => $this->input->post('additional_price[]'),
				'status' => $this->input->post('status[]'),
			);
			
			$field = array();
			foreach ($input as $key => $value) {
				foreach ($value as $k => $v) {
					$field[$k]['updated_at'] = date('Y-m-d H:i:s');
					$field[$k][$key] = $v;
				}
			}

			$save = 0;
			foreach ($field as $row) {
				$idf = wah_decode($row['id']);
				unset($row['id']);
				if ($id === 'all') {
					$this->variations_model->set($row, ['product_variations.id' => $idf, 'product_variations.product_id' => wah_decode(input_get('id'))]);
				} else {
					$this->variations_model->set($row, ['product_variations.id' => $idf]);
				}
				$save++;
			}

			if ($save > 0) {
				$this->_set_message('success', 'This variation has been updated successfully.');
			} else {
				$this->_set_message('error', 'Failed to update variation.');
			}
			
			if ($id === 'all') {
				redirect(base_url('administrator/variations/edit/all?id=' . input_get('id')), 'refresh');
			} else {
				redirect(base_url('administrator/variations/edit/' . $id), 'refresh');
			}
		}
	}

	public function delete($id)
	{
		$data = $this->variations_model->get(['product_variations.id' => wah_decode($id)]);
		$product_id = $data->row()->product_id;
		if (!$data->num_rows()) redirect(base_url('administrator/variations'), 'refresh');

		if ($this->variations_model->unset(['product_variations.id' => $data->row()->id])) {
			$this->_set_message('success', 'This variation has been deleted successfully.');
		} else {
			$this->_set_message('error', 'Failed to delete variation.');
		}
		redirect(base_url('administrator/variations/?id='.wah_encode($product_id)), 'refresh');
	}

	public function export_excel()
	{
		$title = 'Export Variations ' . date('d M Y');
		$data = $this->variations_model->get()->result();

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
		$title = 'Export Variations ' . date('d M Y');
		$data = $this->variations_model->get()->result();

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

	public function get_data()
	{
		$category = (input_get('cat') ? input_get('cat') : false);
		$option = (input_get('opt') ? input_get('opt') : false);
		echo pricelist($category, $option);
	}
}
