<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\HelptextSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Helptexts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="helptext-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Helptext', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'command:ntext',
            'created',
            'updated',
            'help:ntext',
            //'decr:ntext',
            //'example:ntext',
            //'parsed:ntext',
            //'source:ntext',
            //'device:ntext',
            //'dop_info:ntext',
            //'weight',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
