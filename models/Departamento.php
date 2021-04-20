<?php

namespace app\models;

use Yii;
use app\models\User;
use yii\helpers\ArrayHelper;
use app\models\AuthAssignment;


/**
 * This is the model class for table "departamento".
 *
 * @property integer $id_departamento
 * @property integer $id_jefe
 * @property integer $id_estado
 * @property string $nombre_departamento
 * @property string $icono
 *
 * @property Estado $idEstado
 * @property User $idJefe
 * @property Modelo[] $modelos
 * @property Reserva[] $reservas
 */
class Departamento extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_jefe', 'id_estado'], 'required'],
            [['id_jefe', 'id_estado'], 'integer'],
            [['nombre_departamento'], 'string', 'max' => 255],
            [['id_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['id_estado' => 'id_estado']],
            [['id_jefe'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_jefe' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_departamento' => 'Id Departamento',
            'id_jefe' => 'Jefe',
            'id_estado' => 'Estado',
            'nombre_departamento' => 'Nombre Departamento',
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado()
    {
        return $this->hasOne(Estado::className(), ['id_estado' => 'id_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJefe()
    {
        return $this->hasOne(User::className(), ['id_usuario' => 'id_jefe']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelos()
    {
        return $this->hasMany(Modelo::className(), ['id_departamento' => 'id_departamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::className(), ['id_departamento' => 'id_departamento']);
    }
    
    
    public function getJefesa(){
        $jefes = User::find()->asArray()->all();
        return ArrayHelper::map($jefes, 'id_usuario', 'nombre_usuario');

    }
      public function getJefes(){

        $jefes = AuthAssignment::find()->where(['item_name'=>"Jefe Departamento"])->all();
        $usuarios = array();
        $cant=0;
        foreach ($jefes as $jefe){
            
            $usuarios[$cant]=User::find()->where(['id_usuario'=>$jefe->user_id])->one();
             
            $cant=$cant+1;
            
        }
       
        return ArrayHelper::map($usuarios, 'id_usuario', 'nombre_usuario');

    }
}
