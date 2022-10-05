<?php defined('BASEPATH') OR exit('No direct script access allowed');

define('DEMO_MODE', false);

class Order extends FrontendController {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('products_model');
		$this->load->model('variations_model');
		$this->load->model('buyers_model');
		$this->load->model('orders_model');
    }

	public function index($slug)
	{
		$this->data['data'] = $product = $this->products_model->get(['slug' => $slug])->row();

		if (!$this->input->post()) {
			$this->data['message'] = $this->_show_message();
			$this->data['others'] = $this->products_model->get(['slug !=' => $slug, 'category' => $product->category])->result();
			$variations = array();
			foreach ($this->variations_model->get(['product_id' => $product->id, 'status' => 1])->result() as $variation) {
				$variation->total_price = $variation->variation_price + $variation->additional_price;
				$variations[] = $variation;
			}
			$this->data['variations'] = $variations;
			$this->data['channel'] = channel();
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->_render_page('order', $this->data);
		} else {
			if ($this->_valid_csrf_nonce() === FALSE) show_error($this->lang->line('error_csrf'));

			$customer_id_field = $product->customer_id_field;
			$customer_id = $this->input->post($customer_id_field);
			$phone = $this->input->post($product->phone_field);
			$quantity = ($this->input->post($product->quantity_field) ? $this->input->post($product->quantity_field) : 1);
			$variation_id = $this->input->post('varian');
			$payment = $this->input->post('payment');

			if (DEMO_MODE) {
				$output = array(
					'status' => false,
					'message' => 'Tidak dapat digunakan pada mode demo',
					'csrf' => array(
						'name' => $this->security->get_csrf_token_name(),
						'value' => $this->security->get_csrf_hash()
					)
				);
				echo json_encode($output);
				return;
			}

			if (strpos($product->category, 'Mobile Legends') !== false) {
				$mlbb = mlbb_validator($customer_id);
				if ($mlbb->code !== '200') {
					$output = array(
						'status' => false,
						'message' => 'ID tidak ditemukan',
						'csrf' => array(
							'name' => $this->security->get_csrf_token_name(),
							'value' => $this->security->get_csrf_hash()
						)
					);
					echo json_encode($output);
					return;
				}
				$nickname = $mlbb->result;
			}

			if ($product->quantity_active > 0) {
				$output = array(
					'status' => false,
					'message' => 'Mohon mengisi jumlah pembelian',
					'csrf' => array(
						'name' => $this->security->get_csrf_token_name(),
						'value' => $this->security->get_csrf_hash()
					)
				);
				echo json_encode($output);
				return;
			}

			if (!$this->input->post('varian')) {
				$output = array(
					'status' => false,
					'message' => 'Mohon pilih varian produk',
					'csrf' => array(
						'name' => $this->security->get_csrf_token_name(),
						'value' => $this->security->get_csrf_hash()
					)
				);
				echo json_encode($output);
				return;
			}

			if (!$this->input->post('payment')) {
				$output = array(
					'status' => false,
					'message' => 'Mohon pilih metode pembayaran',
					'csrf' => array(
						'name' => $this->security->get_csrf_token_name(),
						'value' => $this->security->get_csrf_hash()
					)
				);
				echo json_encode($output);
				return;
			}

			$varian = $this->variations_model->get(['id' => wah_decode($variation_id)])->row();
			$channel = channel($payment);
			$price = $varian->variation_price + $varian->additional_price;
			$flatfee = $channel['fee_customer']['flat'];
			$percentfee = $channel['fee_customer']['percent'];
			$totalprice = $price + $flatfee;
			$totalprice = $totalprice + ($totalprice * ($percentfee/100));

			if ($channel['group'] === 'Virtual Account' && $totalprice < 10000) {
				$output = array(
					'status' => false,
					'message' => 'Metode pembayaran ini tidak dapat digunakan',
					'csrf' => array(
						'name' => $this->security->get_csrf_token_name(),
						'value' => $this->security->get_csrf_hash()
					)
				);
				echo json_encode($output);
				return;
			}

			$buyer_inputdata = array(
				'phone' => $phone,
				'buyer_data' => json_encode(array(
					'customer_id_field' => $customer_id_field,
					$customer_id_field => $customer_id,
					'nickname' => $nickname,
					'product' => $product->title,
					'category' => $product->category,
					'variation_code' => $varian->variation_code,
					'variation_name' => $varian->variation_name,
					'totalprice' => $totalprice,
					'payment' => $channel['code'],
					'ip_address' => get_ip_client()
				))
			);
			$buyer_id = $this->buyers_model->add($buyer_inputdata);

			if ($buyer_id > 0) {
				$no_invoice = 'FTC' . substr($phone, -4) . $buyer_id . mt_rand(100, 999);
				$payment_expired = time() + (60 * 60 * 2);
				$payment_input = array(
					'method' => $payment,
					'merchant_ref' => $no_invoice,
					'amount' => $totalprice,
					'customer_name' => substr($customer_id, 0, -4),
					'customer_email' => substr($customer_id, 0, -4) . '@funatic.id',
					'customer_phone' => (string)$phone,
					'order_items' => array(array(
						'name' => $product->title . ' ' . $varian->variation_name . ' ' . $product->category,
						'price' => (int)$price,
						'quantity' => (int)$quantity
					)),
					'callback_url' => base_url('callback/payment'),
					'return_url' => base_url('invoice/' . $no_invoice),
					'expired_time' => $payment_expired,
					'signature' => payment_signature($no_invoice, $totalprice)
				);
				$payment_created = create_payment($payment_input);
				if ($payment_created['success'] === true) {
					$order_input_db = array(
						'variation_id' => wah_decode($variation_id),
						'buyer_id' => $buyer_id,
						'payment_id' => $payment_created['data']['reference'],
						'no_invoice' => $no_invoice,
						'quantity' => $quantity,
						'total_price' => $totalprice,
						'payment_name' => $payment_created['data']['payment_name'],
						'pay_code' => $payment_created['data']['pay_code'],
						'pay_url' => $payment_created['data']['pay_url'],
						'checkout_url' => $payment_created['data']['checkout_url'],
						'payment_expired' => $payment_created['data']['expired_time']
					);
					$this->orders_model->add($order_input_db);
				}
			}
			
			$output = array(
				'status' => true,
				'message' => 'Berhasil melakukan pembelian',
				'invoice' => $no_invoice,
				'csrf' => array(
					'name' => $this->security->get_csrf_token_name(),
					'value' => $this->security->get_csrf_hash()
				)
			);
			
			echo json_encode($output);
		}
	}
}
