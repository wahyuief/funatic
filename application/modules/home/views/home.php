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
	<h2 class="widget m-0">
		<span class="bg-semiblack badge">
			<i class="fas fa-caret-right text-red"></i>
		</span>
		<span class="align-text-bottom">Mobile Legends</span>
		<hr>
	</h2>
</div>
<div class="row bg-dark m-auto pt-1 pb-5 text-white">
    <div class="col-sm-3">
        <div class="card bg-semiblack shadow-sm">
			<div class="card-body">
				Diamond Mobile Legend
			</div>
		</div>
    </div>
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