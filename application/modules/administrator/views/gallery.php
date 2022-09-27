<section class="content">
    <div class="container-fluid">
        <div class="card card-<?php echo get_option('accent_color') ?> card-outline">
            <div class="card-header">
                <div class="card-title">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#addNew" class="btn btn-sm btn-<?php echo get_option('accent_color') ?>"><i class="fas fa-plus"></i> Add New</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                <?php if (is_array($images) && count($images) > 0): foreach ($images as $image): $filename = pathinfo($image['full']) ?>
                <div class="col-sm-2">
                <img class="image mr-3 mb-3 img-thumbnail elevation-2" src="<?php echo $image['full'] ?>" alt="<?php echo $filename['filename'] ?>"/>
                </div>
                <?php endforeach;endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="addNew" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <?php echo form_open_multipart(); ?>
                <input type="file" id="image" accept=".png, .jpg, .jpeg" hidden>
                <label for="image" class="image-form">
                    <i class="fas fa-image"></i>
                    Upload Image
                </label>
                <?php echo form_hidden($csrf); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<style>
    .image-form {
        width: 100%;
        height: 250px;
        line-height: 250px;
        margin: 0 auto;
        text-align: center;
        border: 2px solid #555;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
<script>
    $('#image').on('change', function() {
        var image = document.getElementById('image');
        var preview = document.getElementsByClassName('image-form')[0];
        var csrf1 = document.getElementsByTagName('input')[0];
        var csrf1_name = csrf1.getAttribute('name');
        var csrf1_value = csrf1.getAttribute('value');
        var csrf2 = document.getElementsByTagName('input')[2];
        var csrf2_name = csrf2.getAttribute('name');
        var csrf2_value = csrf2.getAttribute('value');
        var formData = new FormData();
        formData.append(csrf1_name, csrf1_value);
        formData.append(csrf2_name, csrf2_value);
        formData.append('file', image.files[0]);
        const [file] = image.files
        if (file) {
            preview.innerHTML = '<img src="' + URL.createObjectURL(file) + '" style="width:200px;height:200px;object-fit: cover;">';
            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                url: base_url + 'administrator/gallery/upload',
                data: formData,
                success:function(data) {
                    window.location.replace(window.location.href);
                }
            })
        }
    })
</script>