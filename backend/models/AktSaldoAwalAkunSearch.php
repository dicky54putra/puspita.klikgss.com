<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AktSaldoAwalAkun;

/**
 * AktSaldoAwalAkunSearch represents the model behind the search form of `backend\models\AktSaldoAwalAkun`.
 */
class AktSaldoAwalAkunSearch extends AktSaldoAwalAkun
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_saldo_awal_akun', 'tipe'], 'integer'],
            [['no_jurnal', 'tanggal'], 'safe'],
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
        $query = AktSaldoAwalAkun::find();

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

        if (!empty($this->tanggal_order_pembelian)) {
            $query->andFilterWhere(["date_format(tanggal_order_pembelian, '%d-%m-%Y')" => $this->tanggal_order_pembelian]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_saldo_awal_akun' => $this->id_saldo_awal_akun,
            'tipe' => $this->tipe,
        ]);

        $query->andFilterWhere(['like', 'no_jurnal', $this->no_jurnal]);

        return $dataProvider;
    }
}
