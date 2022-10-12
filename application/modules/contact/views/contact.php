<div class="bg-dark m-auto ps-3 pe-3 pt-3 pb-1 text-white">
	<div class="fs-4 widget m-0">
		<span class="bg-semiblack badge">
			<i class="fas fa-caret-right text-red"></i>
		</span>
		<h2 class="align-text-bottom d-inline fs-4">Contact Us</h2>
		<hr>
	</div>
</div>
<div class="row bg-dark m-auto pt-1 pb-5 text-white">
    <div class="col-sm-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.83091097555595!2d107.01129532522425!3d-6.355901628605819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69915e6a2fb095%3A0x41e7ccd8b30f484a!2sJl.%20Cipta%20Karya%2012%20No.35%2C%20RT.008%2FRW.007%2C%20Sumur%20Batu%2C%20Kec.%20Bantar%20Gebang%2C%20Kota%20Bks%2C%20Jawa%20Barat%2017154!5e0!3m2!1sen!2sid!4v1665566614533!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="col-sm-7">
        <form>
            <div class="mb-3">
                <label class="form-label" for="name">Nama</label>
                <input type="text" name="name" id="name" class="form-control bg-dark text-white" placeholder="Isi nama lengkap kamu..">
            </div>
            <div class="mb-3">
                <label class="form-label" for="message">Pesan / Informasi</label>
                <textarea name="message" id="message" rows="10" class="form-control bg-dark text-white" placeholder="Isi pesan / informasi yang ingin disampaikan.."></textarea>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-danger"><i class="fas fa-paper-plane"></i> Kirim</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('form').on('submit', function(e){
        e.preventDefault();
        var name = $('#name').val();
        var message = $('#message').val();
        var pesan = `Halo admin funatic, perkenalkan nama saya `+name+`, `+message
        window.open('https://api.whatsapp.com/send/?phone=6281383244812&text=' + pesan)
    })
</script>