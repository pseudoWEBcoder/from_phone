<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\searches\HelptextSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="helptext-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'command') ?>

    <?= $form->field($model, 'created') ?>

    <?= $form->field($model, 'updated') ?>

    <?= $form->field($model, 'help') ?>

    <?php // echo $form->field($model, 'decr') ?>

    <?php // echo $form->field($model, 'example') ?>

    <?php // echo $form->field($model, 'parsed') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'device') ?>

    <?php // echo $form->field($model, 'dop_info') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
