<?php

use backend\models\AktPenjualanDetail;
use backend\models\AktItemStok;
use backend\models\AktItem;
use backend\models\AktGudang;
use backend\models\AktSatuan;
?>
<style>
    .table1 {
        border-collapse: collapse;
        width: 100%;
        font-size: 12px;
    }

    .table1,
    .table1 th {
        border: 0px solid #000000;
    }

    .table1 th {
        padding: 5px;
    }

    .header_kiri {
        text-align: left;
    }

    hr {
        border: 1px solid black;
    }

    .table2,
    .table2 td {
        /* border: 1px solid #000000; */
        text-align: left;
    }

    .table2,
    .table2 th {
        /* border: 1px solid #000000; */
        text-align: left;
    }

    .table2 {
        border-collapse: collapse;
        width: 100%;
        font-size: 13px;
    }

    .table2 th {
        padding: 5px;
        border-bottom: 1px solid #000000;
    }

    .table2 td {
        padding: 5px;
    }

    .table3 th {
        text-align: right;
        border-collapse: collapse;
        padding: 5px;
    }

    .table3 {
        border-collapse: collapse;
        font-size: 12px;
        width: 100%;
    }
    @media print {
        @page 
    {
        size: auto; 
        margin: 0mm;
    }
}
</style>
<table class="table1">
    <thead>
        <tr>
            <th class="header_kiri" style="font-size: 15px; font-weight: bold;"><?= $data_setting->nama ?></th>
            <th colspan="2" style="font-size: 15px; font-weight: bold;">FAKTUR</th>
            <th class="header_kiri" style="font-size: 13px;">Kepada Yth.</th>
        </tr>
        <tr>
            <th class="header_kiri"><?= $data_setting->nama_usaha ?></th>
            <th class="header_kiri">No. Faktur</th>
            <th class="header_kiri">: <?= $model->no_faktur_penjualan ?></th>
            <th class="header_kiri"><?= (!empty($model->customer->nama_mitra_bisnis)) ? $model->customer->nama_mitra_bisnis : '' ?></th>
        </tr>
        <tr>
            <th class="header_kiri"><?= $data_setting->alamat ?></th>
            <th class="header_kiri">Inv. Date</th>
            <th class="header_kiri">: <?= date('d/m/Y', strtotime($model->tanggal_penjualan)) . ' ' . date('H:i') ?></th>
            <th class="header_kiri"><?= (!empty($model->mitra_bisnis_alamat->keterangan_alamat)) ? $model->mitra_bisnis_alamat->keterangan_alamat : '' ?></th>
        </tr>
        <tr>
            <th class="header_kiri">Telp : <?= $data_setting->telepon ?>, Fax : <?= $data_setting->fax ?></th>
            <th class="header_kiri">Sales</th>
            <th class="header_kiri">: <?= (!empty($model->sales->nama_sales)) ? $model->sales->nama_sales : '' ?></th>
            <th class="header_kiri"><?= (!empty($model->mitra_bisnis_alamat->kota->nama_kota)) ? $model->mitra_bisnis_alamat->kota->nama_kota : '' ?></th>
        </tr>
        <tr>
            <th class="header_kiri">NPWP : <?= $data_setting->npwp ?></th>
            <?php
            if ($model->jenis_bayar == 1) {
                # code...
            ?>
                <th class="header_kiri">Jatuh Tempo</th>
                <th class="header_kiri">: <?= date('d/m/Y', strtotime($model->tanggal_faktur_penjualan)) ?></th>
            <?php
            } elseif ($model->jenis_bayar == 2) {
                # code...
            ?>
                <th class="header_kiri">Jatuh Tempo</th>
                <th class="header_kiri">: <?= date('d/m/Y', strtotime($model->tanggal_tempo)) ?></th>
            <?php
            }
            ?>
            <th class="header_kiri">NPWP : </th>
        </tr>
    </thead>
</table>
<hr>
<table class="table2">
    <thead>
        <tr>
            <th style="width: 1%;">#</th>
            <th style="width: 10%;">Jumlah</th>
            <th style="width: 13%;">Kode Barang</th>
            <th>Nama Barang</th>
            <th style="text-align: right;">Harga Satuan</th>
            <th style="text-align: center; width: 10%;">Diskon %</th>
            <th style="text-align: right;">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query_penjualan_detail = AktPenjualanDetail::find()->where(['id_penjualan' => $model->id_penjualan])->all();
        foreach ($query_penjualan_detail as $key => $data) {
            # code...
            $item_stok = AktItemStok::findOne($data['id_item_stok']);
            $item = AktItem::findOne($item_stok->id_item);
            $gudang = AktGudang::findOne($item_stok->id_gudang);
            $satuan = AktSatuan::findOne($item->id_satuan);
        ?>
            <tr>
                <td><?= $no++ . '.' ?></td>
                <td><?= (!empty($satuan->nama_satuan)) ? $data['qty'] . ' ' . $satuan->nama_satuan : $data['qty'] ?></td>
                <td><?= (!empty($item->kode_item)) ? $item->kode_item : '' ?></td>
                <td><?= (!empty($item->nama_item)) ? $item->nama_item : '' ?></td>
                <td style="text-align: right;"><?= ribuan($data['harga']) ?></td>
                <td style="text-align: center;"><?= $data['diskon'] ?></td>
                <td style="text-align: right;"><?= ribuan($data['total']) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<hr>
<table class="table3" border="0">
    <thead>
        <tr>
            <th colspan="3" style="text-align: left; font-size: 13px;"><?= terbilang($model->total) ?></th>
            <th style="text-align: center;">Hormat Kami,</th>
            <th>DPP</th>
            <th><?= ribuan($total_penjualan_barang) ?></th>
        </tr>
        <tr>
            <th rowspan="5" colspan="4"></th>
            <th>Diskon <?= $model->diskon ?>%</th>
            <th>
                <?php
                $diskon = ($model->diskon > 0) ? ($total_penjualan_barang * $model->diskon) / 100 : 0;
                echo ribuan($diskon);
                ?>
            </th>
        </tr>
        <tr>
            <th>Pajak 10%</th>
            <th>
                <?php
                $pajak = ($model->pajak > 0) ? $pajak = (($total_penjualan_barang - $diskon) * 10) / 100 : 0;
                echo ribuan($pajak);
                ?>
            </th>
        </tr>
        <tr>
            <th>Ongkir</th>
            <th><?= ribuan($model->ongkir) ?></th>
        </tr>
        <tr>
            <th>Materai</th>
            <th><?= ribuan($model->materai) ?></th>
        </tr>
        <tr>
            <th>Uang Muka</th>
            <th><?= ribuan($model->uang_muka) ?></th>
        </tr>
        <tr>
            <th style="text-align: center; font-size: 15px;">Penerima</th>
            <th style="text-align: center; font-size: 15px;">Gudang</th>
            <th style="text-align: center; font-size: 15px;">Ekspedisi</th>
            <th style="text-align: center; font-size: 15px;"><?= $data_setting->direktur ?></th>
            <th style="font-weight: bold; font-size: 15px;">Tagihan</th>
            <th style="font-weight: bold; font-size: 15px;"><?= ribuan($model->total) ?></th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    window.print();
    setTimeout(window.close, 500);
</script>