$(document).ready(function () {
    $.ajax({
        type: "get",
        url: "api/clientes",
        success: function (data) {
            var x = Object.values(data);
            var res = "";
            $.each(x, function (key, value) {
                res +=
                    "<tr>" +
                    "<td>" +
                    Object.values(value)[0] +
                    "</td>>" +
                    "<td>" +
                    Object.values(value)[1] +
                    "</td>" +
                    "<td>" +
                    Object.values(value)[2] +
                    "</td>" +
                    "<td>" +
                    '<button type="button" id="' +
                    Object.values(value)[0] +
                    '" class="btn btn-warning btn-sm edit" data-toggle="modal" data-target="#modalEditar"><span class="glyphicon glyphicon-edit"></span></button>' +
                    "</td>" +
                    "<td>" +
                    '<button type="button" class="btn btn-danger btn-xs delete" id="' +
                    Object.values(value)[0] +
                    '">Delete</button>' +
                    "</td>" +
                    "</tr>";
            });

            $("tbody").html(res);
        },
    });

    $(document).on("click", ".edit", function () {
        var id = $(this).attr("id");

        $("#ajaxModel").modal("show");
        $(document).on("click", "#saveBtn", function () {
            var nome = $("#name").val();
            var documento= $("#description").val();
            ajaxUpdate(nome,documento,id)
        });
    });

    $(document).on("click", ".btn-xs", function () {
        var id = $(this).attr("id");
        swal(
            {
                title: "Tem certeza?",
                text: " Deletar Cliente ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false,
            },
            function (isConfirm) {
                if (!isConfirm) return;
                $.ajax({
                    url: `api/cliente/${id}`,
                    type: "delete",
                    dataType: "JSON",
                    success: function () {
                        swal(
                            {
                                title: "Success",
                                text: "Cliente Deletado com sucesso",
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
                        console.log(message);
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
            }
        );
    });
});

function ajaxUpdate(nome, documento, id) {
    $.ajax({
        url: `api/cliente/${id}`,
        type: "put",
        dataType: "JSON",
        data: { nome: nome, "cpf/cnpj": documento },
        success: function () {
            swal(
                {
                    title: "Success",
                    text: "Cliente atualizado com sucesso",
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
}
