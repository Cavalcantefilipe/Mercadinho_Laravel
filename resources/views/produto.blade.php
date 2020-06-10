<!DOCTYPE html><html class=''>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <link href="{{ URL::asset('css/produto.css') }}" rel="stylesheet">
    <script src="{{ asset('js/produto.js') }}" defer></script>
</head>
<body>

<div class="shop__header">
    <h1 class="shop__title"><a href="/">Mercadinho Filipe</a></h1>
</div>

<div class="menu">

    <article class="session">
        <div class="container">

            <div class="row">
               <div class="col-md-12">
                  <div class="table-responsive">
                     <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th><h3>ID</h3></th>
                           <th><h3>Descricao</h3></th>
                           <th><h3>Quantidade</h3></th>
                           <th><h3>Preço</h3></th>
                           <th><h3>Edit</h3></th>
                           <th><h3>Delete</h3></th>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>

                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="ItemForm" name="ItemForm" class="form-horizontal">
                           <input type="hidden" name="Item_id" id="Item_id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Descricao</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Enter Name" value="" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Quantidade</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Enter Name" value="" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Preço</label>
                                <div class="col-sm-12">
                                    <input class="form-control" id="preco" name="preco" type="number" step="0.01" min="0"  placeholder="Preço" value="">
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                             <button type="button" class="btn btn-primary" id="saveBtn" value="create">Save changes
                             </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
         </div>

    </div>
</article>
</div>
</body>
</html>
