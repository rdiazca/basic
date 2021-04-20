<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModeloRelacionado */

$this->title = 'Create Modelo Relacionado';
$this->params['breadcrumbs'][] = ['label' => 'Modelo Relacionados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelo-relacionado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
