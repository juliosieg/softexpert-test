function efetuarLogin() {

    var email = $("#email").val(); 
    var senha = $("#senha").val();
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: 'funcoes/efetuarLogin.php',
        data: {email: email, senha:senha},
        success: function (data) {
            $.each(data, function(key, value)
            {
                
                if(value['ret']==true) {
                    window.location.replace("index.php");
                }
                else{
                    bootbox.alert(value['msg']);
                }
            });
        }
    });
}