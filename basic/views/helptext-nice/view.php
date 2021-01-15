<?php

use h0rseduck\tuieditor\TuiEditor;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Helptext */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Helptexts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="helptext-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);

        $tui = [
            'editorOptions' => [
                'initialEditType' => 'markdown',
                'previewStyle' => 'vertical',
                'height' => '500px',

            ] ,  'model'=>$model
        ] ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'command:ntext',
            'created:datetime',
            'decr:ntext',
            'updated:datetime',
            ['attribute' => 'help', 'value' => TuiEditor::widget(array_merge($tui,['attribute'=>'help'])),'encode'=>false,  'format'=>'raw'],

            'example:html',
            ['attribute' => 'parsed', 'value' => TuiEditor::widget(array_merge($tui,['attribute'=>'parsed'])),'encode'=>false,  'format'=>'raw'],
            'source:ntext',
            'device:ntext',
            'dop_info:ntext',
            'weight',
        ],
    ]) ?>

</div>
