$("#registrarSe").click(function () {
    $("#login").hide();
    $("#esqueci").hide();
    $("#registro").show();
    $("#nomeRegistro").focus();
})

$("#jaRegistro").click(function () {
    $("#registro").hide();
    $("#esqueci").hide();
    $("#login").show();
    $("#email").focus();
})

$("#esqueciaSenha").click(function () {
    $("#registro").hide();
    $("#esqueci").show();
    $("#login").hide();
    $("#emailEsqueci").focus();
})


$(document).ready(function () {

    $('#formLogin').each(function () {
        $(this).validate({
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
        });
    });


    $('#formRegisto').each(function () {
        $(this).validate({
            rules: {
                nome: {
                    required: true,
                    maxlength: 100
                },

                senha: {
                    required: true,
                    minlength: 3,
                    maxlength: 6
                },

                email: {
                    required: true,
                    email: true
                }
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    });

});

