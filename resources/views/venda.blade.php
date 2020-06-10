<!DOCTYPE html><html class=''>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <link href="{{ URL::asset('css/venda.css') }}" rel="stylesheet">
    <script src="{{ asset('js/venda.js') }}" defer></script>
</head>
<body>

<div class="shop__header">
    <h1 class="shop__title"><a href="/">Mercadinho Filipe</a></h1>
    <p class="shop__text">
</div>

<div class="menu">
    <article class="session">
<div class="container">
	<div class="row">


        <div class="dual-list list-right col-md-6">
            <div class="well">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-search" style="top: 0px;"></span>
                            <input type="text" name="SearchDualList" class="form-control" placeholder="search">
                            <span class="input-group-addon glyphicon glyphicon-unchecked selector" style="cursor: pointer; top: 0px;" title="Select All"></span>
                            <span class="input-group-addon glyphicon glyphicon-plus move-left" style="cursor: pointer; top: 0px;" title="Add Selected"></span>
                        </div>
                    </div>
                </div>

                <ul class="list-group" id="dual-list-right">

                </ul>
            </div>
        </div>


        <div class="dual-list list-left col-md-6">
            <div class="well text-right">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-search" style="top: 0px;"></span>
                            <input type="text" name="SearchDualList" class="form-control" placeholder="search">
                            <span class="input-group-addon glyphicon glyphicon-unchecked selector" style="cursor: pointer; top: 0px;" title="Select All"></span>
                            <span class="input-group-addon glyphicon glyphicon-minus move-right" style="cursor: pointer; top: 0px;" title="Remove Selected"></span>
                        </div>
                    </div>
                </div>

                <ul class="list-group" id="dual-list-left">
                </ul>
            </div>
        </div>


        <select id="dual-list-options" name="dual-list-options[]" multiple="multiple" style="display: none;" size="100000">
        </select>


	</div>
</div>
<form>
    <label for="cliente">Cliente</label>
    <select name="cliente" id="cliente">
    </select>
    <br><br>
    <input type="button" id="conclui" value="Concluir Venda">
  </form>
</article>
</div>
</body>
</html>
