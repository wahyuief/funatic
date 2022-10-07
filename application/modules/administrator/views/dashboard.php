<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $orders; ?></h3>

                <p>Pesanan</p>
              </div>
              <div class="icon">
                <i class="fas fa-cart-shopping"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $transaction_completed; ?></h3>

                <p>Transaksi Berhasil</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-line"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $payment_completed; ?></h3>

                <p>Pembayaran Berhasil</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $buyers; ?></h3>

                <p>Pembeli</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
	</div>
</section>