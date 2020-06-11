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
                if(Object.values(value)[2] > 0){
                res +=
                    '<div class="col" id="produto"> <div class="card" style="width: 20rem;"> <div class="card-block"> <h4 class="card-title">' +
                    Object.values(value)[1] +
                    '</h4> <p class="card-text">Price: R$' +
                    Object.values(value)[3] +
                    '</p> <a href="#" data-name="' +
                    Object.values(value)[1] +
                    '" data-price="' +
                    Object.values(value)[3] +
                    '" data-id="' +
                    Object.values(value)[0] +
                    '" data-max="' +
                    Object.values(value)[2] +
                    '"class="add-to-cart btn btn-primary">Add to cart</a></div></div></div>';
                }
            });

            $(".container .row").html(res);
        },
    });

    var shoppingCart = (function () {
        // =============================
        // Private methods and propeties
        // =============================
        cart = [];

        // Constructor
        function Item(name, price, count, id, max) {
            this.name = name;
            this.price = price;
            this.count = count;
            this.id = id;
            this.max = max;
        }

        // Save cart
        function saveCart() {
            sessionStorage.setItem("shoppingCart", JSON.stringify(cart));
        }

        // Load cart
        function loadCart() {
            cart = JSON.parse(sessionStorage.getItem("shoppingCart"));
        }
        if (sessionStorage.getItem("shoppingCart") != null) {
            loadCart();
        }

        // =============================
        // Public methods and propeties
        // =============================
        var obj = {};

        // Add to cart
        obj.addItemToCart = function (name, price, count, id, max) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart[item].count++;
                    if (cart[item].count > max) {
                        cart[item].count--;
                        swal({
                            title: "Falta em estoque",
                            text: ` Quantidade do produto ${cart[item].name} indisponivel em estoque `,
                            type: "error",
                        });
                    }
                    saveCart();
                    return;
                }
            }
            var item = new Item(name, price, count, id);
            cart.push(item);
            saveCart();
        };
        // Set count from item
        obj.setCountForItem = function (name, count) {
            for (var i in cart) {
                if (cart[i].name === name) {
                    cart[i].count = count;
                    break;
                }
            }
        };
        // Remove item from cart
        obj.removeItemFromCart = function (name) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart[item].count--;
                    if (cart[item].count === 0) {
                        cart.splice(item, 1);
                    }
                    break;
                }
            }
            saveCart();
        };

        // Remove all items from cart
        obj.removeItemFromCartAll = function (name) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart.splice(item, 1);
                    break;
                }
            }
            saveCart();
        };

        // Clear cart
        obj.clearCart = function () {
            cart = [];
            saveCart();
        };

        // Count cart
        obj.totalCount = function () {
            var totalCount = 0;
            for (var item in cart) {
                totalCount += cart[item].count;
            }
            return totalCount;
        };

        // Total cart
        obj.totalCart = function () {
            var totalCart = 0;
            for (var item in cart) {
                totalCart += cart[item].price * cart[item].count;
            }
            return Number(totalCart.toFixed(2));
        };

        // List cart
        obj.listCart = function () {
            var cartCopy = [];
            for (i in cart) {
                item = cart[i];
                itemCopy = {};
                for (p in item) {
                    itemCopy[p] = item[p];
                }
                itemCopy.total = Number(item.price * item.count).toFixed(2);
                cartCopy.push(itemCopy);
            }
            return cartCopy;
        };

        // cart : Array
        // Item : Object/Class
        // addItemToCart : Function
        // removeItemFromCart : Function
        // removeItemFromCartAll : Function
        // clearCart : Function
        // countCart : Function
        // totalCart : Function
        // listCart : Function
        // saveCart : Function
        // loadCart : Function
        return obj;
    })();

    // *****************************************
    // Triggers / Events
    // *****************************************
    // Add item
    $(".row").on("click", ".add-to-cart", function (event) {
        event.preventDefault();
        var name = $(this).data("name");
        var price = Number($(this).data("price"));
        var id = Number($(this).data("id"));
        var max = Number($(this).data("max"));
        shoppingCart.addItemToCart(name, price, 1, id, max);
        displayCart();
    });

    // Clear items
    $(".clear-cart").click(function () {
        shoppingCart.clearCart();
        displayCart();
    });

    function displayCart() {
        var cartArray = shoppingCart.listCart();
        var output = "";
        for (var i in cartArray) {
            output +=
                "<tr>" +
                "<td>" +
                cartArray[i].name +
                "</td>" +
                "<td>(" +
                cartArray[i].price +
                ")</td>" +
                "<td>" +
                "<input type='number' readonly='readonly' class='item-count form-control' data-name='" +
                cartArray[i].name +
                "' value='" +
                cartArray[i].count +
                "'>" +
                "</div></td>" +
                "<td><button class='delete-item btn btn-danger' data-name=" +
                cartArray[i].name +
                ">X</button></td>" +
                " = " +
                "<td>" +
                cartArray[i].total +
                "</td>" +
                "</tr>";
        }
        $(".show-cart").html(output);
        $(".total-cart").html(shoppingCart.totalCart());
        $(".total-count").html(shoppingCart.totalCount());
    }

    // Delete item button

    $(".show-cart").on("click", ".delete-item", function (event) {
        var name = $(this).data("name");
        shoppingCart.removeItemFromCartAll(name);
        displayCart();
    });

    // -1
    $(".show-cart").on("click", ".minus-item", function (event) {
        var name = $(this).data("name");
        shoppingCart.removeItemFromCart(name);
        displayCart();
    });
    // +1
    $(".show-cart").on("click", ".plus-item", function (event) {
        var name = $(this).data("name");
        shoppingCart.addItemToCart(name);
        displayCart();
    });

    // Item count input
    $(".show-cart").on("change", ".item-count", function (event) {
        var name = $(this).data("name");
        var count = Number($(this).val());
        shoppingCart.setCountForItem(name, count);
        displayCart();
    });

    $("#openCart").on("click", function () {
        $("#cart").modal("toggle");
        var itensCarrinho = [];
        for (var item in cart) {
            id = cart[item].id;
            quantidade = cart[item].count;
            itensCarrinho.push({"idProduto":id, "quantidadeProduto":quantidade});
        }

        $("#finaliza").on("click", function () {
            var idCliente = $("#cliente").val();
            ajaxCriandoVenda(idCliente,itensCarrinho)
        });
    });
    shoppingCart.clearCart();

    displayCart();
});

function ajaxCriandoVenda(idCliente,itens) {
    $.ajax({
        type: "POST",
        url: "api/venda",
        data: { idCliente: idCliente },
        dataType: "JSON",
        success: function (data, textStatus, msg){
             ajaxAddItens(data.idVenda,itens)
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

function ajaxAddItens(id,itens){

    $.ajax({
        type: "POST",
        url: `api/add/itemVenda/${id}`,
        data: { "itensVenda":itens},
        dataType: "JSON",
        success: function (data, textStatus, msg){
            ajaxFinalizarVenda(id)
       },
        error: function (data, textStatus, msg) {
            var errors = data.responseJSON;
            var message = Object.values(errors);
            swal(
                {
                    title: "Erro",
                    text: `itens ${message.join("\n")}`,
                    type: "error",
                },
                function () {
                    location.reload();
                }
            );
        },
    });

}

function ajaxFinalizarVenda(id)
{
    $.ajax({
        url: `api/finalizaVenda/${id}`,
        type: "put",
        dataType: "JSON",
        success: function () {
            swal(
                {
                    title: "Success",
                    text: "Venda Finalizada",
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
                    text: `final ${message.join("\n")}`,
                    type: "error",
                },
                function () {
                    location.reload();
                }
            );
        },
    });
}
