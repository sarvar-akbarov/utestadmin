<?php

use app\models\Users;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
$model->avatar != null ? $path = '/'.$model->avatar : $path = '/images/user.png';

?>
<div class="users-view">
    
    <div class="row">
        <div class="col-md-4">
            <?= Html::img($path, [
                'style' => 'width:100%;',
            ]) ?>
        </div>
        <div class="col-md-8">
            <h2>
                Shaxsiy ma'lumotlar
            </h2>
            <hr>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                
                    'fio',
                    'login',
                    'phone',
                    
                    [
                        'class'=>'\kartik\grid\DataColumn',
                        'attribute'=>'permission',
                        'value' => function($model){
                            return Users::getPermission()[$model->permission];
                        },
                    ],
                    [
                        'class'=>'\kartik\grid\DataColumn',
                        'attribute'=>'status',
                        'value' => function($model){
                            return getStatus()[$model->status];
                        },
                    ],
                ],
            ]) ?>
        </div>
    </div>
    

</div>
