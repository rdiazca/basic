<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

 

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModeloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Modelos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modelo-index">

    <h1><?= Html::encode($this->title) ?></h1>
   <!--<a href="reservar?total=<?=4?>" class="btn  btn-success glyphicon glyphicon-edit">&nbsp;Comprar</a>-->
    <?php //   echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php $rol = Yii::$app->user->identity->getRol(); 
    
    if($rol == "Jefe Departamento"){ ?>
    
   
    <p>
        <?= Html::a('Crear Modelo', ['create'], ['class' => 'btn btn-success']) ?> &nbsp&nbsp&nbsp&nbsp
        
        <?= Html::a('Crear Producto', ['producto/create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php } else { ?>
    <p>
        <?= Html::a('Crear Modelo', ['create'], ['class' => 'btn btn-success']) ?> &nbsp&nbsp&nbsp&nbsp
        
    </p>
    
    <?php } ?>
    
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

           // 'id_modelo',
          [ 'class'=> 'kartik\grid\ExpandRowColumn',
            'value'=>  function ($model, $key, $index, $column){
                    return GridView::ROW_COLLAPSED;        
            },
             'detail'=>function($model, $key, $index, $column){
                $searchModel = new app\models\ProductoSearch();
                $searchModel->id_modelo = $model->id_modelo;
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                
                return Yii::$app->controller->renderPartial('_productos',[
                    'searchModel'=>$searchModel,
                    'dataProvider'=>$dataProvider,
                      ]);
                        
                    },
               ],
            'modelo',
        
           
            ['class'=> 'yii\grid\DataColumn',
              'attribute'=>'id_departamento',
               
              'value' => 'idDepartamento.nombre_departamento',
              
                    
                            
                            ],

            'descripcion:ntext',
             [
             'attribute' => 'imagen',
              'format' => 'raw',
              'value' => function ($model) {
                 if($model->imagen != '' && $model->imagen != NULL){
                return Html::img('@web/uploads/modeloImg/modelo'.$model->id_modelo,
                    ['alt' => $model->imagen, 'width'=>75, 'height' => 50]);
                }else{
                  return Html::label('-?-');
                    }
                },
            ] ,           
             'precio',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update}',
                'buttons'=>[
                    'view' => function ($url, $model, $key) {

                            $url=\yii\helpers\Url::to(['view', 'id' => ''.$model->id_modelo]);
                            return  Html::a('', $url, ['title'=>'Detalles','class' => 'btn glyphicon glyphicon-eye-open']);


                        },

                    'update' => function ($url, $model, $key) {

                            $url=\yii\helpers\Url::to(['update', 'id' => ''.$model->id_modelo]);
                            return  Html::a('', $url, ['title'=>'Actualizar','class' => 'btn glyphicon glyphicon-edit']);


                        },

                   
                ],

            ],
        ],
    ]); ?>
</div>
