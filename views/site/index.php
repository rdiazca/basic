<?php

/* @var $this yii\web\View */

$this->title = 'Tienda Virtual';
?>

<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Tienda Virtual</title>

	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	
	<link rel="shortcut icon" href="favicon.ico">
	<link href="/favicon.ico" rel="SHORTCUT ICON" type="image/ico">


	<!-- Global styles START -->          
        <link href="../../web/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../../web/css/bootstrap.css" rel="stylesheet" type="text/css">
	<!-- Global styles END --> 
   
	<!-- Page level plugin styles START -->
	<link href="../../web/jquery.fancybox.css" rel="stylesheet">              
	<link href="../../web/jquery.bxslider.css" rel="stylesheet">
	<link rel="stylesheet" href="../../web/css/layerslider.css" type="text/css">
	<!-- Page level plugin styles END -->

	<!-- Theme styles START -->
	<link href="../../web/css/style-metronic.css" rel="stylesheet" type="text/css">
	<link href="../../web/css/style.css" rel="stylesheet" type="text/css">
	<link href="../../web/css/style-responsive.css" rel="stylesheet" type="text/css">  
	<link href="../../web/css/custom.css" rel="stylesheet" type="text/css">
	<!-- Theme styles END -->
</head>

<body>
	
    <div >
        <div class="container">
            <div class="container">
                <img src="banner.png"class="img-responsive" >       
            </div>
        </div>
    </div>    
	
	 <div class="main">
      <div class="container">
        <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SALE PRODUCT -->
          <div class="col-md-12 sale-product">
            <h2>Productos Más Vendidos</h2>
           
            <?php                 
                foreach ($cincoMasVendidos as $id_modelo) {
                  $modelo=\app\models\Modelo::find()->where(['id_modelo'=>$id_modelo])->one(); ?>
               <div  class="col-md-2 col-sm-7 col-xs-10">
                   <div  class="product-item">
                  <div class="pi-img-wrapper">
                      <a href="uploads/modeloImg/modelo<?=$id_modelo?>"><img  src="uploads/modeloImg/modelo<?=$id_modelo?>" class="img-responsive" alt="<?= $modelo->descripcion ?>"></a>
                  
                  </div>
                      <br>
                      <h2 ><a href="/basic/web/producto/producto?id_modelo=<?= $modelo->id_modelo?>"><?= $modelo->modelo;?></a></h2>  
                 
                  <div >
                      <p style="font-size: 16px">Disponibles: <?= $modelo->cantProductos($modelo) ?></p> 
                  </div> 
                 <br>
                  <div class="pi-price">$ <?= $modelo->precio ?></div>
                  
                   
                  </div>
                  
              </div>
              <?php } ?>






            </div>
          <!-- END SALE PRODUCT -->
        </div>
        <!-- END SALE PRODUCT & NEW ARRIVALS -->

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40 ">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-4">
            <ul class="list-group margin-bottom-25 sidebar-menu">
                 <?php $departamentosHab=  \app\models\Departamento::find()->where(['id_estado'=>1])->all();?>
                <?php foreach ($departamentosHab as $departamento){ ?>
              <li class="list-group-item clearfix"><a href="/basic/web/departamento/productos?id_departamento=<?= $departamento->id_departamento?>"><i class="fa fa-angle-right"></i> <?= $departamento->nombre_departamento;?></a></li>
              <?php } ?>
            </ul>
          </div>
          <!-- END SIDEBAR -->
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-8">
            <h2>Últimos Productos</h2>
            <div class="bxslider-wrapper">
              <ul class="bxslider" data-slides-phone="1" data-slides-tablet="2" data-slides-desktop="3" data-slide-margin="15">
                <?php
                $count = 0;
                for ($count; $count < 3; $count++){   
                  $modelos = $ultimosModelos[$count];?> 
                  <div class="col-md-4 col-sm-6 col-xs-12">    
                  <div class="product-item">
                  <div class="pi-img-wrapper">
                      <a href="uploads/modeloImg/modelo<?=$modelos->id_modelo?>"><img  src="uploads/modeloImg/modelo<?=$modelos->id_modelo?>" class="img-responsive" alt="<?= $modelos->descripcion ?>"></a>
                  
                  </div>
                      <br>
                      <h2 ><a href="/basic/web/producto/producto?id_modelo=<?= $modelos->id_modelo?>"><?= $modelos->modelo;?></a></h2>  
                 
                  <div >
                      <p style="font-size: 16px">Disponibles: <?= $modelos->cantProductos($modelos) ?></p> 
                  </div> 
                 <br>
                  <div class="pi-price">$ <?= $modelos->precio ?></div>     
                    </div>
                    </div>
                <?php } ?>                
               </ul>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN TWO PRODUCTS & PROMO -->
        <div class="row margin-bottom-35 ">
          <!-- BEGIN TWO PRODUCTS -->
          
          <!-- END TWO PRODUCTS -->
          <!-- BEGIN PROMO -->
          <div class="col-md-6">
            <div class="content-slider">
              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="uploads/modelo11.jpg" class="img-responsive" alt="Ups!!">
                  </div>
                  <div class="item">
                    <img src="uploads/modelo14.jpg" class="img-responsive" alt="Ups!!">
                  </div>
                  <div class="item">
                    <img src="uploads/modelo16.jpg" class="img-responsive" alt="Ups!!">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END PROMO -->
        </div>        
        <!-- END TWO PRODUCTS & PROMO -->
      </div>
    </div>
    
    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="../../web/plugins/respond.min.js"></script>  
    <![endif]-->  
    <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>      
    <script type="text/javascript" src="js/back-to-top.js"></script>
    <script type="text/javascript" src="js/jquery.slimscroll.min.js"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script><!-- pop up -->
    <script type="text/javascript" src="js/jquery.bxslider.min.js"></script><!-- slider for products -->
    <script type="text/javascript" src='js/jquery.zoom.min.js'></script><!-- product zoom -->
    <script src="js/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->

    <!-- BEGIN LayerSlider -->
    <script src="js/jquery-easing-1.3.js" type="text/javascript"></script>
    <script src="js/jquery-transit-modified.js" type="text/javascript"></script>
    <script src="js/layerslider.transitions.js" type="text/javascript"></script>
    <script src="js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>
    <!-- END LayerSlider -->

    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            App.init();    
            App.initBxSlider();
            Index.initLayerSlider();
            App.initImageZoom();
            App.initTouchspin();
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->	
 
</body>
</html>
 
    