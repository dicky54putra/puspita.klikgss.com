<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AktPenjualanPengirimanDetail */

$this->title = $model->id_penjualan_pengiriman_detail;
$this->params['breadcrumbs'][] = ['label' => 'Akt Penjualan Pengiriman Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="akt-penjualan-pengiriman-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_penjualan_pengiriman_detail], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_penjualan_pengiriman_detail], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_penjualan_pengiriman_detail',
            'id_penjualan_pengiriman',
            'id_penjualan_detail',
            'qty_dikirim',
            'keterangan:ntext',
        ],
    ]) ?>

</div>
