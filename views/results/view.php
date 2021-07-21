<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Results */
?>
<div class="results-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'student_id',
            'test_id',
            'test_item_id',
            'answers',
            'point',
        ],
    ]) ?>

</div>
