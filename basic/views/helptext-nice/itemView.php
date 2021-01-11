<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\HelptextNiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* @var $model Helptext */

use app\models\Helptext;
use yii\helpers\Html;

?>
<?= Html::a(Html::encode($model->command), ['view', 'id' => $model->id]) ?>
<? if ($model->decr): ?>
    &ndash; <span class="text-muted"><?= Html::encode($model->decr) ?></span>
<? else: ?>
    <span class="text-danger">(not set)</span>
<? endif; ?>

