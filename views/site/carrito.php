<?php 
use app\models\Reserva;
$total=0;
$modelo=NULL;
?>
<html lang="es"><!--<![endif]--><!-- Head BEGIN --><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Carrito de Compras </title>

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
  <link href="/favicon.ico" rel="SHORTCUT ICON" type="image/ico">


	<!-- Global styles START -->          
        <link href="../../web/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../../web/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
	<!-- Global styles END --> 
   
	<!-- Page level plugin styles START -->
	<link href="../../web/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">              
	<link href="../../web/plugins/bxslider/jquery.bxslider.css" rel="stylesheet">
	<link rel="stylesheet" href="../../web/plugins/layerslider/css/layerslider.css" type="text/css">
	<!-- Page level plugin styles END -->

	<!-- Theme styles START -->
	<link href="../../web/css/style-metronic.css" rel="stylesheet" type="text/css">
	<link href="../../web/css/style.css" rel="stylesheet" type="text/css">
	<link href="../../web/css/style-responsive.css" rel="stylesheet" type="text/css">  
	<link href="../../web/css/custom.css" rel="stylesheet" type="text/css">

  

  
<style type="text/css">.bootstrap-touchspin-prefix:empty,.bootstrap-touchspin-postfix:empty{display:none;}</style><style type="text/css">.bootstrap-touchspin-prefix:empty,.bootstrap-touchspin-postfix:empty{display:none;}</style><style type="text/css">.bootstrap-touchspin-prefix:empty,.bootstrap-touchspin-postfix:empty{display:none;}</style></head>
<!-- Head END -->

<!-- Body BEGIN -->
<body style="margin-right: 0px;" class="">
    <!-- BEGIN TOP BAR -->
    
    <!-- END TOP BAR -->

    <!-- BEGIN HEADER -->
    
    <!-- END HEADER -->
    
<?php $r= Reserva::find()->where(['id_usuario'=>$user->id])->andWhere(['id_estado'=>3])->all(); 
        if($r!=NULL){?>
    

    <div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
              <table summary="Shopping cart">
                  <tbody><tr>
                      <th ><h1>Carrito de Compras</h1></th>
                      
                      <th class="shopping-cart-price">
                          <strong style="padding-left: 500px" class="price"><span >Monto del Usuario: $</span>
                        <?php echo Yii::$app->user->identity->monto?>
                        </strong></tr></table>
            
            <div class="shopping-cart-page">
              <div class="shopping-cart-data clearfix">
                <div class="table-wrapper-responsive">
                <table summary="Shopping cart">
                  <tbody><tr>
                    <th class="shopping-cart-image">Imagen</th>
                    <th class="shopping-cart-description">Descripción</th>
                    <th class="shopping-cart-ref-no">Código</th>
                    <th class="shopping-cart-price">Precio</th>
                    </tr>
                  
                      <?php 
                        $reservas= Reserva::find()->where(['id_usuario'=>$user->id])->all() ;
                        
                        foreach ($reservas as $reserva){
                            if($reserva->id_estado==3 ){
                            $producto= app\models\Producto::find()->where(['id_producto'=>$reserva->id_producto])->one();
                            $modelo= \app\models\Modelo::find()->where(['id_modelo'=>$producto->id_modelo])->one();
                            ?>
                  <tr>
                       
                    <td class="shopping-cart-image">
                    <a href="../../web/uploads/modeloImg/modelo<?=$modelo->id_modelo?>"><img src="../../web/uploads/modeloImg/modelo<?=$modelo->id_modelo?>" ></a>
                    
                    </td>
                    <td class="shopping-cart-description">
                      <h3><a href="/basic/web/producto/producto?id_modelo=<?= $modelo->id_modelo?>"><?=$modelo->modelo?></a></h3>
                      <p><strong>Detalles:</strong> <?=$modelo->descripcion?></p>
               
                    </td>
                    <td class="shopping-cart-ref-no">
                       <?=$producto->codigo_producto?>
                    </td>
<!--                    <td class="shopping-cart-quantity">
                      <div class="product-quantity">
                          <div class="input-group bootstrap-touchspin input-group-sm">
                              <span class="input-group-btn">
                                  <a href="" class="btn quantity-down bootstrap-touchspin-down" type="button">
                                      <i class="fa fa-angle-down"></i></a></span>
                                      <span class="input-group-addon bootstrap-touchspin-prefix"></span>
                                      <input id="product-quantity" type="text" value="1" readonly="" class="form-control input-sm">
                                      <span class="input-group-addon bootstrap-touchspin-postfix"></span>
                                      <span class="input-group-btn">
                                          <a href="" class="btn quantity-up bootstrap-touchspin-up" >
                                              <i class="fa fa-angle-up">
                                                  
                                              </i></a></span></div>
                      </div>
                    </td>-->
                    
                    <td class="shopping-cart-price" >
                      <strong><span>$</span><?php
                           $total+=$modelo->precio;
                          echo $modelo->precio;?></strong>
                    </td>
                   
                     <td>
                         <a href="eliminar?id_producto=<?=$producto->id_producto?>"><img class="img-responsive" alt="" src="/basic/web/uploads/quitar.jpg" style="size: 5px"  ></a>
                    </td>
                  </tr>
                            <?php }} ?>
                  
                </tbody></table>
                </div>

                <div class="shopping-total">
                  <ul>
                    
                    <li class="shopping-total-price" >
                      <em >Total</em>
                      <strong  style="padding-right: 80px " class="price"><span>$</span>
                          <?php if($modelo!=NULL){
                                    echo $total;
                                 }?></strong>
                    </li>
                  </ul>
                </div>
              </div>
                
                <a style="padding-left: 30px" href="/basic/web"  class="btn  btn-info fa fa-shopping-cart">&nbsp;Continuar Comprando</a>
                
                     
                <?php if($total >= Yii::$app->user->identity->monto){?>
                     <span style="padding-left: 100px"><a href="reservar?total=<?=$total?>" class="btn  disabled btn-danger fa fa-exclamation-triangle">&nbsp;No tiene suficiente dinero para realizar esta compra</a></span>
                     
               <?php }else{?>
                     <span style="padding-left: 100px"><a href="reservar?total=<?=$total?>" class="btn  btn-success fa fa-check">&nbsp;Comprar</a></span>
                     
               <?php } ?>
                <?php }else{ ?>
                     <h1>Carrito de Compras</h1>
                     <br>
                     <br>
                     <br>
                     <br>
                     <br>
                     <h2><strong>El Carrito de Compras está vacío</strong></h2>
                     <br>
                     <br>
                     <a style="padding-left: 40px" href="/basic/web"  class="btn  btn-info fa fa-shopping-cart">&nbsp;Volver al Inicio</a>
                <?php }?>
                     
                     
               
               
                
                
                
              </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN SIMILAR PRODUCTS -->
        <div class="row margin-bottom-40">
          
        </div>
        <!-- END SIMILAR PRODUCTS -->
      </div>
    </div>

    <!-- BEGIN STEPS -->
    
    


    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
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
    <!-- END LayerSlider -->

    
   
    <script type="text/javascript" src="Shopping%20cart%20_%20Metronic%20Shop%20UI_files/app.js"></script>   
    <script type="text/javascript">
        jQuery(document).ready(function() {
            App.init();
            App.initBxSlider();
            App.initImageZoom();
            App.initTouchspin();
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->

</body><!-- END BODY --></html>
