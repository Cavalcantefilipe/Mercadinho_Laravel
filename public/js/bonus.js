$(document).ready(function () {
    $.ajax({
        type: "get",
        url: "api/vendas",
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
                    Object.values(value)[4] +
                    "</td>" +
                    "<td>" +
                    Object.values(value)[1] +
                    "</td>" +
                    "<td>" +
                    (Object.values(value)[3]) +
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
            var documento = $("#description").val();
            ajaxUpdate(nome, documento, id);
        });
    });
});
