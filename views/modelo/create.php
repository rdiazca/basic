<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Modelo */

$this->title = 'Crear Modelo';
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelo-create">

    <h1><?= Html::encode($this->title) ?></h1>
<?php $showCmB = TRUE; ?>

    <?= $this->render('_form', [
        'model' => $model, 'show'=>$showCmB
    ]) ?>

</div>
