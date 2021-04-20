<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php                 

        

use app\models\User;




?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mejores Clientes</title>
    </head>
    <body>
        <div><h2><strong><i>Usuarios con más compras realizadas</i></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2></div>
       
        <br>
        <br>
        <table style="text-align: center" border=2 >
            <tr>
           
                    <th >&nbsp;Nombre de Usuario</th>
                    <th >&nbsp;&nbsp;Correo electrónico</th>
                    <th >&nbsp;&nbsp;Cantidad de compras</th>
               
                </tr>                
                      <?php 
                      $i=0;

                      foreach ($cincoMejoresUsuarios as $idUsuario) {
     	$usuario=User::find()->where(['id_usuario'=>$idUsuario])->one();
          
                         ?>

                         <tr><td><?= $usuario->nombre_usuario;?></td>
                         	<td ><?=$usuario->correo?></td>                                         
                    <td ><?=$cincoMayoresCompras[$i]?></td>
                         </tr>
                         <?php $i++;
                     }
                         ?>         
                  
                </table>                    
    </body>
</html>


    
