<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Modelo */

$this->title = 'Actualizar Modelo: ' . $model->modelo;
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->modelo, 'url' => ['view', 'id' => $model->id_modelo]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="modelo-update">

    <h1><?= Html::encode($this->title) ?></h1>
<?php $showCmB = FALSE; ?>
    <?= $this->render('_form', [
        'model' => $model, 'show'=>$showCmB
    ]) ?>

</div>
