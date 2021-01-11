<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\HelptextNiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Helptexts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="helptext-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Helptext', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => 'itemView.php'
    ]) ?>


</div>
