<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modelo_relacionado".
 *
 * @property integer $id_modelo_relacionado
 * @property integer $id_modelo
 *
 * @property Modelo $idModelo
 */
class ModeloRelacionado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modelo_relacionado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_modelo'], 'required'],
            [['id_modelo'], 'integer'],
            [['id_modelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['id_modelo' => 'id_modelo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_modelo_relacionado' => 'Id Modelo Relacionado',
            'id_modelo' => 'Id Modelo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdModelo()
    {
        return $this->hasOne(Modelo::className(), ['id_modelo' => 'id_modelo']);
    }
}
