<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Helptext */
/* @var $form yii\widgets\ActiveForm */
$default = [
    'options' => ['rows' => 16],
    'language' => 'en_GB',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
];
?>

<div class="helptext-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'command')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'help')->widget(TinyMce::className(), $default) ?>

    <?= $form->field($model, 'decr')->widget(TinyMce::className(), $default) ?>

    <?= $form->field($model, 'example')->widget(TinyMce::className(), $default) ?>

    <?= $form->field($model, 'parsed')->widget(TinyMce::className(), $default) ?>

    <?= $form->field($model, 'source')->widget(TinyMce::className(), $default) ?>

    <?= $form->field($model, 'device')->widget(TinyMce::className(), $default) ?>

    <?= $form->field($model, 'dop_info')->widget(TinyMce::className(), $default) ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
