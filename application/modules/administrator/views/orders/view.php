<section class="content">
      <div class="container-fluid">
            <div class="row">
                  <div class="col-sm-12">
                        <div class="card card-<?php echo get_option('accent_color') ?> card-outline">
                              <div class="card-body rounded login-card-body">
                                    <table class="table">
                                          <tr>
                                                <td>No. Invoice</td>
                                                <td><?php echo '#'.$order->no_invoice; ?></td>
                                          </tr>
                                          <tr>
                                                <td>Transaction ID</td>
                                                <td><?php echo $order->transaction_id; ?></td>
                                          </tr>
                                          <tr>
                                                <td>Payment ID</td>
                                                <td><?php echo $order->payment_id; ?></td>
                                          </tr>
                                          <tr>
                                                <td>Nama Produk</td>
                                                <td><?php echo $data->product . ' - ' . $product->category; ?></td>
                                          </tr>
                                          <tr>
                                                <td>Data Produk</td>
                                                <td><?php echo $data->variation_name; ?></td>
                                          </tr>
                                          <tr>
                                                <td>Quantity</td>
                                                <td><?php echo $order->quantity; ?></td>
                                          </tr>
                                          <tr>
                                                <td>Customer ID</td>
                                                <td><?php $customer_id_field = $product->customer_id_field;echo $data->$customer_id_field; ?></td>
                                          </tr>
                                          <tr>
                                                <td>Customer Name</td>
                                                <td><?php echo $data->nickname; ?></td>
                                          </tr>
                                          <tr>
                                                <td>Metode Pembayaran</td>
                                                <td><?php echo $order->payment_name; ?></td>
                                          </tr>
                                          <tr>
                                                <td>No. Telp</td>
                                                <td><?php echo $buyer->phone; ?></td>
                                          </tr>
                                          <tr>
                                                <td>Kode Pembayaran</td>
                                                <td><?php echo $order->pay_code; ?></td>
                                          </tr>
                                          <tr>
                                                <td>Status Pembayaran</td>
                                                <td><?php echo ($order->status_payment ? '<span class="badge bg-success">Pembayaran Berhasil</span>' : ($order->payment_expired < time() ? '<span class="badge bg-danger text-black">Kedaluwarsa</span>' : '<span class="badge bg-warning text-black">Belum Bayar</span>')); ?></td>
                                          </tr>
                                          <tr>
                                                <td>Status Transaksi</td>
                                                <td><?php echo ($order->status_transaction ? '<span class="badge bg-success">Transaksi Berhasil</span>' : ($order->payment_expired < time() ? '<span class="badge bg-danger text-black">Gagal</span>' : (!empty($order->transaction_id) ? '<span class="badge bg-info text-black">Sedang Diproses</span>' : '<span class="badge bg-warning text-black">Belum Diproses</span>'))); ?></td>
                                          </tr>
                                          <tr>
                                                <td>Total Tagihan</td>
                                                <td><?php echo rupiah($order->total_price); ?></td>
                                          </tr>
                                          <tr>
                                                <td>Notes</td>
                                                <td><?php echo $order->keterangan; ?></td>
                                          </tr>
                                          <tr>
                                                <td>Payment Expired</td>
                                                <td><?php echo date('H:i, d F Y', $order->payment_expired); ?></td>
                                          </tr>
                                          <tr>
                                                <td>Transaction Date</td>
                                                <td><?php echo date('H:i, d F Y', strtotime($order->created_at)); ?></td>
                                          </tr>
                                          <tr>
                                                <td>IP Address</td>
                                                <td><?php echo $data->ip_address; ?></td>
                                          </tr>
                                    </table>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>