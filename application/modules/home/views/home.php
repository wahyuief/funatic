<div id="carouselFunatic" class="carousel slide p-3 bg-semiblack">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselFunatic" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselFunatic" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselFunatic" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner bg-dark rounded-4">
        <div class="carousel-item active">
            <img src="<?php echo base_url('assets/funatic/images/valir.jpg') ?>" class="d-block w-100" alt="funatic">
        </div>
        <div class="carousel-item">
            <img src="<?php echo base_url('assets/funatic/images/valir.jpg') ?>" class="d-block w-100" alt="funatic">
        </div>
        <div class="carousel-item">
            <img src="<?php echo base_url('assets/funatic/images/valir.jpg') ?>" class="d-block w-100" alt="funatic">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselFunatic" data-bs-slide="prev">
        <span class="fas fa-arrow-alt-circle-left text-red fs-2" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselFunatic" data-bs-slide="next">
        <span class="fas fa-arrow-alt-circle-right text-red fs-2" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="bg-dark m-auto ps-3 pe-3 pt-5 pb-1 text-white">
	<div class="fs-4 widget m-0">
		<span class="bg-semiblack badge">
			<i class="fas fa-caret-right text-red"></i>
		</span>
		<h2 class="align-text-bottom d-inline fs-4">Mobile Legends</h2>
		<hr>
	</div>
</div>
<div class="row bg-dark m-auto pt-1 pb-5 text-white">
    <?php foreach ($products as $product): ?>
    <div class="col-6 col-sm-2">
        <a href="<?php echo base_url('order/'.$product->slug) ?>" class="product-home text-decoration-none">
            <div class="card bg-semiblack">
                <img src="<?php echo base_url('uploads/'.$product->featured_image) ?>" class="card-img-top" alt="...">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="position:absolute;bottom:75px;"><path fill="#111111" fill-opacity="1" d="M0,128L10.9,144C21.8,160,44,192,65,197.3C87.3,203,109,181,131,160C152.7,139,175,117,196,106.7C218.2,96,240,96,262,80C283.6,64,305,32,327,37.3C349.1,43,371,85,393,101.3C414.5,117,436,107,458,122.7C480,139,502,181,524,176C545.5,171,567,117,589,112C610.9,107,633,149,655,144C676.4,139,698,85,720,58.7C741.8,32,764,32,785,32C807.3,32,829,32,851,58.7C872.7,85,895,139,916,165.3C938.2,192,960,192,982,202.7C1003.6,213,1025,235,1047,208C1069.1,181,1091,107,1113,96C1134.5,85,1156,139,1178,176C1200,213,1222,235,1244,213.3C1265.5,192,1287,128,1309,112C1330.9,96,1353,128,1375,128C1396.4,128,1418,96,1429,80L1440,64L1440,320L1429.1,320C1418.2,320,1396,320,1375,320C1352.7,320,1331,320,1309,320C1287.3,320,1265,320,1244,320C1221.8,320,1200,320,1178,320C1156.4,320,1135,320,1113,320C1090.9,320,1069,320,1047,320C1025.5,320,1004,320,982,320C960,320,938,320,916,320C894.5,320,873,320,851,320C829.1,320,807,320,785,320C763.6,320,742,320,720,320C698.2,320,676,320,655,320C632.7,320,611,320,589,320C567.3,320,545,320,524,320C501.8,320,480,320,458,320C436.4,320,415,320,393,320C370.9,320,349,320,327,320C305.5,320,284,320,262,320C240,320,218,320,196,320C174.5,320,153,320,131,320C109.1,320,87,320,65,320C43.6,320,22,320,11,320L0,320Z"></path></svg>
                <div class="card-body text-center">
                    <h4 class="fs-6 text-white"><?php echo $product->title ?></h4>
                    <span class="fs-6 text-danger"><?php echo $product->category ?></span>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>
<script>
    const carouselFunatic = document.querySelector('#carouselFunatic')
    const carousel = new bootstrap.Carousel(carouselFunatic, {
        interval: 3000,
        keyboard: false,
        ride: true,
        wrap: true
    })
</script>