<nav class="navbar navbar-dark navbar-expand-lg bg-red-black rounded-top">
    <div class="container-fluid">
        <button class="navbar-toggler rounded-0 w-100 p-0 border-0 align-middle" type="button" data-bs-toggle="collapse" data-bs-target="#menuFunatic"
            aria-controls="menuFunatic" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fw-bold menu-text-toggle">MENU</span> <span class="fw-bold menu-text-toggle"><i class="fa-solid fa-bars-staggered"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="menuFunatic">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('invoice'); ?>"><i class="fas fa-file-invoice-dollar"></i> Invoice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('blog'); ?>"><i class="fas fa-newspaper"></i> Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('contact'); ?>"><i class="fas fa-envelope"></i> Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>"><i class="fas fa-cog"></i> Tools</a>
                </li>
            </ul>
        </div>
    </div>
</nav>