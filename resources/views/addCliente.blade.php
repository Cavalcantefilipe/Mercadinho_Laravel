<!DOCTYPE html><html class=''>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="{{ URL::asset('css/addCliente.css') }}" rel="stylesheet">
    <script src="{{ asset('js/addCliente.js') }}" defer></script>
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
            <legend>Cadastro Cliente</legend>

            <!-- Text input-->
            <form >
                <div id="form-messages" class="alert success" role="alert" style="display: none;"></div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Nome:</label>
                <div class="col-md-4">
                    <input id="Name" name="nome" type="text" placeholder="Nome" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Cpf/Cnpj:</label>
                <div class="col-md-4">
                    <input id="Class" name="documento" type="text" placeholder="Cpf ou Cnpj"   class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                    <button id="btEnviar" type="button" name="Add" class="btn btn-primary" >Criar Cliente</button>
                </div>
            </form>
            </div>
        </fieldset>
        <div class="writeinfo"></div>
</article>
</div>
</body>
</html>
