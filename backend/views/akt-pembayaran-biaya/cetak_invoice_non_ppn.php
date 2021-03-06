<?php

use backend\models\AktPembelianDetail;
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
        @page {
            size: auto;
            margin: 0mm;
        }
    }
</style>
<table class="table1">
    <thead>
        <tr>
            <th class="header_kiri" style="font-size: 15px; font-weight: bold;" style="width: ;">
                <img width="150px" src="upload/<?= $data_setting->foto ?>" alt="">
                <!-- <?= $data_setting->nama ?> -->
            </th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th class="header_kiri" style="font-size: 13px; font-weight: bold;">
                <?= $data_setting->alamat . '<br>' . $data_setting->kota->nama_kota . ', Telp ' . $data_setting->telepon ?>
                <!-- <?= $data_setting->nama ?> -->
            </th>
            <th colspan="2" style="font-size: 15px; font-weight: bold;">FAKTUR PEMBELIAN</th>
            <th class="header_kiri">No. Faktur</th>
            <th class="header_kiri">: <?= $model->no_faktur_pembelian ?></th>
        </tr>
        <tr>
            <th class="header_kiri"></th>
            <th class="header_kiri"></th>
            <th class="header_kiri"></th>
            <th class="header_kiri">Tanggal Pembelian</th>
            <th class="header_kiri">: <?= !empty($model->tanggal_pembelian) ? tanggal_indo($model->tanggal_pembelian) : null ?></th>
        </tr>
        <tr>
            <th class="header_kiri">Kepada Yth : </th>
            <th class="header_kiri"></th>
            <th class="header_kiri"></th>
            <?php
            if ($model->jenis_bayar == 1) {
                # code...
            ?>
                <th class="header_kiri">Jatuh Tempo</th>
                <th class="header_kiri">: <?= !empty($model->tanggal_faktur_pembelian) ? tanggal_indo($model->tanggal_faktur_pembelian) : null ?></th>
            <?php
            } elseif ($model->jenis_bayar == 2) {
                # code...
            ?>
                <th class="header_kiri">Jatuh Tempo</th>
                <th class="header_kiri">: <?= !empty($model->tanggal_tempo) ? tanggal_indo($model->tanggal_tempo) : null ?></th>
            <?php
            }
            ?>
        </tr>
        <tr>
            <th class="header_kiri"><?= (!empty($model->customer->nama_mitra_bisnis)) ? $model->customer->nama_mitra_bisnis : '' ?></th>
            <th class="header_kiri"></th>
            <th class="header_kiri"></th>
            <th class="header_kiri">No.SJ</th>
            <th class="header_kiri">: </th>
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
            <th>Harga Satuan</th>
            <th>Diskon</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query_pembelian_detail = AktPembelianDetail::find()->where(['id_pembelian' => $model->id_pembelian])->all();
        foreach ($query_pembelian_detail as $key => $data) {
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
                <td>
                    <?php
                    $harga_asli = $data['total'] / $data['qty'];
                    $harga_asli_plus_ppn = $harga_asli + ($harga_asli * 0.1);

                    ?>
                    <?= ribuan($harga_asli_plus_ppn) ?>

                </td>
                <td> <?= $data['diskon'] ?> %</td>
                <td style="text-align: right;">
                    <?php $total_pembeliaan_per_item = $harga_asli_plus_ppn * $data['qty']; ?>
                    <?= ribuan($total_pembeliaan_per_item) ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<hr>
<table class="table3" border="0">
    <thead>
        <tr>
            <th colspan="3" style="text-align: left; font-size: 13px;">Terbilang:</th>
            <th style="text-align: center;"></th>
            <th>DPP</th>
            <th><?= ribuan($total_pembeliaan_per_item) ?></th>
        </tr>
        <tr>
            <th colspan="4" style="text-align: left; font-size: 13px;">***<?= terbilang($model->total) ?>***</th>
            <th>Diskon <?= $model->diskon ?>%</th>
            <th>
                <?php
                $diskon = ($model->diskon * $total_pembeliaan_per_item) / 100;
                echo ribuan($diskon);
                ?>
            </th>
        </tr>
        <tr>
            <th rowspan="2" colspan="4"></th>
            <th>Ongkir</th>
            <th><?= ribuan($model->ongkir) ?></th>
        </tr>
        <tr>
            <th>Materai</th>
            <th><?= ribuan($model->materai) ?></th>
        </tr>
        <tr>
            <th colspan="4"></th>
            <th>Uang Muka</th>
            <th><?= ribuan($model->uang_muka) ?></th>
        </tr>
        <?php if (!empty($sum_retur)) { ?>
            <tr>
                <th colspan="4"></th>
                <th>Total Retur</th>
                <th><?= ribuan($sum_retur) ?></th>
            </tr>
        <?php } ?>
        <tr>
            <th style="text-align: center; font-size: 15px;">Keuangan</th>
            <th style="text-align: center; font-size: 15px;"></th>
            <th style="text-align: center; font-size: 15px;">Penagihan</th>
            <th style="text-align: center; font-size: 15px;"></th>
            <th style="font-weight: bold; font-size: 15px;">Tagihan</th>
            <th style="font-weight: bold; font-size: 15px;"><?= ribuan($model->total) ?></th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    window.print();
    // setTimeout(window.close, 500);
</script>