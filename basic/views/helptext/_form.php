<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Helptext */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="helptext-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'command')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'help')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'decr')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'example')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'parsed')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'source')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'device')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dop_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>