<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
?>
<div class="student-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'phone',
            'telegram_id',
            'fio',
            [
                'attribute'=>'status',
                'value' => function($model){
                    return getStatus()[$model->status];
                }
            ],
            'balance',
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
