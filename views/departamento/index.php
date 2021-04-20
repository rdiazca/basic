<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\models\Departamento;
use app\models\Estado;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Departamento', ['create'], ['class' => 'btn btn-success']) ?>
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
            
            'nombre_departamento',

            ['class'=> 'yii\grid\DataColumn',
               'attribute' => 'id_jefe',
              'value' => 'idJefe.nombre_usuario'
                           
                            
            ],
          
            
//            'icono',

         ['class'=> 'yii\grid\DataColumn',
              'attribute'=>'id_estado',
              'value' => 'idEstado.estado',
                            
                            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
