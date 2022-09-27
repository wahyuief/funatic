<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-<?php echo get_option('accent_color') ?> card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center profile-card">
                            <img src="<?php echo base_url('assets/avatar/' . $user_sess->avatar); ?>" class="user-image profile-avatar img-circle elevation-2" alt="User Avatar" onerror="this.onerror=null;this.src='<?php echo base_url('assets/avatar/default.png'); ?>';">
                            <?php echo form_open_multipart(base_url('administrator/profile/change_avatar'), 'id="change-avatar" class="change-avatar"'); ?>
                            <label for="avatar"><i class="fa fa-upload"></i></label>
                            <input type="file" name="avatar" id="avatar" hidden>
                            <?php echo form_close(); ?>
                        </div>
                        <h3 class="profile-username text-center"><?php echo $user_sess->fullname ?></h3>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Group</b> <a class="float-right"><?php echo implode(', ', $group_user_sess); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Status</b> <a class="float-right"><?php echo ($user_sess->active) ? 'Active' : 'Inactive' ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Last Login</b> <a class="float-right"><?php echo date('d-M-Y, H:i', $user_sess->last_login) ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Date Created</b> <a class="float-right"><?php echo date('d-M-Y, H:i', $user_sess->created_on) ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>IP Address</b> <a class="float-right"><?php echo $user_sess->ip_address ?></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-<?php echo get_option('accent_color') ?> card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link <?php echo (!input_get('tab') || input_get('tab') === 'general') ? 'active' : ''; ?>" href="#general" data-toggle="tab">General</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo (input_get('tab') === 'security') ? 'active' : ''; ?>" href="#security" data-toggle="tab">Security</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane <?php echo (!input_get('tab') || input_get('tab') === 'general') ? 'active' : ''; ?>" id="general">
                                <?php echo form_open(); ?>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="username" id="username" value="<?php echo $this->form_validation->set_value('username', $user_sess->username); ?>" placeholder="Username" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $this->form_validation->set_value('email', $user_sess->email); ?>" placeholder="Email" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fullname" class="col-sm-2 col-form-label">Full Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $this->form_validation->set_value('fullname', $user_sess->fullname); ?>" placeholder="Full Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $this->form_validation->set_value('phone', $user_sess->phone); ?>" placeholder="Phone" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="company" class="col-sm-2 col-form-label">Company</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="company" id="company" value="<?php echo $this->form_validation->set_value('company', $user_sess->company); ?>" placeholder="Company">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <?php echo form_hidden($csrf); ?>
                                            <button type="submit" name="submit" value="general" class="btn btn-<?php echo get_option('accent_color') ?>">Save</button>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="tab-pane <?php echo (input_get('tab') === 'security') ? 'active' : ''; ?>" id="security">
                                <?php echo form_open(base_url('administrator/profile?tab=security')); ?>
                                    <div class="form-group row">
                                        <label for="oldpass" class="col-sm-3 col-form-label">Old Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="oldpass" id="oldpass" placeholder="Old Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newpass" class="col-sm-3 col-form-label">New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="newpass" id="newpass" placeholder="New Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirmpass" class="col-sm-3 col-form-label">Confirm New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="confirmpass" id="confirmpass" placeholder="Confirm New Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <?php echo form_hidden($csrf); ?>
                                            <button type="submit" name="submit" value="security" class="btn btn-<?php echo get_option('accent_color') ?>">Save</button>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>