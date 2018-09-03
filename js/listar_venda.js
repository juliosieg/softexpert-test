$(function (){

	getTodasVendas();

})

function getTodasVendas(){

	$('#tableVendas').DataTable({
        "ajax": {"url": "funcoes/funcoesListarVenda.php", data: {"funcao": "getTodasVendas"}, "type": "POST"},
        "paging": true,
        "order": [[ 3, "desc" ]],
        "lengthChange": true,
        "columnDefs":[{targets:3, render:function(data){
	      return moment(data).format('DD/MM/YYYY HH:mm:ss');
	    }}],
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

function excluir(codigo, tipo){
    bootbox.confirm({
        title: 'Exclusão',
        message: 'Tem certeza que deseja excluir a venda?',
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
                    url: 'funcoes/funcoesListarVenda.php',
                    data: {funcao: "excluir", codigo: codigo},
                    success: function (data) {
                      
                        var test = $.trim(data);
                      
                        if (test == 'OK') {

                            var table = $("#tableVendas").DataTable();
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

function imprimir(codigo){

    window.location.href = 'index.php?menu=imprimir&cod='+codigo;

}