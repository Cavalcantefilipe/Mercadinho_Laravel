$(document).ready(function () {
    $("#btEnviar").bind();

    $("#btEnviar").click(function () {
        var nome = $("input[name=nome]").val();

        var cpf = $("input[name=documento]").val();

        $.ajax({
            type: "POST",
            url: "api/cliente",
            data: { nome: nome, "cpf/cnpj": cpf },
            dataType: "JSON",
            success: function (data, textStatus, msg) {
                swal(
                    {
                        title: "Success",
                        text: "Cliente Cadastrado com sucesso",
                        type: "success",
                    },
                    function () {
                        location.reload();
                    }
                );
            },
            error: function (data, textStatus, msg) {
                var errors = data.responseJSON;
                var message = Object.values(errors);
                console.log(typeof isArr);
                swal(
                    {
                        title: "Erro",
                        text: `${message.join('\n')}`,
                        type: "error",
                    },
                    function () {
                        location.reload();
                    }
                );
            }
        });
        $("#btEnviar").unbind();
    });
});
