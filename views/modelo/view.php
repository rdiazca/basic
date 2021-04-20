<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Modelo */

$this->title = $model->modelo;
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_modelo], ['class' => 'btn btn-primary']) ?>
<!--         Html::a('Eliminar', ['delete', 'id' => $model->id_modelo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id_modelo',
            'idDepartamento.nombre_departamento',
            'modelo',
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
             
        ],
    ]) ?>

</div>
