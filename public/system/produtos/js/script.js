function carregarCategorias(opt = '') {
    jQuery('#id_categoria').empty();

    jQuery.post("public/system/produtos/ajax/ajax.php", {action: 'getCategorias', option: opt}, function (resposta) {
        jQuery('#id_categoria').html(resposta.resultado).show();
    }, "json");
}

jQuery(document).ready(function () {

//botão para abrir o form modal
    jQuery('#j_open').click(function () {
        jQuery('.j_id').remove();

        jQuery('#formPost').find('input[class!="noclear"]').val('');
        jQuery('#formPost').find('textarea[class!="noclear"]').val('');
        jQuery('#formPost').find('input[name="action"]').val('create');
        jQuery('#pontos').val('1');

        carregarCategorias();
    });


//botão salvar
    jQuery('#btnSalvar').bind('click', function () {

        jQuery('#formPost').submit();

    })

    jQuery('#preco').maskMoney({decimal:",", thousands:"."});

    jQuery("#formPost").validate({
        rules: {
            descricao: {
                required: true,
                maxlength: 100
            },

            pontos: {
                required: true,
                min: 1
            },

            preco : {
                required: true
            }

        },

        submitHandler: function (form) {

            var dados = jQuery(form).serialize();
            var regID = jQuery('#formPost').find('input[name="id"]').val();

            jQuery.ajax({
                type: 'POST',
                url: 'public/system/produtos/ajax/ajax.php',
                dataType: 'json',
                data: dados,

                beforeSend: function () {
                    jQuery('.modal-footer .form_load').css('display', 'flex').css('justify-content', 'center');
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
                    jQuery('.modal-footer .form_load').fadeOut(500);
                },

                //caso de algum erro executa esta função
                error: function () {
                    alertify.alert('Ocorreu um erro na requisição Ajax');
                    jQuery('.modal-footer .form_load').fadeOut(500);
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
                    url: 'public/system/produtos/ajax/ajax.php',
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

        jQuery.ajax({
            url: 'public/system/produtos/ajax/ajax.php',
            data: {action: 'read', regID: regID},
            type: 'POST',
            dataType: 'json',

            beforeSend: function () {
                jQuery('.j_id').remove();
            },

            success: function (resultado) {
                if (!resultado.error) {
                    jQuery("#formModal").modal();
                }

                if (resultado.error) {
                    alert('Erro ao selecionar ou usuário não existe!');
                } else {
                    carregarCategorias(resultado.registro.id_categoria);

                    jQuery.each(resultado.registro, function (key, value) {
                        jQuery('#formPost').find('input[name="' + key + '"]').val(value);
                        jQuery('#formPost').find('textarea[name="' + key + '"]').val(value);
                    });
                    jQuery('#formPost').find('input[name="action"]').val('update');
                    jQuery('<input type="hidden" class="j_id" name="id" value="' + resultado.registro.id + '"/>').prependTo('#formPost');
                }

            }
        })

    })
})






