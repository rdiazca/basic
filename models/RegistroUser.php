<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use yii\helpers\ArrayHelper;
use app\models\AuthItem;
use app\models\AuthAssignment;





/**
 * Signup form
 */
class RegistroUser extends Model {

    public $nombre_usuario;
    public $correo;
    public $password;
    public $repetir_password;
    public $rol;
   
  

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nombre_usuario', 'correo', 'password','repetir_password'], 'string', 'max' => 255],
            
            [['nombre_usuario', 'correo', 'password', 'repetir_password'],'required', 'message' => 'Campo requerido'],
             ['nombre_usuario', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],

            ['correo', 'email', 'message' => 'Formato no válido'],
            [['correo'],'unique','targetClass' => '\app\models\User', 'message' => 'Este email ya ha sido usado.'],
        
            [['nombre_usuario'], 'unique', 'targetClass' => '\app\models\User', 'message' => 'Existen otros usuarios con este nombre.'],
            ['repetir_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
            
            ['rol','required'],
                  
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
//     public function getRoles(){
//        $roles = AuthItem::find()->asArray()->all();
//        return ArrayHelper::map($roles, 'name', 'name');
//
//    }
    
     public function getRoles(){
         $admin = AuthAssignment::find()->where(['item_name'=>'Administrador'])->one();
         $roles = null;
        
         if($admin == null){
        $roles = AuthItem::find()->asArray()->all();
        
         }
         else{
           $roles = AuthItem::find()->asArray()->all();
            
//          $roles = AuthItem::find()->asArray()->where(['name'<>'Administrador'])->all(); 
            array_shift($roles);
         }
         return ArrayHelper::map($roles, 'name', 'name');

    }
    
     public function registrar()
    {
        if ($this->validate()) {
            $user = new User();
            $user->id_estado=1;
            $user->monto = 0;
            $roleAssignment = new AuthAssignment();
            $user->nombre_usuario = $this->nombre_usuario;
            $user->correo=$this->correo;
            $user->password=$this->password;    
            $user->repetir_password=$this->repetir_password;   
             
            if ($user->save()) { 
                
                $user->password = sha1($user->password);
                User::updateAll(['password'=>$user->password], ['id_usuario'=>$user->id_usuario]);
                $roleAssignment->item_name = "$this->rol";
                $roleAssignment->user_id = "$user->id_usuario";
                $roleAssignment->save();
                return $user;
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           
           
            'nombre_usuario' => 'Nombre Usuario',
            'correo' => 'Correo',
            'password' => 'Contraseña',
            'repetir_password' => 'Repetir Contraseña',
            'rol'=>'Rol',
        ];
    }
  

}


