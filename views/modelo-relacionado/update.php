<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ModeloRelacionado */

$this->title = 'Update Modelo Relacionado: ' . $model->id_modelo_relacionado;
$this->params['breadcrumbs'][] = ['label' => 'Modelo Relacionados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_modelo_relacionado, 'url' => ['view', 'id' => $model->id_modelo_relacionado]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modelo-relacionado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
