<div class="bg-dark m-auto ps-3 pe-3 pt-3 pb-1 text-white">
	<div class="fs-4 m-0">
		<span class="bg-semiblack badge">
			<i class="fas fa-caret-right text-red"></i>
		</span>
		<h1 class="align-text-bottom d-inline fs-4">Blog</h1>
		<hr>
	</div>
</div>
<div class="row bg-dark m-auto pt-1 pb-5 text-white">
    <div class="col-sm-8">
        <?php if ($blogs): foreach ($blogs as $blog): ?>
        <div class="card bg-semiblack mb-3">
            <?php if ($blog->featured_image): ?>
            <div class="row g-0">
                <div class="col-sm-4">
                    <?php echo '<a href="'.base_url('blog/'. $blog->slug).'" title="'.$blog->title.'" class="text-decoration-none"><img src="'.base_url('uploads/' . $blog->featured_image).'" alt="'.$blog->title.'" class="img-fluid rounded h-100"></a>' ?>
                </div>
                <div class="col-sm-8">
                    <div class="card-header pb-1">
                        <h2 class="fs-4 m-0"><a href="<?php echo base_url('blog/'. $blog->slug) ?>" title="<?php echo $blog->title ?>" class="text-decoration-none"><?php echo $blog->title ?></a></h2>
                    </div>
                    <div class="card-body pt-1">
                        <?php echo substr(strip_tags($blog->content), 0, 250) ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="card-header pb-1">
                <h2 class="fs-4 m-0"><a href="<?php echo base_url('blog/'. $blog->slug) ?>" title="<?php echo $blog->title ?>" class="text-decoration-none"><?php echo $blog->title ?></a></h2>
            </div>
            <div class="card-body pt-1">
                <?php echo substr(strip_tags($blog->content), 0, 250) ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach;else: ?>
        <div class="card bg-semiblack mb-3">
            <div class="card-body text-center">
                Artikel tidak ditemukan
            </div>
        </div>
        <?php endif;if ($count_page > $limit): ?>
        <nav>
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link bg-semiblack text-danger border-0" <?php if($page > 1){ echo "href='?page=$prev'"; } ?>>Previous</a>
				</li>
				<?php for($i = 1; $i < $count_page; $i++){ ?> 
					<li class="page-item"><a class="page-link bg-semiblack text-danger border-0" href="?page=<?php echo $i ?>"><?php echo $i; ?></a></li>
                <?php } ?>				
				<li class="page-item">
					<a  class="page-link bg-semiblack text-danger border-0" <?php if($page < $count_page) { echo "href='?page=$next'"; } ?>>Next</a>
				</li>
			</ul>
		</nav>
        <?php endif; ?>
    </div>
    <div class="col-sm-4">
        <div class="card bg-semiblack">
            <div class="card-body">
                <form method="get">
                    <div class="input-group">
                        <input type="text" name="s" id="s" placeholder="Cari.." value="<?php echo(input_get('s') ? input_get('s') : '') ?>" class="form-control" required>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>