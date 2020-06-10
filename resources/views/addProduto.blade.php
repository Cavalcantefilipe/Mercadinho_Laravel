<!DOCTYPE html><html class=''>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="{{ URL::asset('css/addProduto.css') }}" rel="stylesheet">
    <script src="{{ asset('js/addProduto.js') }}" defer></script>
</head>
<body>

<div class="shop__header">
    <h1 class="shop__title"><a href="/">Mercadinho Filipe</a></h1>
</div>

<div class="menu">

    <article class="session">
    <div class="col-lg-12 form-horizontal">

        <fieldset>

            <!-- Form Name -->
            <legend><h2>Cadastro Produto</h2></legend>

            <!-- Text input-->
            <form >
                <div id="form-messages" class="alert success" role="alert" style="display: none;"></div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Descricao:</label>
                <div class="col-md-4">
                    <input id="descricao" name="descricao" type="text" placeholder="descricao" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Quantidade</label>
                <div class="col-md-4">
                    <input id="quantidade" name="quantidade" type="number" placeholder="quantidade"   class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Preço</label>
                <div class="col-md-4">
                    <input id="preco" name="preco" type="number" step="0.01" min="0"  placeholder="Preço"   class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                    <button id="btEnviar" type="button" name="Add" class="btn btn-primary" >Criar Produto</button>
                </div>
            </form>
            </div>
        </fieldset>
        <div class="writeinfo"></div>
</article>
</div>
</body>
</html>
