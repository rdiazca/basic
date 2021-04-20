<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Registrar Empleado';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

   <br> 

    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

          <div class="form-group">
         <?= $form->field($model, "nombre_usuario")->input("text") ?>   
         </div>

            <div class="form-group">
            <?= $form->field($model, "password")->input("password") ?>   
            </div>

            <div class="form-group">
            <?= $form->field($model, "repetir_password")->input("password") ?>   
           </div>

            <div class="form-group">
           <?= $form->field($model, "correo")->input("email") ?>   
           </div> 
            
            <div class="form-group">
            <?= $form->field($model, 'rol')->dropDownList($model->roles,['prompt'=>'--Seleccione--']) ?>
             </div> 
           
            
        </div>

               

        <div class="col-lg-12">
            <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
