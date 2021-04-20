<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModeloRelacionadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Modelo Relacionados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelo-relacionado-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Modelo Relacionado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_modelo_relacionado',
            'id_modelo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
