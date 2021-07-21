<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */
?>
<div class="categories-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute'=>'type',
                'value' => function($model){
                    return getTypeTest()[$model->type];
                }
            ],
            [
                'attribute'=>'status',
                'value' => function($model){
                    return getStatus()[$model->status];
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => 'dateTime'
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'dateTime'
            ]
        ],
    ]) ?>

</div>
