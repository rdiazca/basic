<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

 
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
   
    <?= $form->field($model, 'nombre_usuario')->textInput(['maxlength' => true,'placeholder' => 'Usuario', 'pluginOptions' => ['allowClear' => true]]) ?>

    <?= $form->field($model, 'correo')->textInput(['maxlength' => true,'placeholder' => 'Correo', 'pluginOptions' => ['allowClear' => true]]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'placeholder' => 'Contraseña', 'pluginOptions' => ['allowClear' => true]]) ?>
    
    <?= $form->field($model, 'repetir_password')->passwordInput(['maxlength' => true,'placeholder' => 'Repetir Contraseña', 'pluginOptions' => ['allowClear' => true]]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

