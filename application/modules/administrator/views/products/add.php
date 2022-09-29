<section class="content">
      <div class="container-fluid">
            <?php echo form_open_multipart();?>
            <div class="row">
                  <div class="col-sm-8">
                        <div class="card card-<?php echo get_option('accent_color') ?> card-outline">
                              <div class="card-body rounded login-card-body">
                                    <div class="mb-3 input-group">
                                          <input type="text" name="title" id="title" value="<?php echo $this->form_validation->set_value('title'); ?>" class="form-control" autofocus required>
                                          <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-heading"></i></div>
                                          </div>
                                    </div>
                                    <textarea name="content" id="content" required hidden><?php echo $this->form_validation->set_value('content'); ?></textarea>
                                    <div id="fb-customfield"></div>
                                    <textarea name="customfield" id="customfield" hidden><?php echo $this->form_validation->set_value('custom_field'); ?></textarea>
                              </div>
                        </div>
                  </div>
                  <div class="col-sm-4">
                        <div class="card card-<?php echo get_option('accent_color') ?> card-outline">
                              <div class="card-body">
                                    <?php echo form_hidden($csrf); ?>
                                    <div class="mb-3 btn-group w-100">
                                          <button type="submit" name="submit" value="publish" class="btn btn-sm btn-<?php echo get_option('accent_color') ?>"><i class="fas fa-save mr-2"></i>Save & Publish</button>
                                    </div>
                                    <div class="mb-3">
                                          <label for="category">Category</label>
                                          <input type="text" name="category" id="category" value="<?php echo $this->form_validation->set_value('category'); ?>" class="form-control" required>
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
            onSave: function(evt, formData) {
                  console.log(evt, formData)
                  document.getElementById('customfield').textContent = formData
                  var notyf = new Notyf({position: {x:'right',y:'top'},dismissible:true});
                  notyf.success({message: "Custom Field Tersimpan!", duration:5000})
            }
      };
      $(document.getElementById('fb-customfield')).formBuilder(options);
</script>