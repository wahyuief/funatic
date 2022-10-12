<div class="bg-dark m-auto ps-3 pe-3 pt-3 pb-1 text-white">
	<div class="fs-4 m-0">
		<span class="bg-semiblack badge">
			<i class="fas fa-caret-right text-red"></i>
		</span>
		<h1 class="align-text-bottom d-inline fs-4"><?php echo $blog->title ?></h1>
		<hr>
	</div>
</div>
<div class="row bg-dark m-auto pt-1 pb-5 text-white justify-content-center">
    <div class="col-sm-12">
        <div class="card bg-semiblack">
            <div class="card-body">
                <?php if ($blog->featured_image): ?><div class="text-center mb-2">
                    <img src="<?php echo base_url('uploads/' . $blog->featured_image) ?>" alt="<?php echo $blog->title ?>" class="img-fluid w-25">
                </div><?php endif; ?>
                
                <?php echo $blog->content ?>
                <div class="meta mt-4">
                    <span class="me-1"><i class="fas fa-user"></i> <?php echo $blog->fullname ?></span> <span class="me-1"><i class="fas fa-tag"></i> <?php echo $blog->category ?></span> <span class="me-1"><i class="fas fa-calendar"></i> <?php echo date('d F Y', strtotime($blog->created_at)) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>