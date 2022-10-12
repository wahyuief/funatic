<div class="bg-dark m-auto ps-3 pe-3 pt-3 pb-1 text-white">
	<div class="fs-4 m-0">
		<span class="bg-semiblack badge">
			<i class="fas fa-caret-right text-red"></i>
		</span>
		<h2 class="align-text-bottom d-inline fs-4">Order <?php echo $data->title .' '. $data->category ?></h2>
		<hr>
	</div>
</div>
<div class="row bg-dark m-auto pt-1 pb-5 text-white">
    <div class="col-sm-4 mb-4">
        <div class="card border-0 bg-semiblack rounded-3 mb-4">
            <div class="card-body">
                <div class="text-center">
                    <img src="<?php echo base_url('uploads/'.$data->featured_image) ?>" class="rounded-3 w-50" alt="<?php echo $data->title ?>">
                </div>
                <p><?php echo $data->content ?></p>
            </div>
        </div>
        <?php if ($others): ?>
        <div class="card border-0 bg-semiblack rounded-3">
            <div class="card-header">
                <h3 class="fs-5">Mungkin Kamu Tertarik</h3>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <?php foreach ($others as $other): ?>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                        <img src="<?php echo base_url('uploads/'.$other->featured_image) ?>" class="rounded-3 w-25" alt="<?php echo $other->title ?>">
                        <h5 class="mb-1 fs-6 d-inline"><?php echo $other->title ?></h5>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="col-sm-8">
        <?php echo form_open().form_hidden($csrf); ?>
        <div class="card border-0 bg-semiblack rounded-3 mb-4">
            <div class="card-header bg-semiblack bt-1">
                <h3 class="fs-5">Pilih Varian</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($variations as $variation): $id = wah_encode($variation->id); ?>
                        <div class="col-6 col-sm-4 mb-2 ps-1 pe-1">
                            <label for="varian-<?php echo $id ?>" class="w-100">
                                <input type="radio" name="varian" id="varian-<?php echo $id ?>" value="<?php echo $id ?>" class="card-input-element" data-price="<?php echo $variation->total_price; ?>">
                                <div class="card border-0 bg-dark rounded-3 m-0 card-input varian">
                                    <div class="card-body p-2">
                                        <div class="varian-name <?php echo (strlen($variation->variation_name) >= 20 ? 'effect' : '' ); ?>"><?php echo $variation->variation_name; ?></div>
                                        <small class="varian-price"><?php echo rupiah($variation->total_price); ?></small>
                                    </div>
                                </div>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="card border-0 bg-semiblack rounded-3 mb-4">
            <div class="card-header bg-semiblack bt-1">
                <h3 class="fs-5">Metode Pembayaran</h3>
            </div>
            <div class="accordion accordion-dark" id="metodePembayaran">
                <div class="accordion-item" id="section-virtualAccount">
                    <h4 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#virtualAccount" aria-expanded="true" aria-controls="virtualAccount">
                            Virtual Account
                        </button>
                    </h4>
                    <div id="virtualAccount" class="accordion-collapse collapse" data-bs-parent="#metodePembayaran">
                        <div class="accordion-body">
                            <div class="row">
                                <?php foreach ($channel as $row): if ($row['group'] === 'Virtual Account' && $row['active'] === true): ?>
                                    <div class="col-6 col-sm-4 mb-2 ps-1 pe-1">
                                        <label for="payment-<?php echo strtolower($row['code']) ?>" class="w-100">
                                            <input type="radio" name="payment" id="payment-<?php echo strtolower($row['code']) ?>" value="<?php echo $row['code'] ?>" class="card-input-element" data-flatfee="<?php echo $row['fee_customer']['flat'] ?>" data-percentfee="<?php echo $row['fee_customer']['percent'].'%' ?>">
                                            <div class="card border-0 rounded-1 m-0 card-input payment payment-<?php echo strtolower($row['code']) ?>">
                                                <div class="card-header p-1">
                                                    <img src="<?php echo base_url('assets/img/' . strtolower($row['code']) .'.png') ?>" alt="<?php echo $row['code'] ?>" width="50" height="20">
                                                    <small id="totalprice" class="text-black float-end"></small>
                                                </div>
                                                <div class="card-body p-2 text-black">
                                                    <small class="payment-name d-block <?php echo (strlen($row['name']) >= 25 ? 'effect' : '' ); ?>"><?php echo $row['name'] ?></small>
                                                    <small>Dicek otomatis</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                <?php endif;endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" id="section-eWallet">
                    <h4 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#eWallet" aria-expanded="false" aria-controls="eWallet">
                            E-Wallet
                        </button>
                    </h4>
                    <div id="eWallet" class="accordion-collapse collapse" data-bs-parent="#metodePembayaran">
                        <div class="accordion-body">
                            <div class="row">
                                <?php foreach ($channel as $row): if ($row['group'] === 'E-Wallet' && $row['active'] === true): ?>
                                    <div class="col-6 col-sm-4 mb-2 ps-1 pe-1">
                                        <label for="payment-<?php echo strtolower($row['code']) ?>" class="w-100">
                                            <input type="radio" name="payment" id="payment-<?php echo strtolower($row['code']) ?>" value="<?php echo $row['code'] ?>" class="card-input-element" data-flatfee="<?php echo $row['fee_customer']['flat'] ?>" data-percentfee="<?php echo $row['fee_customer']['percent'].'%' ?>">
                                            <div class="card border-0 rounded-1 m-0 card-input payment payment-<?php echo strtolower($row['code']) ?>">
                                                <div class="card-header p-1">
                                                    <img src="<?php echo base_url('assets/img/' . strtolower($row['code']) .'.png') ?>" alt="<?php echo $row['code'] ?>" width="50" height="20">
                                                    <small id="totalprice" class="text-black float-end"></small>
                                                </div>
                                                <div class="card-body p-2 text-black">
                                                    <small class="payment-name d-block <?php echo (strlen($row['name']) >= 25 ? 'effect' : '' ); ?>"><?php echo $row['name'] ?></small>
                                                    <small>Dicek otomatis</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                <?php endif;endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" id="section-convenienceStore">
                    <h4 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#convenienceStore" aria-expanded="false" aria-controls="convenienceStore">
                            Convenience Store
                        </button>
                    </h4>
                    <div id="convenienceStore" class="accordion-collapse collapse" data-bs-parent="#metodePembayaran">
                        <div class="accordion-body">
                            <div class="row">
                                <?php foreach ($channel as $row): if ($row['group'] === 'Convenience Store' && $row['active'] === true): ?>
                                    <div class="col-6 col-sm-4 mb-2 ps-1 pe-1">
                                        <label for="payment-<?php echo strtolower($row['code']) ?>" class="w-100">
                                            <input type="radio" name="payment" id="payment-<?php echo strtolower($row['code']) ?>" value="<?php echo $row['code'] ?>" class="card-input-element" data-flatfee="<?php echo $row['fee_customer']['flat'] ?>" data-percentfee="<?php echo $row['fee_customer']['percent'].'%' ?>">
                                            <div class="card border-0 rounded-1 m-0 card-input payment payment-<?php echo strtolower($row['code']) ?>">
                                                <div class="card-header p-1">
                                                    <img src="<?php echo base_url('assets/img/' . strtolower($row['code']) .'.png') ?>" alt="<?php echo $row['code'] ?>" width="50" height="20">
                                                    <small id="totalprice" class="text-black float-end"></small>
                                                </div>
                                                <div class="card-body p-2 text-black">
                                                    <small class="payment-name d-block <?php echo (strlen($row['name']) >= 25 ? 'effect' : '' ); ?>"><?php echo $row['name'] ?></small>
                                                    <small>Dicek otomatis</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                <?php endif;endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-0 bg-semiblack rounded-3 mb-4">
            <div class="card-header bg-semiblack bt-1">
                <h3 class="fs-5">Lengkapi Data</h3>
            </div>
            <div class="card-body">
                <div id="lengkapidata"></div>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" id="submit" class="btn btn-warning"><i class="fas fa-shopping-cart"></i> Order Now</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    var fbRender = document.getElementById('lengkapidata'),
        formData = '<?php echo $data->custom_field ?>';

    var formRenderOpts = {
        formData,
        dataType: 'json',
        i18n: {
            locale: 'en-US',
            location: base_url + 'assets/funatic/lang/'
        }
    };

    $(fbRender).formRender(formRenderOpts);
    var notyf = new Notyf({position: {x:'right',y:'top'},dismissible:true});
    $('input[name=varian]').change(function(e){
        e.preventDefault(e);
        var price = $(this).data('price')
        for (let index = 0; index < $('input[name="payment"]').length; index++) {
            var payment_id = $('input[name="payment"]').eq(index).attr('id')
            var flatfee = $('#'+payment_id).data('flatfee')
            var percentfee = $('#'+payment_id).data('percentfee')
            var totalprice = parseInt(price) + parseInt(flatfee)
            totalprice = totalprice + parseInt(totalprice * (parseFloat(percentfee) / 100))
            $('.'+payment_id+' #totalprice').text(rupiah(totalprice))
        }
        if (price < 10000) {
            $('input[name="payment"]').prop('checked', false)
            $('#section-virtualAccount').hide();
        } else {
            $('#section-virtualAccount').show();
        }
    })
    $('form').submit(function(e){
        e.preventDefault(e);
        $('#submit').prop('disabled', true)
        $('#submit').html('<i class="fas fa-spinner"></i> Process..')
        var csrf = $('form').children('input:first-child')
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            success: function(data){
                data = JSON.parse(data)
                if (data.status === true) {
                    notyf.success({'message': data.message, 'duration': 5000})
                    setTimeout(() => {
                        window.location.replace(base_url + 'invoice/' + data.invoice)
                    }, 1000);
                } else {
                    notyf.error({'message': data.message, 'duration': 5000})
                }
                
                csrf.attr('name', data.csrf.name)
                csrf.attr('value', data.csrf.value)
                setTimeout(() => {
                    $('#submit').html('<i class="fas fa-shopping-cart"></i> Order Now')
                    $('#submit').prop('disabled', false)
                }, 1000);
            }
        })
    })
    const rupiah = (number)=>{
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            maximumFractionDigits: 0
        }).format(number);
    }
</script>