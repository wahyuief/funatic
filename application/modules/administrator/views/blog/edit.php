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
                                          <input type="text" name="category" id="category" value="<?php echo $this->form_validation->set_value('category', $data->category); ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                          <label for="tags">Tags</label>
                                          <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                                                <?php if ($data->tags) {
                                                      foreach (explode(', ', $data->tags) as $tag) {
                                                            echo '<option value="'.$tag.'" selected>'.$tag.'</option>';
                                                      }
                                                } ?>
                                          </select>
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
                                    <label for="meta_title">Meta Title</label>
                                    <div class="mb-3">
                                          <input type="text" name="meta_title" id="meta_title" value="<?php echo $this->form_validation->set_value('meta_title', $data->meta_title); ?>" class="form-control">
                                          <div class="text-sm text-muted"><span id="count_metatitle">0</span> characters. The ideal length for the meta title is 50-60 characters.</div>
                                    </div>
                                    <label for="meta_description">Meta Description</label>
                                    <div class="mb-3">
                                          <textarea name="meta_description" id="meta_description" class="form-control"><?php echo $this->form_validation->set_value('meta_description', $data->meta_description); ?></textarea>
                                          <div class="text-sm text-muted"><span id="count_metadesc">0</span> characters. The ideal length for the meta description is 155-160 characters.</div>
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
      var meta_title = document.getElementById('meta_title');
      var title = document.getElementById('title');
      title.addEventListener('focusout', function(){
            document.getElementById('meta_title').value = title.value + ' - ' + site_name;
            document.getElementById('count_metatitle').textContent = meta_title.value.length;
      })
      meta_title.addEventListener('keyup', function(){
            document.getElementById('count_metatitle').textContent = meta_title.value.length;
      })
      var meta_description = document.getElementById('meta_description');
      meta_description.addEventListener('keyup', function(){
            document.getElementById('count_metadesc').textContent = meta_description.value.length;
      })
</script>