<?php

const STATUS_ACTIVE = 1;
const STATUS_INACTIVE = 0;

const TYPE_SINGLE = 0;
const TYPE_MULTI = 1;

const ANSWER_YES = 1;
const ANSWER_NO = 0;

function getStatus()
{
    return [
        STATUS_ACTIVE => \Yii::t('app','Active'),
        STATUS_INACTIVE => \Yii::t('app','Inactive'),
    ];
}


function getTypeTest()
{
    return [
        TYPE_SINGLE => \Yii::t('app','Single'),
        TYPE_MULTI => \Yii::t('app','Multiple'),
    ];
}


function getYesOrNot()
{
    return [
        ANSWER_YES => \Yii::t('app','Yes'),
        ANSWER_NO => \Yii::t('app','No'),
    ];
}

function dd($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die();
}