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
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="{{ URL::asset('css/cliente.css') }}" rel="stylesheet">
    <script src="{{ asset('js/cliente.js') }}" defer></script>
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
                           <th><h3>Nome</h3></th>
                           <th><h3>Cpf/Cnpj</h3></th>
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
         <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                     <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
                  </div>
                  <div class="modal-body">
                     <div class="form-group">
                        <input class="form-control " type="text" placeholder="nome">
                     </div>
                     <div class="form-group">
                        <input class="form-control " type="text" placeholder="cpf/cnpj">
                     </div>
                  </div>
                  <div class="modal-footer ">
                     <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                     <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                  </div>
                  <div class="modal-body">
                     <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
                  </div>
                  <div class="modal-footer ">
                     <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                     <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
</article>
</div>
</body>
</html>
