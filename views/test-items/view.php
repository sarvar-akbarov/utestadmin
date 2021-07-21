<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TestItems */
?>
<div class="test-items-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'test_id',
            'name',
            'count',
            'answers',
            'ball',
        ],
    ]) ?>

</div>
