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
                    "<th>" +
                    Object.values(value)[0] +
                    "</th>" +
                    "<th>" +
                    Object.values(value)[1] +
                    "</th>" +
                    "<th>" +
                    Object.values(value)[2] +
                    "</th>" +
                    "<th>" +
                    "<p data-placement=\"top\" data-toggle=\"tooltip\" title=\"Edit\"><button class=\"btn btn-primary btn-xs\" data-title=\"Edit\" data-toggle=\"modal\" data-target=\"#edit\" ><span class=\"glyphicon glyphicon-pencil\"><\/span><\/button><\/p>" +
                    "</th>" +
                    "<th>" +
                    "<p data-placement=\"top\" data-toggle=\"tooltip\" title=\"Delete\"><button class=\"btn btn-danger btn-xs\" data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#delete\" value=\""+Object.values(value)[0]+"\" ><span class=\"glyphicon glyphicon-trash\"><\/span><\/button><\/p>" +
                    "</th>" +
                    "</tr>";
            });

            $("tbody").html(res);
        },
    });

});
