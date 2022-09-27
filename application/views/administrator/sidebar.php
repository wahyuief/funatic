<aside class="main-sidebar sidebar-dark-<?php echo get_option('accent_color') ?> elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>" class="brand-link">
        <img src="<?php echo base_url('assets/backend/img/AdminLTELogo.png'); ?>" alt="<?php echo get_option('site_name'); ?> Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo get_option('site_name'); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-header text-sm">MAIN NAVIGATION</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('administrator/dashboard') ?>" class="nav-link <?php if ($this->uri->segment(2) === 'dashboard') echo 'active'; ?>">
                        <i class="nav-icon fas fa-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('administrator/notification') ?>" class="nav-link <?php if ($this->uri->segment(2) === 'notification') echo 'active'; ?>">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notification</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('administrator/blog') ?>" class="nav-link <?php if ($this->uri->segment(2) === 'blog') echo 'active'; ?>">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Blog</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('administrator/products') ?>" class="nav-link <?php if ($this->uri->segment(2) === 'products') echo 'active'; ?>">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('administrator/orders') ?>" class="nav-link <?php if ($this->uri->segment(2) === 'orders') echo 'active'; ?>">
                        <i class="nav-icon fas fa-cart-shopping"></i>
                        <p>Orders</p>
                    </a>
                </li>

                <li class="nav-header text-sm">ADMINISTRATOR</li>
                <li class="nav-item">
                    <a href="<?php echo base_url('administrator/users') ?>" class="nav-link <?php if ($this->uri->segment(2) === 'users') echo 'active'; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('administrator/groups') ?>" class="nav-link <?php if ($this->uri->segment(2) === 'groups') echo 'active'; ?>">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Groups</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('administrator/settings') ?>" class="nav-link <?php if ($this->uri->segment(2) === 'settings') echo 'active'; ?>">
                        <i class="nav-icon fas fa-gears"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<div class="content-wrapper">