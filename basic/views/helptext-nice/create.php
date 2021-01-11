<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Helptext */

$this->title = 'Create Helptext';
$this->params['breadcrumbs'][] = ['label' => 'Helptexts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="helptext-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
