<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AktPenjualanDetail */

$this->title = 'Ubah Barang';
// $this->params['breadcrumbs'][] = ['label' => 'Akt Penjualan Details', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id_penjualan_detail, 'url' => ['view', 'id' => $model->id_penjualan_detail]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="akt-penjualan-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><?= Html::a('Data Penjualan', ['akt-penjualan-penjualan/index']) ?></li>
        <li><?= Html::a('Detail Data Penjualan : ' . $akt_penjualan->no_penjualan, ['akt-penjualan-penjualan/view', 'id' => $model->id_penjualan]) ?></li>
        <li class="active"><?= $this->title ?></li>
    </ul>

    <?= $this->render('_form_update_penjualan', [
        'model' => $model,
        'data_item_stok' => $data_item_stok,
        'data_level' => $data_level
    ]) ?>

</div>