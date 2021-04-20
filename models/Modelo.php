<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Modelo;

/**
 * This is the model class for table "modelo".
 *
 * @property integer $id_modelo
 * @property integer $id_departamento
 * @property string $modelo
 * @property string $descripcion
 * @property string $imagen
 * @property double $precio
 *
 * @property Departamento $idDepartamento
 * @property ModeloRelacionado[] $modeloRelacionados
 * @property Producto[] $productos
 */
class Modelo extends \yii\db\ActiveRecord
{
    public $file;
    public $id_modeloRel1;
    public $id_modeloRel2;
    public $id_modeloRel3;
    public $id_modeloRel4;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modelo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_departamento', 'modelo', 'precio'], 'required'],
            [['id_departamento'], 'integer'],
            [['id_modeloRel1'], 'integer'],
            [['id_modeloRel2'], 'integer'],
            [['id_modeloRel3'], 'integer'],
            [['id_modeloRel4'], 'integer'],
			['id_modeloRel1', 'compare', 'compareAttribute' => 'id_modeloRel2', 'operator' => '!='],
            ['id_modeloRel1', 'compare', 'compareAttribute' => 'id_modeloRel3', 'operator' => '!='],
            ['id_modeloRel1', 'compare', 'compareAttribute' => 'id_modeloRel4', 'operator' => '!='],
            ['id_modeloRel2', 'compare', 'compareAttribute' => 'id_modeloRel3', 'operator' => '!='],
            ['id_modeloRel2', 'compare', 'compareAttribute' => 'id_modeloRel4', 'operator' => '!='],
            ['id_modeloRel3', 'compare', 'compareAttribute' => 'id_modeloRel4', 'operator' => '!='],
            
			[['descripcion'], 'string'],
            [['precio'], 'number'],
            [['modelo'], 'string', 'max' => 255],
            [['imagen'], 'string', 'max' => 355],
            [['file'],'file'],
            [['id_departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['id_departamento' => 'id_departamento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_modelo' => 'Modelo',
            'id_departamento' => 'Departamento',
            'modelo' => 'Modelo',
            'descripcion' => 'Descripción',
            'file' => '',
            'precio' => 'Precio',
            'id_modeloRel1' => 'Producto Relacionado 1',
            'id_modeloRel2' => 'Producto Relacionado 2',
            'id_modeloRel3' => 'Producto Relacionado 3',
            'id_modeloRel4' => 'Producto Relacionado 4'
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
    public function getModeloRelacionados()
    {
        return $this->hasMany(ModeloRelacionado::className(), ['id_modelo' => 'id_modelo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['id_modelo' => 'id_modelo']);
    }
    
      public function getDepartamentos(){
        $departamentos = Departamento::find()->asArray()->all();
        return ArrayHelper::map($departamentos, 'id_departamento', 'nombre_departamento');

    }
    
    public function getModelos(){
        
        $modelos = Modelo::find()->all();
        return ArrayHelper::map($modelos, 'id_modelo', 'modelo');
               
    }
    
    public function cantProductos($modelo){
        $productos = Producto::find()->where(['id_modelo'=>$modelo->id_modelo])->andWhere(['id_estado'=>1])->all();
        $cant = count($productos);
        return $cant;
    }
}
