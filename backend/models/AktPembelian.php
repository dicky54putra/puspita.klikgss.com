<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "akt_pembelian".
 *
 * @property int $id_pembelian
 * @property string $no_order_pembelian
 * @property int $id_customer
 * @property int $id_mata_uang
 * @property string $no_pembelian
 * @property string $tanggal_pembelian
 * @property string $no_faktur_pembelian
 * @property string $tanggal_faktur_pembelian
 * @property int $ongkir
 * @property int $diskon
 * @property int $pajak
 * @property int $total
 * @property int $jenis_bayar
 * @property int $jatuh_tempo
 * @property string $tanggal_tempo
 * @property int $materai
 * @property int $id_penagih
 * @property int $status
 */
class AktPembelian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'akt_pembelian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_order_pembelian', 'id_customer',], 'required'],
            [['id_customer', 'id_mata_uang', 'diskon', 'pajak', 'total', 'jenis_bayar', 'jatuh_tempo', 'materai', 'id_penagih', 'status', 'uang_muka', 'id_kas_bank'], 'integer'],
            [['tanggal_pembelian', 'tanggal_faktur_pembelian', 'tanggal_tempo', 'tanggal_order_pembelian', 'tanggal_penerimaan', 'tanggal_estimasi'], 'safe'],
            [['no_order_pembelian', 'no_pembelian', 'no_faktur_pembelian', 'no_penerimaan', 'pengantar', 'penerima', 'no_spb'], 'string', 'max' => 255],
            [['keterangan_penerimaan'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pembelian' => 'Id Pembelian',
            'no_order_pembelian' => 'No Order Pembelian',
            'id_customer' => 'Customer',
            'id_mata_uang' => 'Mata Uang',
            'no_pembelian' => 'No Pembelian',
            'tanggal_pembelian' => 'Tanggal Pembelian',
            'no_faktur_pembelian' => 'No Faktur Pembelian',
            'tanggal_faktur_pembelian' => 'Tanggal Faktur Pembelian',
            'ongkir' => 'Ongkir',
            'diskon' => 'Diskon',
            'pajak' => 'Pajak 10%',
            'total' => 'Total',
            'jenis_bayar' => 'Jenis Bayar',
            'jatuh_tempo' => 'Jatuh Tempo',
            'tanggal_tempo' => 'Tanggal Tempo',
            'materai' => 'Materai',
            'id_penagih' => 'Penagih',
            'status' => 'Status',
            'uang_muka' => 'Uang Muka',
            'tanggal_estimasi' => 'Tanggal Estimasi'
        ];
    }

    public function getcustomer()
    {
        return $this->hasOne(AktMitraBisnis::className(), ['id_mitra_bisnis' => 'id_customer']);
    }

    public function getmata_uang()
    {
        return $this->hasOne(AktMataUang::className(), ['id_mata_uang' => 'id_mata_uang']);
    }

    public function getkas_bank()
    {
        return $this->hasOne(AktKasBank::className(), ['id_kas_bank' => 'id_kas_bank']);
    }

    public function getpenagih()
    {
        return $this->hasOne(AktMitraBisnis::className(), ['id_mitra_bisnis' => 'id_penagih'])->from(["penagih" => AktMitraBisnis::tableName()]);
    }

    public function getpengirim()
    {
        return $this->hasOne(AktMitraBisnis::className(), ['id_mitra_bisnis' => 'id_pengirim'])->from(["pengirim" => AktMitraBisnis::tableName()]);
    }
}
