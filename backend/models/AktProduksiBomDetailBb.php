<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "akt_produksi_bom_detail_bb".
 *
 * @property int $id_produksi_bom_detail_bb
 * @property int $id_produksi_bom
 * @property int $id_item
 * @property int $qty
 * @property string $keterangan
 */
class AktProduksiBomDetailBb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'akt_produksi_bom_detail_bb';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_produksi_bom', 'id_item_stok', 'qty', 'keterangan'], 'required'],
            [['id_produksi_bom', 'id_item_stok', 'qty'], 'integer'],
            [['keterangan'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_produksi_bom_detail_bb' => 'Id Produksi Bom Detail Bb',
            'id_produksi_bom' => 'Id Produksi Bom',
            'id_item_stok' => 'Id Item',
            'qty' => 'Qty',
            'keterangan' => 'Keterangan',
        ];
    }
}
