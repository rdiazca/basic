<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "producto".
 *
 * @property integer $id_producto
 * @property integer $id_estado
 * @property integer $id_modelo
 * @property string $codigo_producto
 *
 * @property Estado $idEstado
 * @property Modelo $idModelo
 * @property Reserva[] $reservas
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_estado', 'id_modelo'], 'required'],
            [['id_estado', 'id_modelo'], 'integer'],
            [['codigo_producto'], 'string', 'max' => 255],
            [['id_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['id_estado' => 'id_estado']],
            [['id_modelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['id_modelo' => 'id_modelo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_producto' => 'Producto',
            'id_estado' => 'Estado',
            'id_modelo' => 'Modelo',
            'codigo_producto' => 'Código Producto',
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
    public function getIdModelo()
    {
        return $this->hasOne(Modelo::className(), ['id_modelo' => 'id_modelo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::className(), ['id_producto' => 'id_producto']);
    }
    
      public function getModelos(){
        $modelos = Modelo::find()->asArray()->all();
        return ArrayHelper::map($modelos, 'id_modelo', 'modelo');

    }
      public function getModelosDeJefe(){
        $departamento = Departamento::find()->where(['id_jefe'=>Yii::$app->user->id])->one();
        $modelos = Modelo::find()->where(['id_departamento'=>$departamento->id_departamento])->all();
        return ArrayHelper::map($modelos, 'id_modelo', 'modelo');

    }
}
