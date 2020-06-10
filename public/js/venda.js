$(document).ready(function () {
    $.ajax({
        type: "get",
        url: "api/clientes",
        success: function (data) {
            var x = Object.values(data);
            var res = "";
            $.each(x, function (key, value) {
                res +=
                    '<option value="' +
                    Object.values(value)[0] +
                    '">' +
                    Object.values(value)[1] +
                    "</option>";
            });

            $("#cliente").html(res);
        },
    });
    $.ajax({
        type: "get",
        url: "api/produtos",
        success: function (data) {
            var x = Object.values(data);
            var res = "";
            $.each(x, function (key, value) {
                res +=
                    '<li class="list-group-item" id="' +
                    Object.values(value)[0] +
                    '" data-value="' +
                    Object.values(value)[0] +
                    '">' +
                    Object.values(value)[1] +
                    '<p id="preco">' +
                    Object.values(value)[3] +
                    '</p><input id="quantidade" min="0" value="0" type="number" max="' +
                    Object.values(value)[2] +
                    '"> </input><span class="glyphicon glyphicon-plus  pull-right dual-list-move-left " title="Add Selected"></span> </li>';
            });

            $("#dual-list-right").html(res);
        },
    });

    $(function () {
        var move_right =
            '<span class="glyphicon glyphicon-minus pull-left  dual-list-move-right" title="Remove Selected"></span>';
        var move_left =
            '<span class="glyphicon glyphicon-plus  pull-right dual-list-move-left " title="Add Selected"></span>';

        $(".dual-list.list-left .list-group").sortable({
            stop: function (event, ui) {
                updateSelectedOptions();
            },
        });

        $("body").on("click", ".list-group .list-group-item", function () {
            $(this).toggleClass("active");
        });

        $("body").on("click", ".dual-list-move-right", function (e) {
            e.preventDefault();

            actives = $(this).parent();
            $(this).parent().find("span").remove();
            $(move_left).clone().appendTo(actives);
            actives.clone().appendTo(".list-right ul").removeClass("active");
            actives.remove();

            sortUnorderedList("dual-list-right");

            updateSelectedOptions();
        });

        $("body").on("click", ".dual-list-move-left", function (e) {
            e.preventDefault();

            actives = $(this).parent();
            $(this).parent().find("span").remove();
            $(move_right).clone().appendTo(actives);
            actives.clone().appendTo(".list-left ul").removeClass("active");
            actives.remove();

            updateSelectedOptions();
        });

        $(".move-right, .move-left").click(function () {
            var $button = $(this),
                actives = "";
            if ($button.hasClass("move-left")) {
                actives = $(".list-right ul li.active");
                actives.find(".dual-list-move-left").remove();
                actives.append($(move_right).clone());
                actives.clone().appendTo(".list-left ul").removeClass("active");
                actives.remove();
            } else if ($button.hasClass("move-right")) {
                actives = $(".list-left ul li.active");
                actives.find(".dual-list-move-right").remove();
                actives.append($(move_left).clone());
                actives
                    .clone()
                    .appendTo(".list-right ul")
                    .removeClass("active");
                actives.remove();
            }

            updateSelectedOptions();
        });

        function updateSelectedOptions() {
            $("#dual-list-options").find("option").remove();

            $(".list-left ul li").each(function (idx, opt) {
                $("#dual-list-options").append(
                    $("<option></option>")
                        .attr("value", $(opt).data("value"))
                        .text($(opt).text())
                        .prop("selected", "selected")
                );
            });
        }

        $(".dual-list .selector").click(function () {
            var $checkBox = $(this);
            if (!$checkBox.hasClass("selected")) {
                $checkBox
                    .addClass("selected")
                    .closest(".well")
                    .find("ul li:not(.active)")
                    .addClass("active");
                $checkBox
                    .children("i")
                    .removeClass("glyphicon-unchecked")
                    .addClass("glyphicon-check");
            } else {
                $checkBox
                    .removeClass("selected")
                    .closest(".well")
                    .find("ul li.active")
                    .removeClass("active");
                $checkBox
                    .children("i")
                    .removeClass("glyphicon-check")
                    .addClass("glyphicon-unchecked");
            }
        });

        $('[name="SearchDualList"]').keyup(function (e) {
            var code = e.keyCode || e.which;
            if (code == "9") return;
            if (code == "27") $(this).val(null);
            var $rows = $(this).closest(".dual-list").find(".list-group li");
            var val = $.trim($(this).val()).replace(/ +/g, " ").toLowerCase();
            $rows
                .show()
                .filter(function () {
                    var text = $(this)
                        .text()
                        .replace(/\s+/g, " ")
                        .toLowerCase();
                    return !~text.indexOf(val);
                })
                .hide();
        });

        $(".glyphicon-search").on("click", function () {
            $(this).next("input").focus();
        });

        function sortUnorderedList(ul, sortDescending) {
            $("#" + ul + " li")
                .sort(sort_li)
                .appendTo("#" + ul);

            function sort_li(a, b) {
                return $(b).data("value") < $(a).data("value") ? 1 : -1;
            }
        }

        $("#dual-list-left li").append(move_right);
        $("#dual-list-right li").append(move_left);
    });

    $(document).on("click", "#conclui", function () {
        var idCliente = $("#cliente").val();
        var produto = $("#dual-list-options").val();
        produto.push($("#dual-list-options").html());
        var comprados = $("#dual-list-left li").html();
        console.log(produto);
        alert(idCliente);
    });
});
