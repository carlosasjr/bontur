function carregarPerfil(opt = '') {
    jQuery('#id_perfil').empty();

    jQuery.post("public/system/usuarios/ajax/ajax.php", {action: 'getPerfis', option: opt}, function (resposta) {
        jQuery('#id_perfil').html(resposta.resultado).show();
    }, "json");
}

jQuery(document).ready(function () {
//botão para abrir o form modal
    jQuery('#j_open').click(function () {
        jQuery('.j_id').remove();

        jQuery('#formPost').find('input[class!="noclear"]').val('');
        jQuery('#formPost').find('textarea[class!="noclear"]').val('');
        jQuery('#formPost').find('input[name="action"]').val('create');

        carregarPerfil();

        jQuery('#nome').focus();
    });


//botão salvar
    jQuery('#btnSalvar').bind('click', function () {

        jQuery('#formPost').submit();

    })

    jQuery("#telefone").mask("(00)0000-0000");
    jQuery("#celular").mask("(00)00000-0000");
    jQuery("#formPost").validate({
        rules: {
            //colocar as regras e validações aqui
            nome: {
                required: true,
                minWords: 2,
                maxlength: 100
            },

            email : {
                email : true,
                required : true,
                maxlength: 100
            },

            senha : {
                required : true
            }
        },

        submitHandler: function (form) {

            var dados = jQuery(form).serialize();
            var regID = jQuery('#formPost').find('input[name="id"]').val();

            jQuery.ajax({
                type: 'POST',
                url: 'public/system/usuarios/ajax/ajax.php',
                dataType: 'json',
                data: dados,

                beforeSend: function () {
                    jQuery('.form_load').css('display', 'flex').css('justify-content', 'center');
                },

                //funcao para pegar o retorno
                success: function (resposta) {
                    if (resposta.error) {
                        alertify.alert(resposta.mensagem);
                    } else {
                        if (regID != undefined) {
                            jQuery('#tab_list').find('.j_list').find('#' + regID).html(resposta.result);
                        } else {
                            jQuery(resposta.result).prependTo(jQuery('#tab_list').find('.j_list'));
                        }

                        jQuery("#formModal").modal('hide');

                    }
                    jQuery('.form_load').fadeOut(500);
                },

                //caso de algum erro executa esta função
                error: function () {
                    alertify.alert('Ocorreu um erro na requisição Ajax');
                    jQuery('.form_load').fadeOut(500);
                }
            })

            return false;

        }
    })


//botão delete
    jQuery('.j_list').on('click', '.j_delete', function () {
        var regID = jQuery(this).attr('rel');


        reset();
        alertify.confirm("Deseja excluir o registro selecionado?", function (e) {
            if (e) {
                jQuery.ajax({
                    url: 'public/system/usuarios/ajax/ajax.php',
                    data: {action: 'delete', regID: regID},
                    type: 'POST',
                    dataType: 'json',

                    beforeSend: function () {
                        jQuery('.form_load').css('display', 'flex').css('justify-content', 'center')
                    },

                    success: function (resposta) {
                        if (resposta.error) {
                            alertify.alert(resposta.mensagem);
                        } else {
                            jQuery('#' + regID).fadeOut(400, function () {
                                jQuery('.form_load').fadeOut(500);
                            });
                        }
                    },

                    error: function () {
                        jQuery('.form_load').fadeOut(500);
                    }
                });
            }
        });
    });


//botão editar
    jQuery('.j_list').on('click', '.j_edit', function () {
        var regID = jQuery(this).attr('rel');

        jQuery("#formModal").modal('show');

        jQuery.ajax({
            url: 'public/system/usuarios/ajax/ajax.php',
            data: {action: 'read', regID: regID},
            type: 'POST',
            dataType: 'json',

            beforeSend: function () {
                jQuery('.j_id').remove();
            },

            success: function (resultado) {
                if (resultado.error) {
                    alert('Erro ao selecionar ou usuário não existe!');
                } else {
                    carregarPerfil(resultado.registro.id_perfil);

                    jQuery.each(resultado.registro, function (key, value) {

                        jQuery('#formPost').find('input[name="' + key + '"]').val(value);
                        jQuery('#formPost').find('textarea[name="' + key + '"]').val(value);
                        jQuery('#formPost').find('select[name="' + key + '"]').val(value);
                    });


                    jQuery('#formPost').find('input[name="action"]').val('update');
                    jQuery('<input type="hidden" class="j_id" name="id" value="' + resultado.registro.id + '"/>').prependTo('#formPost');
                }

            }
        })

    })
})






