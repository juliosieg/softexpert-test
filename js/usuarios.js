$(function (){

	getTodosUsuarios();

})

function getTodosUsuarios(){

	$('#tableUsuarios').DataTable({
        "ajax": {"url": "funcoes/funcoesUsuarios.php", data: {"funcao": "getTodos"}, "type": "POST"},
        "paging": true,
        "order": [[ 3, "desc" ]],
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

function adicionarUsuario(){

	var nome = $("#nome").val();
    var email = $("#email").val();
    var senha = $("#senha").val();

    if (nome == null || nome == "") {
        $.notify({
            message: 'É necessário inserir um nome'
        }, {
            type: 'danger'
        });
    } else if (email == null || email == "") {
        $.notify({
            message: 'É necessário inserir um e-mail'
        }, {
            type: 'danger'
        });
    } else if (senha == null || senha == "") {
        $.notify({
            message: 'É necessário inserir uma senha'
        }, {
            type: 'danger'
        });
    } else {

        bloqueiaMsgAguarde("body", true, "win8_linear");

        $.ajax({
            type: "POST",
            url: 'funcoes/funcoesUsuarios.php',
            data: {
                funcao: "inserir", 
                nome: nome,
                email: email, 
                senha: senha
            },
            success: function (data) {
                var test = $.trim(data);
                if (test == 'OK') {
                    
                    var table = $("#tableUsuarios").DataTable();
                    table.ajax.reload(null, false)
                    $("#nome").val("");
                    $("#email").val("");
                    $("#senha").val("");

                    $.notify({
                        message: 'Inserção executada com sucesso'
                    }, {
                        type: 'success'
                    });
                    
                    bloqueiaMsgAguarde("body", false, "win8_linear");
                    
                } else {
                    $("#nome").val("");
                    $("#email").val("");
                    $("#senha").val("");
                    
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

function excluir(codigo){
    bootbox.confirm({
        title: 'Exclusão',
        message: 'Tem certeza que deseja excluir o usuário?',
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
                    url: 'funcoes/funcoesUsuarios.php',
                    data: {funcao: "excluir", codigo: codigo},
                    success: function (data) {
                      
                        var test = $.trim(data);
                      
                        if (test == 'OK') {

                            var table = $("#tableUsuarios").DataTable();
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

function alterarSenha(codigo){

	$.confirm({
	    title: 'Alterar Senha',
	    content: '' +
	    '<form action="" class="formAlterarSenha">' +
	    '<div class="form-group">' +
	    '<label>Digite a nova senha</label>' +
	    '<input type="password" placeholder="Nova senha" class="novaSenha form-control" required />' +
	    '</div>' +
	    '</form>',
	    buttons: {
	        formSubmit: {
	            text: 'Salvar',
	            btnClass: 'btn-blue',
	            action: function () {
	                var novaSenha = this.$content.find('.novaSenha').val();
	                if(!novaSenha){
	                    $.alert('O campo não pode ser vazio.');
	                }else{
	                	
	                	bloqueiaMsgAguarde("body", true, "win8_linear");

				        $.ajax({
				            type: "POST",
				            url: 'funcoes/funcoesUsuarios.php',
				            data: {
				                funcao: "editarSenha", 
				                novaSenha: novaSenha,
				                codigo: codigo
				            },
				            success: function (data) {
				                var test = $.trim(data);
				                if (test == 'OK') {
				                    
				                    var table = $("#tableUsuarios").DataTable();
				                    table.ajax.reload(null, false)

				                    $.notify({
				                        message: 'Alteração executada com sucesso'
				                    }, {
				                        type: 'success'
				                    });
				                    
				                    bloqueiaMsgAguarde("body", false, "win8_linear");
				                    
				                } else {
				                    
				                    $.notify({
				                        message: 'Erro na alteração! <br> Descrição: '+test
				                    }, {
				                        type: 'danger'
				                    });
				                    
				                    bloqueiaMsgAguarde("body", false, "win8_linear");
				                    
				                }
				            }
				        });

	                }
	            }
	        },
	    },
	    onContentReady: function () {
	        
	        var jc = this;
	        this.$content.find('form').on('submit', function (e) {
	            e.preventDefault();
	            jc.$$formSubmit.trigger('click');
	        });
	    }
	});

}