<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Estado;
use \app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
     <?php $rol = Yii::$app->user->identity->getRol(); 
    
    if($rol == "Administrador Sistema"){ ?>
    <p>
        <?= Html::a('Nuevo Usuario', ['site/registrar'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php } ?>
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

           // 'id_usuario',
            'nombre_usuario',
            'correo',
            'monto',
            
            ['class'=> 'yii\grid\DataColumn',
              'attribute'=>'id_estado',
              'value' => 'idEstado.estado'
                            
                            ],

              
        ],
    ]); ?>
</div>
