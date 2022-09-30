<section class="content">
      <div class="container-fluid">
            <?php echo form_open_multipart();?>
            <div class="row">
                  <div class="col-sm-8">
                        <div class="card card-<?php echo get_option('accent_color') ?> card-outline">
                              <div class="card-body rounded login-card-body">
                                    <div class="mb-3 input-group">
                                          <input type="text" name="title" id="title" value="<?php echo $this->form_validation->set_value('title', $data->title); ?>" class="form-control" autofocus required>
                                          <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-heading"></i></div>
                                          </div>
                                    </div>
                                    <textarea name="content" id="content" required hidden><?php echo $this->form_validation->set_value('content', $data->content); ?></textarea>
                                    <div id="fb-customfield"></div>
                                    <textarea name="customfield" id="customfield" hidden><?php echo $this->form_validation->set_value('custom_field', $data->custom_field); ?></textarea>
                              </div>
                        </div>
                  </div>
                  <div class="col-sm-4">
                        <div class="card card-<?php echo get_option('accent_color') ?> card-outline">
                              <div class="card-body">
                                    <?php echo form_hidden('id', wah_encode($data->id));?>
                                    <?php echo form_hidden($csrf); ?>
                                    <div class="mb-3 btn-group w-100">
                                          <button type="submit" name="submit" value="draft" class="btn btn-sm btn-default"><i class="fas fa-save mr-2"></i>Save to Draft</button>
                                          <button type="submit" name="submit" value="publish" class="btn btn-sm btn-<?php echo get_option('accent_color') ?>"><i class="fas fa-save mr-2"></i>Save & Publish</button>
                                    </div>
                                    <div class="mb-3">
                                          <label for="category">Category</label>
                                          <input type="text" name="category" id="category" value="<?php echo $this->form_validation->set_value('category', $data->category); ?>" class="form-control" required>
                                    </div>
                                    <label for="featured_image">Featured Image</label>
                                    <div class="mb-3 input-group">
                                          <input type="file" name="featured_image" id="featured_image" class="form-control">
                                          <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-image"></i></div>
                                          </div>
                                    </div>
                                    <div id="divpreview" class="mb-2">
                                          <img src="<?php echo ($data->featured_image ? base_url('uploads/' . $data->featured_image) : '#') ?>" alt="preview" id="preview" class="img-thumbnail">
                                    </div>
                                    <h5 class="text-bold">Settings</h5>
                                    <div class="mb-3">
                                          <label for="quantity_active" class="font-weight-normal">
                                                <input type="checkbox" name="quantity_active" id="quantity_active" <?php echo ($data->quantity_active ? 'checked' : '') ?> value="<?php echo $this->form_validation->set_value('quantity_active', 1); ?>"> Activate purchase using quantity
                                          </label>
                                    </div>
                                    <div id="section-quantity_field" class="mb-3">
                                          <label for="quantity_field">Quantity Field</label>
                                          <select name="quantity_field" id="quantity_field" class="form-control">
                                                <option value="" disabled selected>Select Quantity Field</option>
                                                <?php
                                                      foreach (json_decode($data->custom_field) as $field) {
                                                            echo '<option '.($field->name === $data->quantity_field ? 'selected' : '').' value="'.$field->name.'">'.$field->label.' ('.$field->name.')</option>';
                                                      }
                                                ?>
                                          </select>
                                    </div>
                                    <div class="mb-3">
                                          <label for="customer_id_field">Customer ID Field</label>
                                          <select name="customer_id_field" id="customer_id_field" class="form-control" <?php echo ($data->custom_field ? 'required' : '') ?>>
                                                <option value="" disabled selected>Select Customer ID Field</option>
                                                <?php
                                                      foreach (json_decode($data->custom_field) as $field) {
                                                            echo '<option '.($field->name === $data->customer_id_field ? 'selected' : '').' value="'.$field->name.'">'.$field->label.' ('.$field->name.')</option>';
                                                      }
                                                ?>
                                          </select>
                                          <small>This option is from custom field</small>
                                    </div>
                                    <div class="mb-3">
                                          <label for="phone_field">Phone Number Field</label>
                                          <select name="phone_field" id="phone_field" class="form-control" <?php echo ($data->custom_field ? 'required' : '') ?>>
                                                <option value="" disabled selected>Select Phone Number Field</option>
                                                <?php
                                                      foreach (json_decode($data->custom_field) as $field) {
                                                            echo '<option '.($field->name === $data->phone_field ? 'selected' : '').' value="'.$field->name.'">'.$field->label.' ('.$field->name.')</option>';
                                                      }
                                                ?>
                                          </select>
                                          <small>This option is from custom field</small>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <?php echo form_close();?>
      </div>
</div>
<script>
      <?php if(empty($data->featured_image)): ?>divpreview.style.display = 'none';<?php endif; ?>
      featured_image.onchange = evt => {
            const [file] = featured_image.files
            if (file) {
                  divpreview.style.display = 'block';
                  preview.src = URL.createObjectURL(file)
            }
      }
      $(document).ready(function() {
            $('#content').summernote({
                  placeholder: 'Tulis konten disini..',
                  height: 400
            });
      });

      var options = {
            roles: false,
            controlPosition: 'left',
            disableFields: ['autocomplete', 'button', 'file', 'textarea'],
            disabledAttrs: ['access'],
            disabledActionButtons: ['data'],
            formData: '<?php echo $this->form_validation->set_value('custom_field', $data->custom_field); ?>',
            onSave: function(evt, formData) {
                  console.log(evt, formData)
                  document.getElementById('customfield').textContent = formData
                  var notyf = new Notyf({position: {x:'right',y:'top'},dismissible:true});
                  notyf.success({message: "Custom Field Tersimpan!", duration:5000})
            }
      };
      $(document.getElementById('fb-customfield')).formBuilder(options);

      <?php echo ($data->quantity_active ? '' : "$('#section-quantity_field').hide();") ?>
      $('#quantity_active').change(function () {
      if (!this.checked) {
            $('#quantity_field').removeAttr('required');
            $('#section-quantity_field').hide();
      } else {
            $('#quantity_field').attr('required', true);
            $('#section-quantity_field').show();
      }
    });
</script>