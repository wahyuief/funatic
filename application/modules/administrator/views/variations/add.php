<section class="content">
      <div class="container-fluid">
            <div class="card card-<?php echo get_option('accent_color') ?> card-outline">
                  <?php echo form_open(base_url('administrator/variations/add/?id=') . input_get('id'));?>
                  <div class="card-body rounded login-card-body">
                        <div class="row mb-3">
                              <label for="category" class="col-sm-2 form-label wahlabel">Category<i class="required">*</i></label>
                              <div class="col-sm-8">
                                    <select id="category" class="form-control">
                                          <option value="" disabled selected>Select Category</option>
                                          <?php foreach(json_decode(pricelist()) as $price): ?>
                                                <option value="<?php echo $price ?>"><?php echo $price ?></option>
                                          <?php endforeach; ?>
                                    </select>
                              </div>
                        </div>
                        <div class="row mb-3">
                              <label for="subcategory" class="col-sm-2 form-label wahlabel">Subcategory<i class="required">*</i></label>
                              <div class="col-sm-8">
                                    <select id="subcategory" class="form-control">
                                          <option value="" disabled selected>Select Subcategory</option>
                                    </select>
                              </div>
                        </div>
                        <div class="table-responsive">
                              <table id="data" class="table table-striped">
                                    <thead>
                                          <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Price+</th>
                                                <th>Status</th>
                                                <th></th>
                                          </tr>
                                    </thead>
                                    <tbody id="databody">
                                          <tr>
                                                <td colspan="6">Data is not available</td>
                                          </tr>
                                    </tbody>
                              </table>
                              <a href="javascript:void(0);" onclick="addData()"><i class="fas fa-plus"></i> Add New Data</a>
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
<script>
      $('#category').on('change', function(){
            $.get(base_url + "administrator/variations/get_data?cat="+$(this).val(), function(data, status){
                  $('#subcategory').html('<option value="" disabled selected>Select Subcategory</option>')
                  data = JSON.parse(data)
                  data.forEach(data => {
                        $('#subcategory').append($(new Option(data, data)).html(data))
                  });
            });
      })
      $('#subcategory').on('change', function(){
            $('#databody').html('<tr><td colspan="6">Loading..</td></tr>')
            setTimeout(() => {
                  $.get(base_url + "administrator/variations/get_data?cat="+$('#category').val()+"&opt="+$(this).val(), function(data, status){
                        data = JSON.parse(data)
                        if (!$('#databody').children().attr('id')) {
                              $('#databody').html('')
                        }
                        data.forEach(data => {
                              $('#databody').append(
                                    `<tr id="`+data.product_code+`">
                                          <td><input type="text" name="variation_code[]" id="variation_code" class="form-control" value="`+data.product_code+`" required readonly></td>
                                          <td><input type="text" name="variation_name[]" id="variation_name" class="form-control" value="`+data.product_name+`" required></td>
                                          <td><input type="number" name="variation_price[]" id="variation_price" class="form-control" value="`+(data.product_price ? data.product_price : data.product_regular_price)+`" readonly required></td>
                                          <td><input type="number" name="additional_price[]" id="additional_price" class="form-control" value="0"></td>
                                          <td><select name="status[]" id="status" class="form-control" required><option value="1">Active</option><option value="0">Inactive</option></select></td>
                                          <td><a href="javascript:void(0);" onclick="removeData('`+data.product_code+`')" style="line-height:2.4;"><i class="fas fa-times"></i></a></td>
                                          <td class="d-none"><input type="hidden" name="fromwhere[]" id="fromwhere" class="form-control" value="thirdparty"></td>
                                    </tr>`
                              )
                        });
                  });
            }, 500);
      })
      function removeData(id) {
            if ($('#databody').children().length <= 1) {
                  $('#databody').html('<tr><td colspan="6">Data is not available</td></tr>')
            }
            $("#"+id).remove()
      }
      function addData() {
            if (!$('#databody').children().attr('id')) {
                  $('#databody').html('')
            }
            let randomID = (Math.random() + 1).toString(36).substring(7);
            $('#databody').append(
                  `<tr id="`+randomID+`">
                        <td><input type="text" name="variation_code[]" id="variation_code" class="form-control" required></td>
                        <td><input type="text" name="variation_name[]" id="variation_name" class="form-control" required></td>
                        <td><input type="number" name="variation_price[]" id="variation_price" class="form-control" required></td>
                        <td><input type="number" name="additional_price[]" id="additional_price" class="form-control" value="0" required></td>
                        <td><select name="status[]" id="status" class="form-control" required><option value="1">Active</option><option value="0">Inactive</option></select></td>
                        <td><a href="javascript:void(0);" onclick="removeData('`+randomID+`')" style="line-height:2.4;"><i class="fas fa-times"></i></a></td>
                        <td class="d-none"><input type="hidden" name="fromwhere[]" id="fromwhere" class="form-control" value="myself"></td>
                  </tr>`
            )
      }
</script>