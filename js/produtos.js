$(function (){

    getTodos();
    getTiposProdutos();

    $("#valorVenda").maskMoney();

    $("#erroAlteracaoVazia").hide();

});

function getTodos() {

    $('#tableProdutos').DataTable({
        "ajax": {"url": "funcoes/funcoesProdutos.php", data: {"funcao": "getTodos"}, "type": "POST"},
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "pageLength": 5,
        "responsive": true,
        "lengthMenu": [5, 10, 25, 50, 75, 100],
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            'pageLength',
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ], language: {
            buttons: {
                colvis: 'Visibilidade',
                pageLength: {
                    _: "Mostrar %d elementos",
                    1: "Mostrar elemento"
                },
                copy: 'Copiar',
                copyTitle: 'Copiar',
                copyKeys: 'Pressione <i> Ctrl </ i> ou <i> \ u2318 </ i> + <i> C </ i> para copiar os dados da tabela para o clipboard. <br> Para cancelar, clique sobre esta mensagem ou pressione a tecla Esc.',
                copySuccess: {
                    _: '%d linhas copiadas',
                    1: '1 linha copiada'
                }
            }
        }

    });
}

function getTiposProdutos(){

    $.ajax({
        type: "POST",
        url: 'funcoes/funcoesProdutos.php',
        data: {funcao: "getTiposProdutos"},
        success: function (html) {

            var test = jQuery.parseJSON(html);

            $('#tipoProduto').find('option').remove();

            $("#tipoProduto").append("<option value=''>Selecione uma opção</option>");
            $.each(test, function (i, item) {
                $("#tipoProduto").append("<option value=" + item.id + " descricao=" + item.descricao + ">" + item.descricao + "</option>")
            });

        }

    });

}

function inserirNovoProduto() {

    var descricao = $("#descricaoProduto").val();
    var valor_venda = $("#valorVenda").val();
    var tipo_produto = $("#tipoProduto").val();

    if (descricao == null || descricao == "") {
        $.notify({
            message: 'É necessário inserir uma descrição'
        }, {
            type: 'danger'
        });
    } else if (valor_venda == null || valor_venda == "") {
        $.notify({
            message: 'É necessário inserir um valor de venda'
        }, {
            type: 'danger'
        });
    } else if (tipo_produto == null || tipo_produto == "") {
        $.notify({
            message: 'Selecione um tipo para esse produto'
        }, {
            type: 'danger'
        });
    } else {

        bloqueiaMsgAguarde("body", true, "win8_linear");

        $.ajax({
            type: "POST",
            url: 'funcoes/funcoesProdutos.php',
            data: {
                funcao: "inserir", 
                descricao: descricao,
                valor_venda: valor_venda, 
                tipo_produto: tipo_produto
            },
            success: function (data) {
                var test = $.trim(data);
                if (test == 'OK') {
                    
                    var table = $("#tableProdutos").DataTable();
                    table.ajax.reload(null, false)
                    $("#descricaoProduto").val("");
                    $("#valorVenda").val("");
                    $("#tipoProduto").val("");

                    $.notify({
                        message: 'Inserção executada com sucesso'
                    }, {
                        type: 'success'
                    });
                    
                    bloqueiaMsgAguarde("body", false, "win8_linear");
                    
                } else {
                    $("#descricaoProduto").val("");
                    $("#valorVenda").val("");
                    $("#tipoProduto").val("");
                    
                    $.notify({
                        message: 'Erro na inserção! <br> Descrição: '+test
                    }, {
                        type: 'danger'
                    });
                    
                    bloqueiaMsgAguarde("body", false, "win8_linear");
                    
                }
            }
        });
    }
}

function excluir(codigo, produto){
    bootbox.confirm({
        title: 'Exclusão',
        message: 'Tem certeza que deseja excluir o produto <b>' + produto + '</b>?',
        buttons: {
            'cancel': {
                label: 'Cancelar',
                className: 'btn-default pull-left'
            },
            'confirm': {
                label: 'Excluir',
                className: 'btn-danger pull-right'
            }
        },
        callback: function (result) {
            if (result) {
                
                bloqueiaMsgAguarde("body", true, "win8_linear");
                
                $.ajax({
                    type: "POST",
                    url: 'funcoes/funcoesProdutos.php',
                    data: {funcao: "excluir", codigo: codigo},
                    success: function (data) {
                      
                        var test = $.trim(data);
                      
                        if (test == 'OK') {

                            var table = $("#tableProdutos").DataTable();
                            table.ajax.reload(null, false);

                            $.notify({
                                message: 'Exclusão executada com sucesso'
                            }, {
                                type: 'success'
                            });
                            
                            bloqueiaMsgAguarde("body", false, "win8_linear");
                            
                        } else {
                            $.notify({
                                message: 'Erro na exclusão.<br>Descrição: '+test
                            }, {
                                type: 'danger'
                            });
                            
                            bloqueiaMsgAguarde("body", false, "win8_linear");
                        }
                    }
                });
            }
        }
    });
}

function alterar(codigo){
    $('#modalEditarTipo').modal('show');
    $('#idEditarTipo').attr('disabled', 'true');
    $('#idEditarTipo').val(codigo);
    pesquisaCodigo(codigo);
}

function pesquisaCodigo(codigo){
    $.ajax({
        type: "POST",
        url: 'funcoes/funcoesTiposProdutos.php',
        data: {funcao: "pesquisaCodigo", codigo: codigo},
        success: function (data) {
            var test = JSON.parse(data);
            $('#descricaoEditarTipo').val(test[0].descricao);
            $('#percentualEditarTipo').val(parseFloat(test[0].percentual_imposto).toFixed(2));

            return test;
        }
    });
}

function salvarAlteracoes() {

    if ($('#descricaoEditarTipo').val() != null && $('#descricaoEditarTipo').val() != "" &&
        $('#percentualEditarTipo').val() != null && $('#percentualEditarTipo').val() != "") {
        var descricao = $('#descricaoEditarTipo').val();
        var percentual = $('#percentualEditarTipo').val();
        var codigo = $('#idEditarTipo').val();
        
        bloqueiaMsgAguarde("body", true, "win8_linear");
        
        $.ajax({
            type: "POST",
            url: 'funcoes/funcoesTiposProdutos.php',
            data: {
                funcao: "salvarAlteracoes", 
                codigo: codigo, 
                descricao: descricao,
                percentual: percentual
            },
            success: function (data) {
                var test = $.trim(data);
                if (test == 'OK') {
                    $('#modalEditarTipo').modal('hide');
                    var table = $("#tableTiposProdutos").DataTable();
                    table.ajax.reload(null, false)
                    $.notify({
                        message: 'Alteração executada com sucesso'
                    }, {
                        type: 'success'
                    });
                    
                    bloqueiaMsgAguarde("body", false, "win8_linear");
                    
                } else {
                    $('#modalEditarMarca').modal('hide');
                    $.notify({
                        message: 'Erro na alteração! <br> Descrição: '+test
                    }, {
                        type: 'danger'
                    });
                    
                    bloqueiaMsgAguarde("body", false, "win8_linear");
                }

            }
        });
    } else {
        $("#erroAlteracaoVazia").show();
    }
}
