<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		
		<!-- Global styles START -->          
                <link href="../../web/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="../../web/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<!-- Global styles END --> 
   
		<!-- Page level plugin styles START -->
                <link href="../../web/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">              
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"><!-- for slider-range -->
		<link href="../../web/plugins/bxslider/jquery.bxslider.css" rel="stylesheet">
		<link href="../../web/plugins/rateit/src/rateit.css" rel="stylesheet" type="text/css">
		<link href="../../web/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
		<!-- Page level plugin styles END -->

		<!-- Theme styles START -->
		<link href="../../web/css/style-metronic.css" rel="stylesheet" type="text/css">
		<link href="../../web/css/style.css" rel="stylesheet" type="text/css">
		<link href="../../web/css/style-responsive.css" rel="stylesheet" type="text/css">  
		<link href="../../web/css/custom.css" rel="stylesheet" type="text/css">
		<!-- Theme styles END -->
    </head>
    <body>
    <div class="main">
    <div class="container">
        
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-5">
            <div class="sidebar-products clearfix">
              <h2>Últimos Productos</h2>
              <?phpfor($i; $i<4; $i++){ ?>
                 <div class="item">
			<a href="../../web/uploads/modeloImg/modelo<?=$ultimosModelos[$i]->id_modelo?>"><img src="../../web/uploads/modeloImg/modelo<?=$ultimosModelos[$i]->id_modelo?>" ></a>
				<h3><a href="/basic/web/producto/producto?id_modelo=<?= $ultimosModelos[$i]->id_modelo?>"><?= $ultimosModelos[$i]->modelo;?></a></h3>
                <div class="pi-price">&nbsp;&nbsp;&nbsp;$ <?= $ultimosModelos[$i]->precio ?></div>
                </div>
              <?php}?>   
            </div>
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <div class="product-page">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="product-main-image">
                      <img src="../../web/uploads/modeloImg/modelo<?= $modelo->id_modelo;?>.jpg" alt="Ups!" class="img-responsive" data-BigImgSrc="assets/temp/products/model7.jpg">
                  </div>                  
                </div>
                <div class="col-md-6 col-sm-6">
                  <h1><?= $modelo->modelo;?></h1>
                  <div class="price-availability-block clearfix">
                    <div class="price">
                      <strong><span>$</span><?= $modelo->precio;?></strong>
                    </div>
                      
                    <div class="availability">                      
                      Disponible: <strong><?=$modelo->cantProductos($modelo);?></strong>                      
                    </div>
                      
                  </div>
                  <div class="description">
                    <p><?php echo $modelo->descripcion;?></p>
                  </div>
                 
                  <div class="product-page-cart">
                    <?php if($modelo->cantProductos($modelo)>0){?>
                      <a href="/basic/web/departamento/carrito?id_modelo=<?= $modelo->id_modelo?>"class="btn btn-primary" type="submit">Añadir al carrito</a>
                      <?php } ?>
                  </div>  
                </div>
                 <!--<a href="carrito?id_modelo=<?= $modelo->id_modelo?>"  class="btn btn-default  add2cart">Añadir al Carrito</a>--> 
                <div class="sticker sticker-sale"></div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
        
      </div>
    </div>
        
     <div class="col-md-12 col-sm-12 bxslider-wrapper bxslider-wrapper-similar-products">
          <?php if(count($modelosRel) > 0){?>
            <h2>Productos Relacionados</h2>
            <?php }?>
              <div class="bx-wrapper" style="max-width: 1200px;"><div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 328px;"><ul class="bxslider bxslider-similar-products" data-slides-phone="1" data-slides-tablet="2" data-slides-desktop="4" data-slide-margin="20" style="width: 815%; position: relative; transition-duration: 0s; transform: translate3d(-1200px, 0px, 0px);">
                <li style="float: left; list-style: outside none none; position: relative; width: 270px; margin-right: 20px;" class="bx-clone">
                  <div class="product-item"></div>
                </li>                
                <li style="float: left; list-style: outside none none; position: relative; width: 270px; margin-right: 20px;" class="bx-clone">
                  <div class="product-item"></div>
                </li>
                <li style="float: left; list-style: outside none none; position: relative; width: 270px; margin-right: 20px;" class="bx-clone">
                  <div class="product-item"></div>
                </li>
                <li style="float: left; list-style: outside none none; position: relative; width: 270px; margin-right: 20px;">
                  <div class="product-item"></div>
                </li>                                             
                <?php foreach ($modelosRel as $modelosRel) {?>                 
                <li style="float: left; list-style: outside none none; position: relative; width: 270px; margin-right: 20px;" class="bx-clone">
                  <div class="product-item">
                    <div class="pi-img-wrapper">
                        <img src="../../web/uploads/modeloImg/modelo<?= $modelosRel->id_modelo?>.jpg" class="img-responsive" alt="<?= $modelo->modelo?>">
                      <div>
                        <a href="../../web/uploads/modeloImg/modelo<?= $modelosRel->id_modelo?>.jpg" class="btn btn-default fancybox-button">Zoom</a>
                      </div>
                    </div>
                    <h3><a href="/basic/web/producto/producto?id_modelo=<?= $modelosRel->id_modelo?>"><?= $modelosRel->modelo?></a></h3>
                    <div class="pi-price">$<?= $modelosRel->precio?></div>
                    <a href="/basic/web/departamento/carrito?id_modelo=<?= $modelosRel->id_modelo?>" class="btn btn-default add2cart">Añadir al carrito</a>
                  </div>
                </li> <?php }?>                
             </ul></div><div class="bx-controls bx-has-pager bx-has-controls-direction"><div class="bx-pager bx-default-pager"><div class="bx-pager-item"><a href="" data-slide-index="0" class="bx-pager-link active">1</a></div><div class="bx-pager-item"><a href="" data-slide-index="1" class="bx-pager-link">2</a></div></div><div class="bx-controls-direction"></div></div></div>
    </div>
	
	<!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS(REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>  
    <![endif]-->  
    <script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script type="text/javascript" src="assets/plugins/back-to-top.js"></script>    
    <script type="text/javascript" src="assets/plugins/jQuery-slimScroll/jquery.slimscroll.min.js"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS(REQUIRED ONLY FOR CURRENT PAGE) -->
    <script type="text/javascript" src="assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="assets/plugins/bxslider/jquery.bxslider.min.js"></script><!-- slider for products -->
    <script src="assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->
    <script src="assets/plugins/rateit/src/jquery.rateit.js" type="text/javascript"></script>
    <script type="text/javascript" src='assets/plugins/zoom/jquery.zoom.min.js'></script><!-- product zoom -->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script><!-- for slider-range -->
    <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>

    <script type="text/javascript" src="assets/scripts/app.js"></script>   
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
	
    </body>
</html>
