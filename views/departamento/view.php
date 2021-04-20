<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Departamento */

$this->title = $model->nombre_departamento;
$this->params['breadcrumbs'][] = ['label' => 'Departamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id_departamento], ['class' => 'btn btn-primary']) ?>
<!--         Html::a('Eliminar', ['delete', 'id' => $model->id_departamento], [
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
//            'id_departamento',
            'nombre_departamento',
            'idJefe.nombre_usuario',
            'idEstado.estado',
            
            'icono',
        ],
    ]) ?>

</div>
