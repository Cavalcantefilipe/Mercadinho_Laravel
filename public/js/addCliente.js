
$('#btEnviar').click(function(event){
    event.preventDefault(0);
    var nome = $("input[name=nome]").val();

    var cpf = $("input[name=documento]").val();


    $.ajax({

       type:'POST',
       url:'api/cliente',
       data:{"nome":nome, "cpf/cnpj":cpf},
       cache: false
       });
       return false;
 });

