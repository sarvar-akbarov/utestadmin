<?php

use yii\helpers\Url;
use app\models\Users;
use yii\helpers\Html;

$user = Yii::$app->user->identity;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fio',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phone',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'permission',
        'value' => function($model){
            return Users::getPermission()[$model->permission];
        },
        'filter' => Users::getPermission()
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'value' => function($model){
            return getStatus()[$model->status];
        },
        'filter' => getStatus()
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'template' => '{update} {view} {delete}',
        'buttons'  => [
            'update' => function($url, $model) use ($user){
                $url = ['/users/update', 'id' => $model->id];
                if($user->isAdmin()){
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, [
                        'title'=>Yii::t('app','Update'), 
                        'data-toggle'=>'tooltip',
                        'role'=>'modal-remote'
                    ]);
                }
            },
            'delete' => function($url, $model) use ($user){
                $url = ['/users/delete', 'id' => $model->id];
                if($user->isAdmin() && $model->id != $user->id){
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
                        'role'=>'modal-remote','title'=>Yii::t('app','Delete'), 
                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                        'data-request-method'=>'post',
                        'data-toggle'=>'tooltip',
                        'data-confirm-title'=>Yii::t('app','Are you sure?'),
                        'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item')
                    ]);
                }
            }
        ],
        'viewOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','View'),'data-toggle'=>'tooltip'],
    ],

];   