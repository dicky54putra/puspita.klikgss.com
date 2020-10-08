<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AktPembelian */

$this->title = 'Ubah Data Order Pembelian';
// $this->params['breadcrumbs'][] = ['label' => 'Akt Pembelians', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id_pembelian, 'url' => ['view', 'id' => $model->id_pembelian]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="akt-pembelian-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><?= Html::a('Daftar Pembelian', ['akt-pembelian/index']) ?></li>
        <li class="active">Ubah Data Order Pembelian </li>
    </ul>
    <?= $this->render('_form', [
        'model' => $model,
        'data_customer' => $data_customer,
        'data_sales' => $data_sales,
        'data_mata_uang' => $data_mata_uang,
    ]) ?>

</div>