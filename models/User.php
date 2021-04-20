<?php

namespace app\models;

use Yii;
use app\models;
use yii\helpers\ArrayHelper;
use \yii\web\IdentityInterface;
use  \yii\db\ActiveRecord;
use app\models\AuthAssignment;
/**
 * This is the model class for table "user".
 *
 * @property integer $id_usuario
 * @property integer $id_estado
 * @property string $nombre_usuario
 * @property string $correo
 * @property string $password
 * @property double $monto
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 * @property Departamento[] $departamentos
 * @property Reserva[] $reservas
 * @property Estado $idEstado
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $repetir_password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_estado'], 'integer'],
            [['monto'], 'number'],
            [['nombre_usuario', 'correo', 'password'], 'string', 'max' => 255],
            [['nombre_usuario', 'correo', 'password', 'repetir_password'],'required', 'message' => 'Campo requerido'],
            [['correo'],'email'],
            [['correo'],'unique','targetClass' => '\app\models\User', 'message' => 'Este email ya ha sido usado.'],
            [['nombre_usuario'], 'unique', 'targetClass' => '\app\models\User', 'message' => 'Existen otros usuarios con este nombre.'],
            [['id_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['id_estado' => 'id_estado']],
            ['repetir_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'id_estado' => 'Estado',
            'nombre_usuario' => 'Nombre Usuario',
            'correo' => 'Correo',
            'password' => 'Contraseña',
            'repetir_password' => 'Repetir Contraseña',
            'monto' => 'Monto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentos()
    {
        return $this->hasMany(Departamento::className(), ['id_jefe' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado()
    {
        return $this->hasOne(Estado::className(), ['id_estado' => 'id_estado']);
    }
    
    public function getAuthKey() {
        return null;
    }
     public function getId() {
        return $this->id_usuario;
    }
    public function validateAuthKey($authKey) {
        return null;
    }
    
     public static function findIdentity($id)
    {
        return static::findOne(['id_usuario' => $id]);
    }
       public static function findIdentityByAccessToken($token, $type = null) {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }
    
      public static function findByUsername($username)
    {
        return static::findOne(['nombre_usuario' => $username]);
    }
    
     public function validatePassword($password)
    {
        return $this->password===sha1($password);
    }
    
    /*buscar si el rol del usuario esta en el arreglo pasado*/
    public static function roleInArray($arr_role)
    {
        $find_role = AuthAssignment::find()->where(['user_id' => Yii::$app->user->identity->id_usuario])->one();
        $role = $find_role->item_name;
    return in_array($role, $arr_role);
    } 
    
     public function getRol(){
        $userActivo= Yii::$app->user;
        $rol = AuthAssignment::find()->where(['user_id'=>$userActivo->id])->one();
        
        return $rol->item_name;
    }
    
    
}
