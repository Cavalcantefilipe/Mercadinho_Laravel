<!DOCTYPE html><html class=''>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="{{ URL::asset('css/cart.css') }}" rel="stylesheet">
    <script src="{{ asset('js/cart.js')}}" defer></script>
</head>
<body>

    <div class="shop__header">
        <h1 class="shop__title"><a href="/">Mercadinho Filipe</a></h1>
    </div>

    <div class="menu">
        <article class="session">

<!-- Nav -->

    <div class="row">
        <div class="col">
          <button type="button" class="btn btn-primary" data-toggle="modal" id="openCart">Carrinho (<span class="total-count"></span>)</button>
          <button class="clear-cart btn btn-danger">Limpar Carrinho</button>
        </div>
    </div>



<!-- Main -->
<div class="container">
    <div class="row" id="rowproduct">
    </div>
</div>


 <!-- Modal -->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Carrinho</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="show-cart table">

        </table>
        <div>Preço Total: R$<span class="total-cart"></span></div>
      </div>
      <div class="modal-footer">
        <label for="cliente">Cliente</label>
        <select name="cliente" id="cliente">
        </select>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="finaliza" class="btn btn-primary">Filnalizar Compra</button>
      </div>
    </div>
  </div>
</div>

</article>
</div>
</body>
</html>
