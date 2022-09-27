<section class="content">
    <div class="container-fluid">
        <div class="card card-<?php echo get_option('accent_color') ?> card-outline">
          <div class="card-header">
              <div class="card-title">
                <a href="<?php echo base_url('administrator/products/add'); ?>" class="btn btn-sm btn-<?php echo get_option('accent_color') ?>"><i class="fas fa-plus"></i> Add New</a>
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-<?php echo get_option('accent_color') ?> dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Export</button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item" href="<?php echo base_url('administrator/products/export_pdf'); ?>">PDF</a>
                      <a class="dropdown-item" href="<?php echo base_url('administrator/products/export_excel'); ?>">Excel</a>
                    </div>
                  </div>
              </div>
              <div class="card-tools w-25">
                <form method="get">
                  <div class="input-group input-group-sm">
                    <input type="text" name="q" class="form-control" value="<?php echo input_get('q') ?>" placeholder="Search..">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
          <div class="card-body p-0 table-responsive">
            <table class="table table-striped">
              <thead>
                  <tr>
                      <th width="5">#</th>
                      <th>Product Name</th>
                      <th width="150">Category</th>
                      <th width="150">Variations</th>
                      <th width="150">Created</th>
                      <th width="100" class="text-center">Action</th>
                  </tr>
              </thead>
              <tbody>
                  <?php if(!empty($data)): $i=1;foreach ($data as $row): ?>
                  <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $row->title; ?></td>
                      <td><?php echo $row->category; ?></td>
                      <td><?php echo ''; ?></td>
                      <td><?php echo date('d-M-Y, H:i', strtotime($row->created_at)); ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="#" class="text-lg text-dark" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis"></i></a>
                          <div class="dropdown-menu" role="menu" style="">
                            <a class="dropdown-item" href="<?php echo base_url('administrator/products/edit/' . wah_encode($row->id)); ?>">Edit</a>
                            <a class="dropdown-item" data-toggle="confirmation" data-title="Are you sure want to delete?"  data-placement="left" href="<?php echo base_url('administrator/products/delete/' . wah_encode($row->id)); ?>">Delete</a>
                          </div>
                        </div>
                      </td>
                  </tr>
                  <?php endforeach;else: ?>
                  <tr>
                    <td colspan="7">No data available</td>
                  </tr>
                  <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer border-top text-center row">
            <div class="col-sm-6"><p class="float-sm-left m-0" style="line-height: 2;">Showing <?php echo $start; ?> to <?php echo $end; ?> of <?php echo $total; ?> entries</p></div>
            <div class="col-sm-6">
            <?php echo yidas\widgets\Pagination::widget([
              'pagination' => $pagination,
              'ulCssClass' => 'pagination pagination-sm float-sm-right m-0'
            ]); ?>
            </div>
          </div>
        </div>
    </div>
</section>