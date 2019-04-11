$("#registrarSe").click(function () {
 $("#login").hide();
 $("#registro").show();
})

$("#jaRegistro").click(function () {
    $("#registro").hide();
    $("#login").show();
})


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