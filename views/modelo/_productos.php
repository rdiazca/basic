<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Producto;
use app\models\Modelo;
use app\models\Estado;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="producto-index">

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
          'rowOptions'=>function($model){
        if($model->id_estado=='2'){
            return ['class'=>'danger'];
        }
        else
            if($model->id_estado=='1'){
                return ['class'=>'success'];
            }
        
        },
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            

           
            'codigo_producto',

             ['class'=> 'yii\grid\DataColumn',
              'attribute'=>'id_estado',
              'value' => function ($url, $model, $key) {
               $producto = Producto::find()->where(['id_producto'=>$model])->one();
                $estado = Estado::find()->where(['id_estado'=>$producto->id_estado])->one();

                return  $estado->estado;
                    },
                    ],
            
            
      ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'buttons'=>[
                    'view' => function ($url, $model, $key) {
                              
                            $url=\yii\helpers\Url::to(['producto/view', 'id' => ''.$model->id_producto]);
                            return  Html::a('', $url, ['title'=>'Detalles','class' => 'btn glyphicon glyphicon-eye-open']);


                        },

                    'update' => function ($url, $model, $key) {

                            $url=\yii\helpers\Url::to(['producto/update', 'id' => ''.$model->id_producto]);
                            return  Html::a('', $url, ['title'=>'Actualizar','class' => 'btn glyphicon glyphicon-edit']);


                        },

                    'delete' => function ($url, $model, $key) {
                            $url=\yii\helpers\Url::to(['producto/habilitar2', 'id' => ''.$model->id_producto]);
                            return  Html::a('', $url, ['title'=>'Habilitar/Deshabilitar','class' => 'btn glyphicon glyphicon-erase']);
                        },
                ],

            ],
           
        ],
    ]); ?>
</div>
