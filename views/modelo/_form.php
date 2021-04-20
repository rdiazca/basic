<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Modelo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modelo-form">

    <?php $form = ActiveForm::begin(); 
     $rol = Yii::$app->user->identity->getRol();
     
      if($rol == "Administrador"){
        
       echo $form->field($model, 'id_departamento')->dropDownList($model->departamentos,['prompt'=>'--Seleccione--']);
    }
    
    else {
        echo $form->field($model, 'id_departamento')->dropDownList($model->departamentoJefe);
    }
    ?>

     

    <?= $form->field($model, 'modelo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <label>Imagen</label><br>
    <img id="output" style="width: 125px"/>
    <?= $form->field($model, 'file')->fileInput(['accept' => 'image/*', 'onchange' => 'loadFile(event)']) ?>
    <script>
        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>

    <?= $form->field($model, 'precio')->textInput() ?> 

    <?php if ($show) { ?>
    
    <?= $form->field($model, 'id_modeloRel1')->dropDownList($model->modelos,['prompt'=>'Producto relacionado 1']); ?>  

    <?= $form->field($model, 'id_modeloRel2')->dropDownList($model->modelos,['prompt'=>'Producto relacionado 2']); ?>  

    <?= $form->field($model, 'id_modeloRel3')->dropDownList($model->modelos,['prompt'=>'Producto relacionado 3']); ?>  

    <?= $form->field($model, 'id_modeloRel4')->dropDownList($model->modelos,['prompt'=>'Producto relacionado 4']); ?> 

    <?php } ?>
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
