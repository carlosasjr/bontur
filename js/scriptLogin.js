$(document).ready(function () {

    $("#formLogin").validate({
        rules: {
            email: {
                required: true,
                email: true
            },

            senha: {
                required: true
            }

        },

        submitHandler: function (form) {
            form.submit();
        }
    })
})