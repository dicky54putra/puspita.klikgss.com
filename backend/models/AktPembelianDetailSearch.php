<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AktPembelianDetail;

/**
 * AktPembelianDetailSearch represents the model behind the search form of `backend\models\AktPembelianDetail`.
 */
class AktPembelianDetailSearch extends AktPembelianDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pembelian_detail', 'id_pembelian', 'id_item_stok', 'qty', 'harga', 'diskon', 'total'], 'integer'],
            [['keterangan'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = AktPembelianDetail::find();

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
            'id_pembelian_detail' => $this->id_pembelian_detail,
            'id_pembelian' => $this->id_pembelian,
            'id_item_stok' => $this->id_item_stok,
            'qty' => $this->qty,
            'harga' => $this->harga,
            'diskon' => $this->diskon,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}