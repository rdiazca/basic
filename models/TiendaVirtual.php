<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property integer $id_producto
 * @property integer $id_departamento
 * @property string $nombre_producto
 * @property string $descripcion_producto
 * @property string $imagen
 * @property boolean $envio_gratuito
 * @property boolean $habilitado
 * @property integer $tiempo_entrega
 * @property integer $cantidad_productos
 * @property integer $id_estado
 *
 * @property Departamento $idDepartamento
 * @property Estado $idEstado
 * @property ProductoRelacionado[] $productoRelacionados
 */
class TiendaVirtual extends \yii\db\ActiveRecord
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
            [['id_departamento', 'tiempo_entrega', 'cantidad_productos', 'id_estado'], 'integer'],
            [['envio_gratuito', 'habilitado'], 'boolean'],
            [['nombre_producto', 'descripcion_producto', 'imagen'], 'string', 'max' => 255],
            [['id_departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['id_departamento' => 'id_departamento']],
            [['id_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['id_estado' => 'id_estado']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_producto' => 'Id Producto',
            'id_departamento' => 'Id Departamento',
            'nombre_producto' => 'Nombre Producto',
            'descripcion_producto' => 'Descripcion Producto',
            'imagen' => 'Imagen',
            'envio_gratuito' => 'Envio Gratuito',
            'habilitado' => 'Habilitado',
            'tiempo_entrega' => 'Tiempo Entrega',
            'cantidad_productos' => 'Cantidad Productos',
            'id_estado' => 'Id Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDepartamento()
    {
        return $this->hasOne(Departamento::className(), ['id_departamento' => 'id_departamento']);
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
    public function getProductoRelacionados()
    {
        return $this->hasMany(ProductoRelacionado::className(), ['id_producto' => 'id_producto']);
    }
}
