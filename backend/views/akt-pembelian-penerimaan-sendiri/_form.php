<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\AktPenjualanPengiriman */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akt-penjualan-pengiriman-form">
    <div class="panel panel-primary">
        <div class="panel-heading"><span class="fa fa-truck"></span> <?= $this->title ?></div>
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'id_penjualan')->widget(Select2::classname(), [
                        'data' => $data_penjualan,
                        'language' => 'en',
                        'options' => ['placeholder' => 'Pilih No. Penjualan'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])
                    ?>

                    <?= $form->field($model, 'no_pengiriman')->textInput(['readonly' => true]) ?>

                    <?= $form->field($model, 'tanggal_pengiriman')->widget(\yii\jui\DatePicker::classname(), [
                        'clientOptions' => [
                            'changeMonth' => true,
                            'changeYear' => true,
                        ],
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['class' => 'form-control']
                    ]) ?>

                    <?= $form->field($model, 'pengantar')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'penerima')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'keterangan_pengiriman')->textarea(['rows' => 6]) ?>

                    <?php
                    if ($model->isNewRecord) {
                        # code...
                    ?>
                        <?= $form->field($model, 'status')->dropDownList(array(1 => "On Progress")) ?>
                    <?php
                    } else {
                        # code...
                    ?>
                        <?= $form->field($model, 'status')->dropDownList(array(1 => "On Progress", 2 => "Completed")) ?>
                    <?php
                    }

                    ?>

                    <div class="form-group">
                        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-saved"></span> Simpan', ['class' => 'btn btn-success']) ?>
                        <?php
                        if ($model->isNewRecord) {
                            # code...
                            $url = ['index'];
                        } else {
                            # code...
                            $url = ['view', 'id' => $model->id_penjualan_pengiriman];
                        }

                        ?>
                        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Kembali', $url, ['class' => 'btn btn-warning']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>