<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Modelo;

/**
 * ModeloSearch represents the model behind the search form about `app\models\Modelo`.
 */
class ModeloSearch extends Modelo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_modelo', 'id_departamento'], 'integer'],
            [['modelo', 'descripcion', 'imagen'], 'safe'],
            [['precio'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Modelo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_modelo' => $this->id_modelo,
            'id_departamento' => $this->id_departamento,
            'precio' => $this->precio,
        ]);

        $query->andFilterWhere(['like', 'modelo', $this->modelo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'imagen', $this->imagen]);

        return $dataProvider;
    }
    
    public function search2($idusuario){
       $departamento = Departamento::find()->where(['id_jefe'=>$idusuario])->one();
       $query = Modelo::find()->where(['id_departamento'=>$departamento->id_departamento]);
       $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
         
         
     
         $query->andFilterWhere([
             'id_modelo'=>$this->id_modelo,
             'id_departamento'=>$this->id_departamento,
             'precio' => $this->precio,
         ]);
         $query->andFilterWhere(['like', 'modelo', $this->modelo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'imagen', $this->imagen]);
        
         return $dataProvider;
         
    }
}
