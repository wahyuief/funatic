<section class="content">
      <div class="container-fluid">
            <div class="card card-<?php echo get_option('accent_color') ?> card-outline">
                  <?php echo (input_get('id') ? form_open(base_url('administrator/variations/edit/all?id=') . input_get('id')) : form_open());?>
                  <div class="card-body rounded login-card-body">
                        <div class="table-responsive">
                              <table id="data" class="table table-striped">
                                    <thead>
                                          <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Price+</th>
                                                <th>Status</th>
                                          </tr>
                                    </thead>
                                    <tbody id="databody">
                                          <?php if ($data): foreach($data as $field): ?>
                                          <tr id="<?php $id = wah_encode($field->id);echo $id; ?>">
                                                <td><input type="text" name="variation_code[]" id="variation_code" class="form-control" value="<?php echo $field->variation_code; ?>" readonly required></td>
                                                <td><input type="text" name="variation_name[]" id="variation_name" class="form-control" value="<?php echo $field->variation_name; ?>" required></td>
                                                <td><input type="number" name="variation_price[]" id="variation_price" class="form-control" value="<?php echo $field->variation_price; ?>" readonly required></td>
                                                <td><input type="number" name="additional_price[]" id="additional_price" class="form-control" value="<?php echo $field->additional_price; ?>" required></td>
                                                <td><select name="status[]" id="status" class="form-control" required><option <?php echo ($field->status === '1' ? 'selected' : ''); ?> value="1">Active</option><option <?php echo ($field->status === '0' ? 'selected' : ''); ?> value="0">Inactive</option></select></td>
                                                <td class="d-none"><input type="hidden" name="id[]" id="id" class="form-control" value="<?php echo $id; ?>"></td>
                                          </tr>
                                          <?php endforeach;else: ?>
                                          <tr>
                                                <td colspan="5">Data is not available</td>
                                          </tr>
                                          <?php endif; ?>
                                    </tbody>
                              </table>
                        </div>
                  </div>
                  <div class="card-footer border-top">
                        <?php echo form_hidden($csrf); ?>
                        <button type="submit" class="btn btn-sm btn-<?php echo get_option('accent_color') ?>"><i class="fas fa-save mr-2"></i>Save</button>
                        <a href="<?php echo base_url('administrator/variations/?id='.input_get('id')) ?>" class="btn btn-sm btn-default">Back</a>
                  </div>
                  <?php echo form_close();?>
            </div>
      </div>
</div>