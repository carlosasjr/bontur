jQuery.validator.addMethod("veia", function (value, element) {
    //se existe rex
    if ((value != '') && (value.toLowerCase().indexOf("véia") == -1)) {
        return false
    }
    return true

}, "Cadê a véia, mano?");


$(document).ready(function () {
    $("#cpf").mask("000.000.000-00");
    $("#dataNasc").mask("00/00/0000");

    $("#formCadastro").validate({
        rules: {
            nome: {
                minlength: 10,
                minWords: 2
            },
            email: {
                required: true,
                email: true
            },
            cpf: {
                required: true,
                cpfBR: true

            },
            prof: {
                veia: true
            },

            dataNasc: {
                dateITA: true
            }

        },
        submitHandler: function (form) {
            alert("Cadastrado com sucesso")
        }
    })
})