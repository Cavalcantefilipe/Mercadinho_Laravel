$(document).ready(function () {
    $("#btEnviar").bind();

    $("#btEnviar").click(function () {
        var descricao = $("input[name=descricao]").val();

        var quantidade = $("input[name=quantidade]").val();

        var preco = $("input[name=preco]").val();

        $.ajax({
            type: "POST",
            url: "api/produto",
            data: {
                "produto": [
                    {
                        'descricao':descricao,
                        'quantidade': quantidade,
                        'preco'     : preco
                    },
                ],
            },
            dataType: "JSON",
            success: function (data, textStatus, msg) {
                swal(
                    {
                        title: "Success",
                        text: "Produto Cadastrado com sucesso",
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
                swal(
                    {
                        title: "Erro",
                        text: `${message.join("\n")}`,
                        type: "error",
                    },
                    function () {
                        location.reload();
                    }
                );
            },
        });
        $("#btEnviar").unbind();
    });
});
