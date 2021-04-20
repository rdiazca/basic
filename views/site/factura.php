<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
$total=0;
use app\models\Reserva;
use app\models\User;
use app\models\Producto;

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Factura</title>
    </head>
    <body>
        <div><h2><strong><i>Factura de Compra</i></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>No. <?php echo rand(33333, 99999); ?></em></h2></div>
       
        <br>
        <br>
        <table  >
            <tr>
           
                    <th >&nbsp;Modelo</th>
                    <th >&nbsp;&nbsp;Descripción</th>
                    <th >&nbsp;&nbsp;Código</th>
                    <th >&nbsp;&nbsp;Precio</th>
                </tr>  
                
                <tr><td>&nbsp;</td></tr>
                      <?php 
                      $id=  Yii::$app->user->identity->id_usuario;
                      $reservas= Reserva::find()->where(['id_usuario'=>$id])->andWhere(['id_estado'=>3])->all() ;
                      
                   
                     
                   
                        
                        
                        foreach ($reservas as $reserva){
                           
                            $producto= app\models\Producto::find()->where(['id_producto'=>$reserva->id_producto])->one();
                            $modelo= \app\models\Modelo::find()->where(['id_modelo'=>$producto->id_modelo])->one();
                         ?>
                  <tr>
                       
             
                    <td >
                        <textarea>&nbsp;<?php  echo $modelo->modelo;?>&nbsp; </textarea>
                    <td ><textarea cols="50" readonly="">&nbsp; <?=$modelo->descripcion?>&nbsp;</textarea>
               </td>
                      
                    
               <td ><textarea>&nbsp; <?=$producto->codigo_producto?>&nbsp;</textarea>
                    </td>
                    <td >
                      <strong><span>&nbsp;&nbsp;$</span><?php
                           $total+=$modelo->precio;
                          echo $modelo->precio;?></strong>
                    </td>

                    
             
                   
                          </tr>
                          <?php }?>
                      
                          <tr >
                              <th colspan="4" style="text-align: right"><h4><strong>Total: $<?php echo $total;?>&nbsp;&nbsp;</strong></h4></th>
                          </tr>
                  
                </table>
        <br>
        <h4>Datos del Cliente</h4>
        
         <ul>
             <li>Nombre: <?= Yii::$app->user->identity->nombre_usuario;?></li>
             <li>Correo: <?= Yii::$app->user->identity->correo;?></li>
             
             <li><strong>Costo de la Compra: $<?php echo $total;?></strong></li>
             
             
         <?php
         $montoI =Yii::$app->user->identity->monto;
         $monto=$montoI-$total;
         User::updateAll(['monto'=>$monto],['id_usuario'=>$id]); ?>
             <li><strong>Total en Cuenta: $ <?= $monto;?></strong></li>
             
        </ul>
        <br>
        <br><br><br><br>
        <h3><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gracias por su Visita.Vuelva Pronto</em></h3>
        
        <?php  
        foreach ($reservas as $reserva){
                          Reserva::updateAll(['id_estado'=>'4'], ['id_reserva'=>$reserva->id_reserva]);
                          Producto::updateAll(['id_estado'=>'4'],['id_producto'=>$reserva->id_producto]);
         }?>
       
                      
                  
    </body>
</html>
