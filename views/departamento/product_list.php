<!DOCTYPE html>


<html lang="es"><!--<![endif]--><!-- Head BEGIN -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  
  <title></title>

  <!-- Fonts START -->
  <link href="../../web/css/css" rel="stylesheet" type="text/css">
  <link href="../../web/css/css_002" rel="stylesheet" type="text/css">
  <!-- Fonts END -->

  <!-- Global styles START -->          
  <link href="../../web/css/font-awesome.css" rel="stylesheet" type="text/css">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="../../web/css/jquery.css" rel="stylesheet">              
  <link rel="stylesheet" href="../../web/css/jquery-ui.css"><!-- for slider-range -->
  <link href="../../web/css/jquery_002.css" rel="stylesheet">
  <link href="../../web/css/bootstrap.css" rel="stylesheet">
  <link href="../../web/css/rateit.css" rel="stylesheet" type="text/css">
  <link href="../../web/css/uniform.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="../../web/css/style-metronic.css" rel="stylesheet" type="text/css">
  <link href="../../web/css/style.css" rel="stylesheet" type="text/css">
  <link href="../../web/css/style-responsive.css" rel="stylesheet" type="text/css">  
  <link href="../../web/css/custom.css" rel="stylesheet" type="text/css">
  <!-- Theme styles END -->
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body>
    <br>
    <div class="title-wrapper">
      <div class="container"><div class="container-inner">
              <h1><?=$nombre ?></h1>
        
      </div></div>
    </div>

    <div class="main">
        
        
     
        
        
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          
          <h2>&nbsp;&nbsp;&nbsp;Últimos Productos</h2> 
              
          <div class="sidebar col-md-3 col-sm-5">
              <div class="sidebar-products clearfix">
              <?php for ($index = 0;$index < 3;$index++) {

                        $modelo =$ultimosModelos[$index];
 
//              foreach ($modelos-> as $modelo) { ?>
              <div class="item">
                <a href="../../web/uploads/modeloImg/modelo<?=$modelo->id_modelo?>"><img src="../../web/uploads/modeloImg/modelo<?=$modelo->id_modelo?>" ></a>
                <h3><a href="/basic/web/producto/producto?id_modelo=<?= $modelo->id_modelo?>"><?= $modelo->modelo;?></a></h3>
                <div class="pi-price">&nbsp;&nbsp;&nbsp;$ <?= $modelo->precio ?></div>
              </div>
             
           <?php } ?>
                  
                   </div> </div>
          <!-- END SIDEBAR -->
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <div class="row list-view-sorting clearfix">
              <div class="col-md-2 col-sm-2 list-view">
                <a href=""><i class="fa fa-th-large"></i></a>
                <a href=""><i class="fa fa-th-list"></i></a>
              </div>
            </div>
            <!-- BEGIN PRODUCT LIST -->
            <div class="row product-list">
              <!-- PRODUCT ITEM START -->
                <?php foreach ($modelos as $modelo) { ?>
              
              <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="product-item">
                  <div class="pi-img-wrapper">
                      <a href="../../web/uploads/modeloImg/modelo<?=$modelo->id_modelo?>"><img  src="../../web/uploads/modeloImg/modelo<?=$modelo->id_modelo?>" class="img-responsive" alt="<?= $modelo->descripcion ?>"></a>
                  
                  </div>
                      <br>
                      <h2 ><a href="/basic/web/producto/producto?id_modelo=<?= $modelo->id_modelo?>"><?= $modelo->modelo;?></a></h2>  
                 
                  <div >
                      <p style="font-size: 16px">Disponibles: <?= $modelo->cantProductos($modelo) ?></p> 
                  </div> 
                 <br>
                  <div class="pi-price">$ <?= $modelo->precio ?></div>
                  
                    <?php if($modelo->cantProductos($modelo)>0){?>
                   <a href="carrito?id_modelo=<?= $modelo->id_modelo?>"  class="btn btn-default  add2cart">Añadir al Carrito</a>  
                    <?php } else{?>
                   <a href="carrito?id_modelo=<?= $modelo->id_modelo?>"  class="btn btn-default disabled add2cart">Añadir al Carrito</a>  
                 <?php } ?>
                  </div>
                  
              </div>
               
              <?php } ?>
              
              
            </div>
            
            <!-- BEGIN PAGINATOR -->
            
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
   
    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS(REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>  
    <![endif]-->  
    <script src="../../web/js/jquery-1.js" type="text/javascript"></script>
    <script src="../../web/js/jquery-migrate-1.js" type="text/javascript"></script>
    <script src="../../web/js/bootstrap.js" type="text/javascript"></script>      
    <script type="text/javascript" src="../../web/js/back-to-top.js"></script>   
    <script type="text/javascript" src="../../web/js/jquery_002.js"></script> 
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
    <script type="text/javascript" src="../../web/js/jquery.js"></script>  
    <script type="text/javascript" src="../../web/js/jquery_004.js"></script><!-- slider for products -->
    <script src="../../web/js/jquery_003.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../web/js/jquery_005.js"></script><!-- product zoom -->
    <script src="../../web/js/jquery-ui.js"></script><!-- for slider-range -->
    <script src="../../web/js/jquery_006.js" type="text/javascript"></script>
    <script src="../../web/js/bootstrap_002.js" type="text/javascript"></script><!-- Quantity -->
    <script type="text/javascript" src="../../web/js/app.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function() {
        App.init();
        App.initBxSlider(); 
        App.initImageZoom();
        App.initSliderRange();
        App.initUniform(); 
        App.initTouchspin();
      });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->


      
</body><!-- END BODY --></html>


        
        
         
   