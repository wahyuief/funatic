<div class="bg-dark m-auto ps-3 pe-3 pt-5 pb-1 text-white">
	<div class="fs-4 m-0">
		<span class="bg-semiblack badge">
			<i class="fas fa-caret-right text-red"></i>
		</span>
		<h2 class="align-text-bottom d-inline fs-4">Data Invoice #<?php echo $invoice->no_invoice; ?></h2>
		<hr>
	</div>
</div>
<div class="row bg-dark m-auto pt-1 pb-5 text-white justify-content-center">
    <div class="col-sm-8">
        <div class="card bg-semiblack">
            <div class="card-body">
                <?php if(!$invoice->status_payment && $invoice->payment_expired > time()): ?>
                <div class="p-3 bg-dark text-white mb-3 rounded text-center">
                    Harap Dibayar Sebelum: <span class="text-danger fw-bold d-block fs-4"><?php echo date('H:i, d F Y', $invoice->payment_expired) ?></span>
                </div>
                <?php else: ?>
                <div class="p-3 bg-dark text-white mb-3 rounded text-center">
                    Tanggal Order: <span class="fw-bold d-block fs-4"><?php echo date('H:i, d F Y', strtotime($invoice->created_at)) ?></span>
                </div>
                <?php endif; ?>
                <table class="table text-white mb-4">
                    <tr>
                        <td>No. Invoice</td>
                        <td><?php echo '#'.$invoice->no_invoice; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Produk</td>
                        <td><?php echo $data->product; ?></td>
                    </tr>
                    <tr>
                        <td>Data Produk</td>
                        <td><?php echo $data->variation_name; ?></td>
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
                        <td><?php echo $invoice->payment_name; ?></td>
                    </tr>
                    <?php if($invoice->payment_expired > time()): if(!empty($invoice->pay_url)): ?>
                    <tr>
                        <td>No. Telp</td>
                        <td><?php echo $buyer->phone; ?></td>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <td>Kode Pembayaran</td>
                        <td><?php echo $invoice->pay_code; ?></td>
                    </tr>
                    <?php endif;endif; ?>
                    <tr>
                        <td>Status Pembayaran</td>
                        <td><?php echo ($invoice->status_payment ? '<span class="badge bg-success">Pembayaran Berhasil</span>' : ($invoice->payment_expired < time() ? '<span class="badge bg-danger text-black">Kedaluwarsa</span>' : '<span class="badge bg-warning text-black">Belum Bayar</span>')); ?></td>
                    </tr>
                    <tr>
                        <td>Status Transaksi</td>
                        <td><?php echo ($invoice->status_transaction ? '<span class="badge bg-success">Transaksi Berhasil</span>' : ($invoice->payment_expired < time() ? '<span class="badge bg-danger text-black">Gagal</span>' : (!empty($invoice->transaction_id) ? '<span class="badge bg-info text-black">Sedang Diproses</span>' : '<span class="badge bg-warning text-black">Belum Diproses</span>'))); ?></td>
                    </tr>
                    <tr>
                        <td>Total Tagihan</td>
                        <td><?php echo rupiah($invoice->total_price); ?></td>
                    </tr>
                </table>
                <?php if($invoice->payment_expired > time()): ?>
                <?php if(!empty($invoice->pay_url)): ?>
                <div class="text-center mb-4">
                    <a href="<?php echo $invoice->pay_url; ?>" class="btn w-100 btn-warning"><i class="fas fa-paper-plane"></i> Lanjutkan Pembayaran</a>
                </div>
                <?php endif;$instructions = instruction($data->payment, $invoice->pay_code, (int)$invoice->total_price);if(is_array($instructions)): ?>
                <div class="bg-dark p-3 rounded">
                    <h4 class="fs-5">Cara Pembayaran</h4>
                    <div class="accordion accordion-dark" id="instruksipembayaran">
                        <?php foreach($instructions as $instruction): ?>
                        <div class="accordion-item">
                            <h4 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo str_replace(' ', '', $instruction['title']); ?>" aria-expanded="false" aria-controls="instruksipembayaran">
                                    <?php echo $instruction['title']; ?>
                                </button>
                            </h4>
                            <div id="<?php echo str_replace(' ', '', $instruction['title']); ?>" class="accordion-collapse collapse show" data-bs-parent="#instruksipembayaran">
                                <div class="accordion-body">
                                    <ol>
                                        <?php foreach($instruction['steps'] as $step): ?>
                                        <li><?php echo $step ?></li>
                                        <?php endforeach; ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif;endif; ?>
            </div>
        </div>
    </div>
</div>
<?php if(!$invoice->status_payment && $invoice->payment_expired > time()): ?><script>setTimeout(() => {location.reload()}, 30000);</script><?php else: ?><script>setTimeout(() => {location.reload()}, 60000);</script><?php endif; ?>