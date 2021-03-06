<?php

use yii\helpers\Html;
use backend\models\AktItem;
use backend\models\AktGudang;
use backend\models\AktItemStok;
use backend\models\AktAkun;
use backend\models\AktStokMasuk;
use backend\models\AktStokMasukDetail;
use backend\models\AktPembelianPenerimaan;
use backend\models\AktPembelianPenerimaanDetail;
use backend\models\AktPembelianDetail;

$this->title = 'Laporan Stok Masuk';
?>
<style>
    .table1 {
        font-size: 15px;
        font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }

    .table1 th,
    .table1 td {
        padding: 3px;
        line-height: 12px;
        text-align: left;
    }

    .table2 {
        font-size: 15px;
        font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        border-collapse: collapse;
    }

    .table2 th,
    .table2 td {
        border: 1px solid #000000;
        text-align: left;
        padding: 5px;
    }
</style>
<p>
    <h3 style="text-align: center;font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;">Laporan Stok Masuk <?= date('d/m/Y', strtotime($tanggal_awal)) ?> s/d <?= date('d/m/Y', strtotime($tanggal_akhir)) ?></h3>
</p>
<?php
$query_stok_masuk = AktStokMasuk::find()->where(["BETWEEN", "tanggal_masuk", $tanggal_awal, $tanggal_akhir])->orderBy("tanggal_masuk ASC")->asArray()->all();
foreach ($query_stok_masuk as $key => $data) {
    # code...
?>
    <table class="table1">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>No Transaksi</th>
                <th>Tipe</th>
                <th>Keterangan</th>
            </tr>
            <tr>
                <td><?= $data['nomor_transaksi'] ?></td>
                <td><?= date('d/m/Y', strtotime($data['tanggal_masuk'])) ?></td>
                <td><?= ($data['tipe'] == 1) ? 'Barang Masuk' : '' ?></td>
                <td><?= $data['keterangan'] ?></td>
            </tr>
        </thead>
    </table>

    <table class="table2">
        <thead>
            <tr>
                <th style="width: 1%;">#</th>
                <th>Nama Barang</th>
                <th style="width: 5%;">Qty</th>
                <th style="width: 10%;">Satuan</th>
                <th style="width: 15%;">Gudang</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query_stok_masuk_detail = AktStokMasukDetail::find()->where(['id_stok_masuk' => $data['id_stok_masuk']])->all();
            foreach ($query_stok_masuk_detail as $key => $dataa) {
                # code...
                $item_stok = AktItemStok::findOne($dataa['id_item_stok']);
                $item = AktItem::findOne($item_stok->id_item);
                $gudang = AktGudang::findOne($item_stok->id_gudang);
            ?>
                <tr>
                    <td><?= $no++ . '.' ?></td>
                    <td><?= $item->nama_item ?></td>
                    <td style="white-space: nowrap;"><?= $dataa['qty'] ?></td>
                    <td style="white-space: nowrap;"><?= $item->satuan->nama_satuan ?></td>
                    <td><?= $gudang->nama_gudang ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
<?php } ?>
<?php
$query_pembelian_penerimaan = AktPembelianPenerimaan::find()->where(["BETWEEN", "tanggal_penerimaan", $tanggal_awal, $tanggal_akhir])->orderBy("tanggal_penerimaan ASC")->all();
foreach ($query_pembelian_penerimaan as $key => $data) {
    # code...
?>
    <table class="table1">
        <thead>
            <tr>
                <th>No Transaksi</th>
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $data->no_penerimaan ?></td>
                <td><?= date('d/m/Y', strtotime($data->tanggal_penerimaan)) ?></td>
                <td><?= 'Penerimaan Pembelian' ?></td>
                <td><?= $data->keterangan_pengantar ?></td>
            </tr>
        </tbody>
    </table>
    <table class="table2">
        <thead>
            <tr>
                <th style="width: 1%;">#</th>
                <th>Nama Barang</th>
                <th style="width: 5%;">Qty</th>
                <th style="width: 10%;">Satuan</th>
                <th style="width: 15%;">Gudang</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            $query_pembelian_penerimaan_detail = AktPembelianPenerimaanDetail::find()->where(['id_pembelian_penerimaan' => $data['id_pembelian_penerimaan']])->all();
            foreach ($query_pembelian_penerimaan_detail as $key => $dataa) {
                # code...
                $no++;
                $retVal_id_pembelian_detail = (!empty($dataa->id_pembelian_detail)) ? $dataa->id_pembelian_detail : 0;
                $pembelian_detail = AktPembelianDetail::findOne($retVal_id_pembelian_detail);
                $item_stok = AktItemStok::findOne($pembelian_detail->id_item_stok);
                $item = AktItem::findOne($item_stok->id_item);
                $gudang = AktGudang::findOne($item_stok->id_gudang);
            ?>
                <tr>
                    <td><?= $no . '.' ?></td>
                    <td><?= $item->nama_item ?></td>
                    <td><?= $dataa['qty_diterima'] ?></td>
                    <td><?= $item->satuan->nama_satuan ?></td>
                    <td><?= $gudang->nama_gudang ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
<?php } ?>

<script>
    window.print();
    setTimeout(window.close, 1000);
</script>