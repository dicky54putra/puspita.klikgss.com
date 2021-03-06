<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AktMerk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="akt-merk-form">
    <div class="panel panel-primary">
        <div class="panel-heading"><span class="fa fa-boxes"></span> Merk Barang</div>
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'kode_merk')->textInput(['maxlength' => true, 'readonly' => true, 'value' => $nomor]) ?>

                    <?= $form->field($model, 'nama_merk')->textInput(['maxlength' => true]) ?>

                    <div class="form-group">
                        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
                        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> Simpan', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>