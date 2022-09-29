<link rel="stylesheet" href="<?php echo base_url('assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
<script src="<?php echo base_url('assets/backend/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script>
$("form").validate({
    rules: {
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            minlength: 8
        },
        password_confirm: {
            required: true,
            equalTo: "#password"
        },
        terms: {
            required: true
        }
    },
    messages: {
        email: {
            required: "Please enter an email address",
            email: "Please enter a valid email address"
        },
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 8 characters long"
        },
        password_confirm: {
            required: "Please provide a confirm password",
            equalTo: "Your confirm password does not match with password"
        },
        terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.input-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});
</script>
<?php echo $message; ?>