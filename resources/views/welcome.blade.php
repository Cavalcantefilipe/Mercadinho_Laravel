<!DOCTYPE html><html class=''>
<head>
    <script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script>
    <script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script>
    <script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script><meta charset='UTF-8'><meta name="robots" content="noindex"><link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" /><link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
    <link rel="canonical" href="https://codepen.io/jorgebrunetto/pen/QOVKgL" />
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex">
    <link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
    <link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
    <link rel="canonical" href="https://codepen.io/markbeekman/pen/WRPBjM?limit=all&page=3&q=shop" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css">
    <link href="{{ URL::asset('css/home.css') }}" rel="stylesheet">
</head>
<body>

<div class="shop__header">
    <h1 class="shop__title"><a href="/">Mercadinho Filipe</a></h1>
</div>

<div class="menu">
    <article class="session">
        <h2>Cliente</h2>
        <div class="icons" id="icons">
        <div><label class="mdi mdi-account-multiple-plus"><input type="button" name="icons" onclick="window.location='/CriarCliente';" ></label></div>
        <div><label class="mdi mdi-account"><input type="button" name="icons" onclick="window.location='/Cliente';" ></label></div>
        </div>

      </article>
      <article class="session">
        <h2>Produto</h2>
    <div class="icons" id="icons">
        <div><label class="mdi mdi-tag-plus"><input type="button" name="icons" onclick="window.location='/CriarProduto';"  ></label></div>
        <div><label class="mdi mdi-tag"><input type="button" name="icons" onclick="window.location='/Produto';"></label></div>
    </div>
</article>
<article class="session">
    <h2>Compra</h2>
<div class="icons" id="icons">
  <div><label class="mdi mdi-cart"><input type="button" name="icons" onclick="window.location='/Venda';"></label></div>
  <div><label class="mdi mdi-cart-outline"><input type="radio" name="icons" onclick="window.location='/Bonus';"></label></div>
</div>
</article>
</div>
</body>
</html>

