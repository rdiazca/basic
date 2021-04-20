<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); 
    $rol = Yii::$app->user->identity->getRol();
   
    if($rol == "Administrador"){
        
       echo $form->field($model, 'id_modelo')->dropDownList($model->modelos,['prompt'=>'--Seleccione--']);
    }
    
    else if($rol == "Jefe Departamento"){
        
        echo $form->field($model, 'id_modelo')->dropDownList($model->ModelosDeJefe,['prompt'=>'--Seleccione--']);
        
    }
    ?>
    
    
    
   

    <?= $form->field($model, 'codigo_producto')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
