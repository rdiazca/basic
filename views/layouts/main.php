<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\AuthAssignment;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
     <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<!-- Global styles END --> 
   
	<!-- Page level plugin styles START -->
	<link href="css/jquery.fancybox.css" rel="stylesheet">              
	<link href="css/jquery.bxslider.css" rel="stylesheet">
	<link rel="stylesheet" href="css/layerslider.css" type="text/css">
	<!-- Page level plugin styles END -->

	<!-- Theme styles START -->
	<link href="css/style-metronic.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/style-responsive.css" rel="stylesheet" type="text/css">  
	<link href="css/custom.css" rel="stylesheet" type="text/css">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <br>
    <br>
    <br>
    <br>
    
    <ul class="nav navbar-nav">
        <?php $departamentosHab=  \app\models\Departamento::find()->where(['id_estado'=>1])->all();?>
        
               
       <?php foreach ($departamentosHab as $departamento){ ?>
        <li><a href="/basic/web/departamento/productos?id_departamento=<?= $departamento->id_departamento?>">
               <?= $departamento->nombre_departamento;?></a></li> 
        <?php } ?>
    </ul> 
                           
<?php $this->beginBody()

?>

<div class="wrap">
    <?php

    NavBar::begin([
        'brandLabel' => 'Inicio',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
     if (!\Yii::$app->user->isGuest){
     $iduser = Yii::$app->user->getId();
//     $user = User::find()->where(['id_usuario'=>$iduser])->one();
     $rol= AuthAssignment::find()->where(['user_id'=>$iduser])->one();
    // var_dump($rol);
     }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

            
            ['label' => 'Contáctenos', 'url' => ['/site/contact'],'visible' => !\Yii::$app->user->isGuest && $rol->item_name == 'Comprador'],
            ['label' => 'Mejores Clientes', 'url' => ['/site/mejores'], 'visible' => !\Yii::$app->user->isGuest && $rol->item_name == 'Administrador'],
            ['label' => 'Productos', 'url' => ['/producto/index'], 'visible' => !\Yii::$app->user->isGuest && $rol->item_name == 'Administrador'],
            ['label' => 'Modelos y Productos', 'url' => ['/modelo/index'], 'visible' => !\Yii::$app->user->isGuest && $rol->item_name == 'Jefe Departamento'],
            ['label' => 'Modelos', 'url' => ['/modelo/index'], 'visible' => !\Yii::$app->user->isGuest && $rol->item_name == 'Administrador'],
             ['label' => 'Departamentos', 'url' => ['/departamento/index'], 'visible' => !\Yii::$app->user->isGuest && $rol->item_name == 'Administrador'],
            ['label' => 'Usuarios', 'url' => ['/user/index'], 'visible' => !\Yii::$app->user->isGuest && ($rol->item_name == 'Administrador' || $rol->item_name == 'Administrador Sistema')],
            ['label' => 'Editar Perfil', 'url' => ['/user/update','id' => Yii::$app->user->getId()],'visible' => !\Yii::$app->user->isGuest],
            ['label' => 'Carrito', 'url' => ['/site/carrito'],'visible' => !\Yii::$app->user->isGuest && $rol->item_name == 'Comprador'],

            Yii::$app->user->isGuest ? (
                ['label' => 'Iniciar Sesión', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Cerrar Sesión(' . Yii::$app->user->identity->nombre_usuario . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Tienda Virtual <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

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
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>