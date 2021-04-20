<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Producto;
use app\models\Modelo;
use app\models\Estado;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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

            ['class'=> 'yii\grid\DataColumn',
              'attribute'=>'id_modelo',
              'value' => 'idModelo.modelo'
                            
                            ],

           
            'codigo_producto',

             ['class'=> 'yii\grid\DataColumn',
              'attribute'=>'id_estado',
              'value' => 'idEstado.estado'],
            
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
