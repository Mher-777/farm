<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WallComments */

$this->title = 'Изменить комментарий: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Комментарий', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wall-comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
