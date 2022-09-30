<div class="bg-dark m-auto ps-3 pe-3 pt-5 pb-1 text-white">
	<div class="fs-4 m-0">
		<span class="bg-semiblack badge">
			<i class="fas fa-caret-right text-red"></i>
		</span>
		<h2 class="align-text-bottom d-inline fs-4">Check Invoice</h2>
		<hr>
	</div>
</div>
<div class="row bg-dark m-auto pt-1 pb-5 text-white justify-content-center">
    <div class="col-sm-6">
        <div class="card bg-semiblack">
            <div class="card-body">
                <?php echo form_open(); ?>
                <div class="mb-3">
                    <label for="no_invoice" class="form-label">No. Invoice</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-file-invoice"></i></span>
                        <input type="text" class="form-control" id="no_invoice" placeholder="FTC3491XXXXX">
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-search"></i> Check</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>