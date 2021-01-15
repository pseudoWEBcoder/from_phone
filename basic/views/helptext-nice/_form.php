<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use \h0rseduck\tuieditor\TuiEditor;

/* @var $this yii\web\View */
/* @var $model \app\models\Helptext*/
/* @var $form yii\widgets\ActiveForm */
$TinyMcedefault = [
    'options' => ['rows' => 16],
    'language' => 'en_GB',
    'clientOptions' => [
             'encoding' => 'xml',
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
   ]
];
$CKEditordefault = [
    'editorOptions' => [
        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
        'extraPlugins'=> 'codesnippetgeshi',
        'codeSnippetGeshi_url'=> '../lib/colorize.php' ]
];
 $tui_default =  [
     'editorOptions' => [
         'initialEditType' => 'markdown',
         'previewStyle' => 'vertical',
         'height' => '500px'
     ]
 ];
?>

<div class="helptext-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'command')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>
<?php
//$model->help  =  preg_replace('/^\s*(--\w+)(\s+)(.*)$/m',  '**$1**$2$3',$model->help);https://regex101.com/r/nsyxOq/1
?>
    <?= $form->field($model, 'help')->widget(TuiEditor::className(), $tui_default) ?>

    <?= $form->field($model, 'decr')->widget(TuiEditor::className(), $tui_default) ?>

    <?= $form->field($model, 'example')->widget(TuiEditor::className(), $tui_default) ?>

    <?= $form->field($model, 'parsed')->widget(TuiEditor::className(), $tui_default) ?>

    <?= $form->field($model, 'source')->widget(TuiEditor::className(), $tui_default) ?>

    <?= $form->field($model, 'device')->widget(TuiEditor::className(), $tui_default) ?>

    <?= $form->field($model, 'dop_info')->widget(TuiEditor::className(), $tui_default) ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
