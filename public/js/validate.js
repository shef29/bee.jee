$(function () {
    $(".validate-form").validate({
        rules: {
            title: {
                required: true,
                minlength: 6,
            },
            description: {
                required: true,
                minlength: 6,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                min: 6,
            },
            username: {
                required: true,
                minlength: 6,
            },
            confirm_password: {
                required: true,
                equalTo: "#password",
            },
        }
    });
});